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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/not-found/not-found.css">
    <title>Error <? echo $this->data['code'] ?></title>
</head>

<body>
    <div class="wrapper-small">
        <div class="pad-40">
            <div class="notFound">
                <img class="notFoundImage" src="<?= BASE_URL ?>/images/assets/logo-text-color.svg" alt="Ikomers Logo">
                <p class="main-text">Error <? echo $this->data['code'] ?> : <? echo $this->data['message'] ?></p>
                <?php 
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        echo '<a href=\"' . $_SERVER['HTTP_REFERER'] . '\"><p>Go back</p></a>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>