<?php

class Controller
{
    public function view($folder, $view, $data = [])
    {
        require_once __DIR__ . "/../view/" . $folder . "/" . $view . ".php";
        require_once __DIR__ . "/../middleware/AuthenticationMiddleware.php";
        $userData = $this->middleware('AuthenticationMiddleware')->getUserData();
        $data = array_merge($data, $userData);
        return new $view($data);
    }

    public function model($model)
    {
        require_once __DIR__ . "/../model/" . $model . ".php";
        return new $model();
    }

    public function middleware($middleware)
    {
        require_once __DIR__ . "/../middleware/" . $middleware . ".php";
        return new $middleware();
    }
}