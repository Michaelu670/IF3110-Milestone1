<?php

class OrderView implements ViewInterface {
    public $data;
    function __construct($data) {
        $this->data = $data;
    }

    function render() {
        require_once __DIR__ . '/../../component/order/OrderPage.php';
    }
}