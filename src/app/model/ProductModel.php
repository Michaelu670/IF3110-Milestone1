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
            WHERE product_id = :productID;';
        
        $this->database->query($query);
        $this->database->bind('productID', $productID);
        $product = $this->database->fetch();

        return $product;
    }

    public function getAllProducts() {
        $query = 
        '   SELECT name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date 
            FROM product;';
        $this->database->query($query);
        $products = $this->database->fetchAll();

        return $products;
    }


    public function getProductsFromTag($tag) {
        $query = 
        '   SELECT name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date 
            FROM product NATURAL JOIN product_tag NATURAL JOIN tag
            WHERE tag_name = :tag;';

        $this->database->query($query);
        $this->database->bind('tag', $tag);

        $products = $this->database->fetchAll();
        
        return $products;
    }

    public function createProduct($name, $description, $price, $stock, $thumbnail_url) {
        $query = 
        '   INSERT INTO product (name, description, price, stock, sold, thumbnail_url)
            VALUES (:name, :description, :price, :stock, 0, :thumbnail_url);';

        $this->database->query($query);
        $this->database->bind('name', $name);
        $this->database->bind('description', $description);
        $this->database->bind('price', $price);
        $this->database->bind('stock', $stock);
        $this->database->bind('thumbnail_url', $thumbnail_url);

        $this->database->execute();
    }

    /**
     * Dipanggil ketika updateProduct[colName] */ 
    private function updateProduct($productID, $colName, $newValue) {
        $query = 
        '   UPDATE product
            SET :colName = :newValue
            WHERE product_id = :productID;';
        
        $this->database->query($query);
        $this->database->bind('colName', $colName);
        $this->database->bind('newValue', $newValue);
        $this->database->bind('productID', $productID);

        $this->database->execute();
    }

    public function updateProductName($productID, $newValue) {
        $this->updateProduct($productID, 'name', $newValue);
    }

    public function updateProductDescription($productID, $newValue) {
        $this->updateProduct($productID, 'description', $newValue);
    }

    public function updateProductPrice($productID, $newValue) {
        $this->updateProduct($productID, 'price', $newValue);
    }

    public function updateProductThumbnail($productID, $newValue) {
        $this->updateProduct($productID, 'thumbnail', $newValue);
    }

    public function deleteProduct($productID) {
        $query = 
        '   DELETE product
            WHERE product_id = :productID;';

        $this->database->query($query);
        $this->database->bind('productID', $productID);

        $this->database->execute();
    }

    public function addStock($productID, $addedValue) {
        $product = $this->getProductFromID($productID);
        $newValue = $product['stock'] + $addedValue;
        $this->updateProduct($productID, 'stock', $newValue);
    }

    public function addSold($productID, $addedValue) {
        $product = $this->getProductFromID($productID);
        $newValue = $product['sold'] + $addedValue;
        $this->updateProduct($productID, 'sold', $newValue);
    }
}