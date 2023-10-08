<?php

class ProductDetailView implements ViewInterface {
    public $productData;
    public $data;
    public $tagList;
    function __construct($allData) {
        $this->data = $allData[0];
        $this->productData = $allData[1];
        $this->tagList = $allData[2];
    }

    function render() {
        if($this->data['access_type'] == 0){
            require_once __DIR__ . '/../../component/product/ProductDetailPage.php';
        }else{
            require_once __DIR__ . '/../../component/product/AdminProductPage.php';
        }
        
    }
}