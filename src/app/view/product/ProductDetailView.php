<?php

class ProductDetailView implements ViewInterface {
    public $productData;
    public $data;
    public $tagList;
    function __construct($allData) {
        $this->data = $allData[0];
        $this->productData = $allData[1];
        $this->tagList = $allData[2];

        $this->data['username'] = $allData['username'];
        $this->data['picture_url'] = $allData['picture_url'];
        $this->data['access_type'] = $allData['access_type'] ?? null;
    }

    function render() {
        if($this->data['access_type'] == 0){
            require_once __DIR__ . '/../../component/product/ProductDetailPage.php';
        }else{
            require_once __DIR__ . '/../../component/product/AdminProductPage.php';
        }
        
    }
}