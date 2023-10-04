<?php

class ProductModel {
    
    private $database;
    private const PRODUCT_PER_PAGE = 25;
    private const DEFAULT_THUMBNAIL_URL = STORAGE_URL . '/images/product/thumbnail/default.jpg';

    public function __construct() {
        $this->database = new Database();
    }

    /**
     * return a single product map from ID
     */
    public function getProductFromID($productID) {
        $query = 
        '   SELECT name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date, tag_name AS tag 
            FROM product NATURAL LEFT OUTER JOIN product_tag NATURAL LEFT OUTER JOIN tag
            WHERE product_id = :productID;';
        
        $this->database->query($query);
        $this->database->bind('productID', $productID);
        $productTag = $this->database->fetchAll();

        if (!$productTag) {
            return null;
        }
        else {
            $product = $productTag[0];
            unset($product['tag']);
            if (isset($productTag[0]['tag'])) {
                $product['tags'] = [];
                foreach($productTag as $index => $tempProduct) {
                    $product['tags'][$index] = $tempProduct['tag'];
                }
            }
        }

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

    public function getProductsInPage($page, $q, $sortVar, $order = 'asc', $tags = []) {
        // sortVar and order must be sanitized & checked
        $query =
        '   SELECT product_id, name, description, price, stock, sold, thumbnail_url, create_date, last_modified_date, tag_name AS tag
            FROM product NATURAL LEFT OUTER JOIN product_tag NATURAL LEFT OUTER JOIN tag
            WHERE name like :q
            ORDER BY ' . $sortVar . ' ' . $order . ', product_id ASC;
        ';

        $this->database->query($query);
        $this->database->bind('q', $q, PDO::PARAM_STR);
        $productsWithTag = $this->database->fetchAll();

        // collapse [product + tag] to [product + [tags]]
        // asumsi seluruh produk dengan id sama bersebelahan {dari sort}

        $products = [];
        foreach ($productsWithTag as $index => $productWithTag) {
            if (isset($products[0]) && end($products)['product_id'] == $productWithTag['product_id']) {
                // sudah ada di dalam products, append tag
                $products[count($products) - 1]['tags'][count($products[count($products) - 1]['tags'])] = $productWithTag['tag'];
            }
            else {
                // belum ada di products, append products
                $products[count($products)] = $productWithTag;
                unset($products[count($products)-1]['tag']);
                if (isset($productWithTag['tag'])) {
                    $products[count($products)-1]['tags'][0] = $productWithTag['tag'];
                }
                else {
                    $products[count($products)-1]['tags'] = [];
                }
            }
        }

        // filter with tags
        $productsFiltered = [];
        foreach ($products as $product) {
            $containsAll = true;
            foreach ($tags as $tag) {
                if (!empty($tag) && !in_array($tag, $product['tags'])) {
                    $containsAll = false;
                    break;
                }
            }

            if ($containsAll) {
                $productsFiltered = array_merge($productsFiltered, [$product]);
            }
        }

        // get products for specific page
        $page_count = ceil(count($productsFiltered) / ProductModel::PRODUCT_PER_PAGE);
        if ($page > $page_count) {
            // ganti ke max
            $page = $page_count;
        }

        // page i mengandung nilai dari PRODUCT_PER_PAGE * (i-1) ~ min(jml_product - 1, PRODUCT_PER_PAGE * i - 1)
        // page 1-indexed, product 0-indexed
        $productsInPage = array_slice($productsFiltered, ProductModel::PRODUCT_PER_PAGE * ($page - 1), ProductModel::PRODUCT_PER_PAGE);
        
        // set default thumbnail
        foreach ($productsInPage as &$product) {
            $this->setDefaultThumbnail($product);
        }
        
        return [$productsInPage, $page_count];
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

    private function setDefaultThumbnail(&$product) {
        if (!isset($product['thumbnail_url'])) {
            $product['thumbnail_url'] = ProductModel::DEFAULT_THUMBNAIL_URL;
        }
    }
}