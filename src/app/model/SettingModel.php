<?php

class SettingModel {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function updateProfile($userID, $username, $fullname, $picture_url) {
        $query = 
        '   UPDATE user
            SET username = :username, fullname = :fullname, picture_url = :picture_url
            WHERE user_id = :user_id;
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userID);
        $this->database->bind('username', $username);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('picture_url', $picture_url);
        $this->database->execute();
    }

    public function updatePassword($userID, $password) {
        $query = 
        '   UPDATE user
            SET password = :password
            WHERE user_id = :user_id;
        ';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('user_id', $userID);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->execute();
    }
} 