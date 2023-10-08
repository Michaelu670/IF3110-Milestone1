<?php

class ProductSearchView implements ViewInterface
{
    public $data;
    public $page_count;
    public $access_type;
    public function __construct($data = [])
    {
        $this->data = $data[0];
        $this->page_count = $data[1];
        $this->access_type = $data[2];


    }

    public function render()
    {
        if ($this->page_count == 0) {
            // TODO: empty page            
            require_once __DIR__ . '/../../component/product/ProductSearchResult.php'; // Placeholder
        }
        else {
            require_once __DIR__ . '/../../component/product/ProductSearchResult.php';
        }
        
    }
}