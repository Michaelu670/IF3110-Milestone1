<?php

class CartModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function addToCart($userID, $productID, $quantity) {
        $activeCartID = $this->getActiveCart($userID)['cart_id'];
        $query = 
        '   INSERT INTO cart_details (cart_id, product_id, quantity)
            VALUES (:cart_id, :product_id, :quantity);
        ';

        $this->database->query($query);
        $this->database->bind('cart_id', $activeCartID);
        $this->database->bind('product_id', $productID);
        $this->database->bind('quantity', $quantity);
        $this->database->execute();
    }

    public function getActiveCart($userID) {
        // if no active cart exists; create one
        // return that active cart
        $query = 
        '   SELECT cart_id
            FROM cart NATURAL LEFT OUTER JOIN order_details
            WHERE user_id = :user_id AND recipient_name IS NULL;
        ';
        $this->database->query($query);
        $this->database->bind('user_id', $userID);
        $cartID = $this->database->fetch();
        if ($cartID) {
            $cartID = $cartID['cart_id'];
        }
        else {
            $cartID = $this->createCart($userID);
        }

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