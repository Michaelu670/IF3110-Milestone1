<?php

class ProductDetailView implements ViewInterface {
    public $productData;
    public $data;
    function __construct($allData) {
        $this->data = $allData[0];
        $this->productData = $allData[1];
    }

    function render() {
        require_once __DIR__ . '/../../component/product/ProductDetailPage.php';
    }
}