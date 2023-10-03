<?php

class ProductSearchView implements ViewInterface
{
    public $data;
    public $page_count;
    public function __construct($data = [])
    {
        $this->data = $data[0];
        $this->page_count = $data[1];
    }

    public function render()
    {
        require_once __DIR__ . '/../../component/product/ProductSearchPage.php';
    }
}