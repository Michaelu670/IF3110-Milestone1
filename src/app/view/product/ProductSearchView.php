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

        $this->data['username'] = $data['username'];
        $this->data['picture_url'] = $data['picture_url'];
        $this->data['access_type'] = $data['access_type'] ?? null;

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