<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/search-result.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <title>Search results for <?php $searchStr = isset($_GET['q']) ? $_GET['q'] : ' '; echo $searchStr; ?></title> <!-- TODO: add search text -->
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