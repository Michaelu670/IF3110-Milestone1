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
            // if new product in cart, remove 
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
            $newQuantity = $quantity['quantity'] + $addQuantity;
            
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

    public function getActiveCart($userID) {
        // if no active cart exists; create one
        // return that active cart

        // return format:
        //  array with keys ([cart_id], [products_id] => [])
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
            $cartID['cart_id'] = $this->createCart($userID);
        }

        // add product id and quantity to cart
        // format: ["product_id" => xx, "quantity" => xx]
        $query = 
        '   SELECT product_id, quantity
            FROM cart_details
            WHERE cart_id = :cart_id;
        ';

        $this->database->query($query);
        $this->database->bind('cart_id', $cartID['cart_id']);
        $cartID['products'] = $this->database->fetchAll();

        return $cartID;
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