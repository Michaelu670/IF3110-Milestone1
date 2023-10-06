<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/cart/cart.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Document</title>
</head>
<body>
    <div class="white-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="gridview">
                <div class="product-grid">
                    <?php require_once __DIR__ . '/CartItem.php'?>
                    <?php foreach($this->data['products'] as $product) {echoCartItem($product);}?>
                </div>
                <div class="detail-grid slight-white">
                    <form action="">
                        <input type="hidden" id="total-price" value="<?php echo $this->data['total_price']; ?>"/>
                        <label>Total price: Rp.<?php echo $this->data['total_price']; ?></label>
                        <br><br>
                        <!-- TODO link form to checkout -->
                        <input class="buy-button bluegreen-button bold-text" type="button" value="Buy" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>