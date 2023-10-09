<?php

class AuthenticationMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isAuthenticated()
    {
        if (!isset($_SESSION['user_id'])){
            throw new LoggedException('Unauthorized', 401);
        }

        $query = "SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1";

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if(!$user){
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function isAdmin()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new LoggedException('Unauthorized', 401);
        }

        $query = 'SELECT access_type FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user || $user->access_type == 0) {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function getUserData() 
    {
        $data = [];
        $data['username'] = null;
        $data['picture_url'] = 'user.svg';
        if (!isset($_SESSION['user_id'])) {
            return $data;
        }

        $query = 'SELECT username, fullname, picture_url, access_type FROM user WHERE user_id = :user_id';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();
        
        if (!$user) {
            return $data;
        }

        $data['username'] = $user->username;
        $data['picture_url'] = $user->picture_url ?? $data['picture_url'];
        $data['access_type'] = $user->access_type;
        return $data;
    }
}