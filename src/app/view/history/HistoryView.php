<?php

class HistoryView implements ViewInterface {
    public $data;
    function __construct($data) {
        $this->data = $data;
    }

    function render() {
        require_once __DIR__ . '/../../component/history/HistoryPage.php';
    }
}