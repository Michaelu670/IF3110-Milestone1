<?php

class ProductModel {
    
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    /**
     * return a single product map from ID
     */
    public function getProductFromID($productID) {
        $query = 
        '   SELECT name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date 
            FROM product
            WHERE product_id = :productID';
        
        $this->database->query($query);
        $this->database->bind('productID', $productID);
        $product = $this->database->fetch();

        return $product;
    }

    public function getAllProduct() {
        $query = 
        '   SELECT name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date 
            FROM product';
        $this->database->query($query);
        $products = $this->database->fetchAll();

        return $products;
    }

    public function getProductPage($page) {

    }

    public function getProductFromTag($tag) {

    }

    public function createProduct() {

    }

    /**
     * Dipanggil ketika updateProduct[colName] */ 
    private function updateProduct($productID, $colName, $newValue) {

    }

    public function updateProductName() {

    }

    public function updateProductDescription() {

    }

    public function updateProductPrice() {

    }

    public function updateProductThumbnail() {

    }

    public function deleteProduct() {

    }

    public function addStock() {

    }

    public function addSold() {

    }
}