<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUserFromID($user_id)
    {
        $query = 'SELECT username, fullname, access_type, picture_url FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);

        $user = $this->database->fetch();

        return $user;
    }

    public function getUsers($page)
    {
        $query = 'SELECT fullname, username, access_type FROM user LIMIT :limit OFFSET :offset';

        $this->database->query($query);
        $this->database->bind('limit', ROWS_PER_PAGE);
        $this->database->bind('offset', ($page-1) * ROWS_PER_PAGE);
        $users = $this->database->fetchAll();

        $query = 'SELECT CEIL(COUNT(user_id) / :rows_per_page) AS page_count FROM user';

        $this->database->query($query);
        $this->database->bind('rows_per_page', ROWS_PER_PAGE);
        $user = $this->database->fetch();
        $pageCount = $user->page_count;

        $returnArr = ['users' => $users, 'pages' => $pageCount];
        return $returnArr;
    }

    public function login($username, $password)
    {
        $query = 'SELECT user_id, password FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if ($user && password_verify($password, $user->password)) {
            return $user->user_id;
        } else {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function register($username, $password, $fullname, $picture_url)
    {
        $query = 'INSERT INTO user (username, fullname, password, access_type, picture_url) VALUES (:username, :fullname, :password, :access_type, :picture_url)';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('username', $username);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('access_type', 0);
        $this->database->bind('picture_url', $picture_url);

        $this->database->execute();
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

    public function doesUsernameExist($username)
    {
        $query = 'SELECT username FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        return $user;
    }
}