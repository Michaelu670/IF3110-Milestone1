<?php

class TransactionModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllOrder() {

        $query = 
        '   SELECT cart_id, recipient_name, recipient_phone_number, delivery_address, payment_id, order_date, receive_date
            FROM order_details
            WHERE receive_date IS NULL;
        ';

        $this->database->query($query);

        $order = $this->database->fetchAll();

        return $order;
    }

    public function getOrderFromID($userID){

        $query = 
        '   SELECT cart_id, recipient_name, recipient_phone_number, delivery_address, payment_id, order_date, receive_date
            FROM order_details NATURAL LEFT OUTER JOIN cart
            WHERE user_id = :userID;
        ';

        $this->database->query($query);
        $this->database->bind('userID', $userID);

        $order = $this->database->fetchAssoc();

    
        if ($order === false) {
            return []; // Return an empty array if there are no matching rows
        } else {
            return $order; // Return the fetched data if rows exist
        }
    }

    private function updateOrder($orderID, $colName, $newValue) {

        $query = 
        '   UPDATE order_details
            SET ' . $colName . ' = :newValue
            WHERE cart_id = :orderID;';

        $this->database->query($query);
        $this->database->bind(':newValue', $newValue);
        $this->database->bind(':orderID', $orderID);

        $this->database->execute();
    }

    public function createOrder($payment_method, $amount, $cartID, $recipient_name, $recipient_phone_number, $delivery_address) {
        $query = 'SELECT payment_id FROM payment ORDER BY payment_date DESC LIMIT 1;';

        $this->database->query($query);
        $current_id = $this->database->fetch();
        $payment_id = $current_id->payment_id + 1;

        $query = 'INSERT INTO payment (payment_id, payment_date, payment_method, amount) VALUES (:payment_id, NOW(), :payment_method, :amount)';
        
        $this->database->query($query);
        $this->database->bind('payment_id', $payment_id);
        $this->database->bind('payment_method', $payment_method);
        $this->database->bind('amount', $amount);
        $this->database->execute();
        
        $query = 'INSERT INTO order_details (cart_id, recipient_name, recipient_phone_number, delivery_address, payment_id, order_date, recieve_date) VALUES (:cart_id, :recipient_name, :recipient_phone_number, :delivery_address, :payment_id, :order_date, NULL);';
        $currentDateTime = date('Y-m-d H:i:s');

        echo $cartID . ", ". $recipient_name . ", " . $recipient_phone_number . ", " . $delivery_address . ", " . $payment_id . ", " . $currentDateTime;

        $this->database->query($query);
        $this->database->bind('cart_id', $cartID, PDO::PARAM_INT);
        $this->database->bind('recipient_name', $recipient_name, PDO::PARAM_STR);
        $this->database->bind('recipient_phone_number', $recipient_phone_number. PDO::PARAM_STR);
        $this->database->bind('delivery_address', $delivery_address, PDO::PARAM_STR);
        $this->database->bind('payment_id', $payment_id-1, PDO::PARAM_INT);
        $this->database->bind('order_date', $currentDateTime, PDO::PARAM_STR);

        $this->database->execute();
    }


    private function makePayment($payment_id, $payment_method, $amount) {

        $query = 'INSERT INTO payment (payment_id, payment_date, payment_method, amount) VALUES (:payment_id, NOW(), :payment_method, :amount)';
        
        $this->database->query($query);
        $this->database->bind('payment_id', $payment_id, PDO::PARAM_INT);
        $this->database->bind('payment_method', $payment_method, PDO::PARAM_STR);
        $this->database->bind('amount', $amount, PDO::PARAM_INT);
        $this->database->execute();
    }

    public function updateOrderReceiveDate($orderID, $newValue) {

        $this->updateOrder($orderID, 'receive_date', $newValue);
    }

    public function deleteOrderReceiveDate($orderID){
        $query = 'DELETE FROM order_details WHERE cart_id = :orderID';
    
        $this->database->query($query);
        $this->database->bind(':orderID', $orderID);

        return $this->database->execute();
    }
} 