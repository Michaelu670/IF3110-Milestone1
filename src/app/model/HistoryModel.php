<?php

class HistoryModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllOrder() {

        $query = 
        '   SELECT cart_id, recipient_name, recipient_phone_number, delivery_address, payment_id, order_date, receive_date
            FROM order_details
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
} 