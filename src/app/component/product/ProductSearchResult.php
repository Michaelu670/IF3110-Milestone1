<div class="flex-container">
    <?php require_once 'ProductCard.php' ?>
    <?php foreach($this->data as $product) {
        if (!isset($product['product_id'])) {
            continue;
        }
        if($this->access_type == 0) {echoProductCard($product);}
        else {echoAdminProductCard($product);}
        
    }?>
</div>

<div class="pagination">
    <?php require_once __DIR__ . '/../template/Pagination.php' ?>
    <?php const PAGE_SHOW = 9; 
        for ($x=0; $x < PAGE_SHOW; $x++) 
        {echoPagination($this->page_count, $x, PAGE_SHOW);} ?>
</div>