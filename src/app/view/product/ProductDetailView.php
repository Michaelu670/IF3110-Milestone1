<?php

class ProductDetailView implements ViewInterface {
    public $productData;
    function __construct($productData) {
        $this->productData = $productData;
    }

    function render() {
        require_once __DIR__ . '/../../component/product/ProductDetailPage.php';
    }
}