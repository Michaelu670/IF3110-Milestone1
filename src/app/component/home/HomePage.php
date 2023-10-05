<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/search-result.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/home/home.js" defer></script>
    <!-- <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/searchpage.js" defer></script> -->
    <title>Home Page</title>
</head>

<body onload="getProduct()">
    <div class="black-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div id="search-result">

            </div>
        </div>
    </div>
</body>

</html>