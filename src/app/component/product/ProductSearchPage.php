<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/search-result.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <title>Search results</title> <!-- TODO: add search text -->
</head>
<body>
    <div class="flex-container">
        <?php require_once 'ProductCard.php' ?>
        <?php foreach($this->data as $product) {echoProductCard($product);}?>
    </div>

    <div class="pagination">
    <?php require_once __DIR__ . '/../template/Pagination.php' ?>
        <?php const PAGE_SHOW = 9; 
            for ($x=0; $x < PAGE_SHOW; $x++) 
            {echoPagination($this->page_count, $x, PAGE_SHOW);} ?>
    </div>
</body>
</html>