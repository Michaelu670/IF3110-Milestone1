<?php

class App {
    public function __construct() {
        require_once __DIR__ . '/../controllers/NotFoundController.php';
        $controller = new NotFoundController();
        $controller->index();
    }

}

?>