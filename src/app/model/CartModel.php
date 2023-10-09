<?php

class CartModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function addToCart($userID, $productID, $addQuantity) {
        // get active cart ID
        $activeCartID = $this->getActiveCart($userID)['cart_id'];

        $query = 
        '   SELECT quantity
            FROM cart_details
            WHERE cart_id = :cart_id AND product_id = :product_id;
        ';
        $this->database->query($query);
        $this->database->bind('cart_id', $activeCartID);
        $this->database->bind('product_id', $productID);
        $quantity = $this->database->fetch();

        if (!$quantity) {
            // if new product in cart, add new.
            $query = 
            '   INSERT INTO cart_details (cart_id, product_id, quantity)
                VALUES (:cart_id, :product_id, :quantity);
            ';

            $this->database->query($query);
            $this->database->bind('cart_id', $activeCartID);
            $this->database->bind('product_id', $productID);
            $this->database->bind('quantity', $addQuantity);
            $this->database->execute();
        }
        else {
            // if product exists in cart, update quantity
            $newQuantity = $quantity->quantity + $addQuantity;
            
            if ($newQuantity > 0) {
                // if still exists, update quantity
                $query = 
                '   UPDATE cart_details
                    SET quantity = :quantity
                    WHERE cart_id = :cart_id AND product_id = :product_id;
                ';

                $this->database->query($query);
                $this->database->bind('cart_id', $activeCartID);
                $this->database->bind('product_id', $productID);
                $this->database->bind('quantity', $newQuantity);
                $this->database->execute();
            }
            else {
                // if removed completely, delete !!!!!!!!!!!!!!!!!!!!!!!!
                $query = 
                '   DELETE FROM cart_details
                    WHERE cart_id = :cart_id AND product_id = :product_id;
                ';

                $this->database->query($query);
                $this->database->bind('cart_id', $activeCartID);
                $this->database->bind('product_id', $productID);
                $this->database->execute();
            }
        }
    }

    private function validateCart(&$cart) {
        // check if all items in cart is not more than its stock
        // if more -> reduce item in cart and give notification to user
        
        // cart format -> see in getActiveCart, except total_price
        require_once __DIR__ . '/ProductModel.php';
        $productModel = new ProductModel();

        foreach ($cart['products'] as &$product) {
            $stock = $productModel->getProductFromID($product['product_id'])['stock'];
            if ($product['quantity'] > $stock) {
                if ($stock == 0) {
                    $query = 
                    '   DELETE FROM cart_details
                        WHERE cart_id = :cart_id AND product_id = :product_id;
                    ';
                    $this->database->query($query);
                    $this->database->bind('cart_id', $cart['cart_id']);
                    $this->database->bind('product_id', $product['product_id']);
                    $this->database->execute();

                }
                else {
                    $query = 
                    '   UPDATE cart_details
                        SET quantity = :stock
                        WHERE cart_id = :cart_id AND product_id = :product_id;
                    ';
                    $this->database->query($query);
                    $this->database->bind('cart_id', $cart['cart_id']);
                    $this->database->bind('stock', $stock);
                    $this->database->bind('product_id', $product['product_id']);
                    $this->database->execute();

                }
                
                $product['quantity'] = $stock; 
            }
        }
    }

    public function getActiveCart($userID) {
        // if no active cart exists; create one
        // return that active cart

        // return format:
        //  'cart_id' => cart id
        //  'products' => array with keys ([cart_id], [products_id] => [])
        //  'total_price' => total price
        $query = 
        '   SELECT cart_id
            FROM cart NATURAL LEFT OUTER JOIN order_details
            WHERE user_id = :user_id AND recipient_name IS NULL;
        ';
        $this->database->query($query);
        $this->database->bind('user_id', $userID);
        $cartID = $this->database->fetch();
        if (!$cartID) {
            $cartID = [];
            $cartID = $this->createCart($userID);
        }
        else {
            $cartID = $cartID->cart_id;
        }

        // add product id and quantity to cart
        // format: ["product_id" => xx, "quantity" => xx]
        $query = 
        '   SELECT product_id, quantity
            FROM cart_details
            WHERE cart_id = :cart_id;
        ';

        $cart['cart_id'] = $cartID;
        $this->database->query($query);
        $this->database->bind('cart_id', $cartID, PDO::PARAM_INT);
        $cart['products'] = $this->database->fetchAll();

        // validate cart
        $this->validateCart($cart);

        // add total price to cart
        require_once __DIR__ . '/ProductModel.php';
        $productModel = new ProductModel();
        $total_price = 0;
        foreach ($cart['products'] as $product) {
            $total_price += $productModel->getProductFromID($product['product_id'])['price'] * $product['quantity'];
        }
        $cart['total_price'] = $total_price;

        return $cart;
    }

    public function getCartFromID($cartID) {
        // return cart from its ID
        // HIGHLY NOT RECOMMENDED

        // return format:
        //  'cart_id' => cart id
        //  'products' => array with keys ([cart_id], [products_id] => [])
        //  'total_price' => total price

        // add product id and quantity to cart
        // format: ["product_id" => xx, "quantity" => xx]
        $query = 
        '   SELECT product_id, quantity
            FROM cart_details
            WHERE cart_id = :cart_id;
        ';

        $cart['cart_id'] = $cartID;
        $this->database->query($query);
        $this->database->bind('cart_id', $cartID, PDO::PARAM_INT);
        $cart['products'] = $this->database->fetchAll();

        // validate cart
        $this->validateCart($cart);

        // add total price to cart
        require_once __DIR__ . '/ProductModel.php';
        $productModel = new ProductModel();
        $total_price = 0;
        foreach ($cart['products'] as $product) {
            $total_price += $productModel->getProductFromID($product['product_id'])['price'] * $product['quantity'];
        }
        $cart['total_price'] = $total_price;

        return $cart;
    }

    public function createCart($userID) {
        $query = 
        '   INSERT INTO cart (user_id)
            VALUES (:user_id);
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userID);
        $this->database->execute();
        
        return $this->database->lastInsertId();
    }
} 