<?php

class ProductEditView implements ViewInterface {
    public $data;
    public $defaultImage;
    public $tagList;
    function __construct($allData) {
        $this->data = $allData[0];
        $this->defaultImage = $allData[1];
        $this->tagList = $allData[2];

    }

    function render() {
        require_once __DIR__ . '/../../component/product/AddProductPage.php';
        
    }
}