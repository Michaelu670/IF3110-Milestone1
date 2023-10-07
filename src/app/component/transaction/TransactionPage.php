<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/transaction/transaction.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>Transaction</title>
</head>
<body>
    <div class="white-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="gridview">
                <?php require_once __DIR__ . '/TransactionItem.php' ?>
                <?php foreach ($this->data['orders'] as $order) { ?>
                    <div class="order-grid">
                        <?php echoTransactionItem($order); ?>
                        <?php if (!empty($order)) { ?>
                            <div class="button-transaction">
                                <form method="POST" class="complete-button">
                                    <input type="hidden" name="action" value="complete">
                                    <input type="hidden" name="cart_id" value="<?= $order['cart_id'] ?>">
                                    <button type="submit" class="complete-button-toggle bold-text button">
                                        COMPLETE
                                    </button>
                                </form>
                                <form method="POST" class="delete-button">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="cart_id" value="<?= $order['cart_id'] ?>">
                                    <button type="submit" class="delete-button-toggle bold-text button">
                                        DELETE
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>