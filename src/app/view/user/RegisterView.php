<?php

class RegisterView
{
    public $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../component/user/RegisterPage.php';
    }
}