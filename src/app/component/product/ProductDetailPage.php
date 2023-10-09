<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/product-detail.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <!-- JavaScript Component -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/slideshow.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <title><?php echo $this->productData['name'] ?></title>
</head>
<body>
    <div class="white-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="contents">
                <div class="column-flex">
                    <div class="media-column">
                        <div class="slideshow-container">
                            <?php require_once __DIR__ . '/../template/SlideshowContent.php';?>
                            <?php foreach ($this->productData['media_urls'] as $media_url) {echoSlideshowContent($media_url);}?>

                            <a class="prev" onclick="prevSlide()">&#10094;</a>
                            <a class="next" onclick="nextSlide()">&#10095;</a>
                        </div>
                    </div>
                    <div class="description-column">
                        <h1> <? echo $this->productData['name'] ?> </h1>
                        <p>Terjual <? echo $this->productData['sold'] ?></p>
                        <hr> <br>
                        <h1>Rp.<? echo $this->productData['price'] ?> </h1>
                        <br>
                        <p>tags: <?php 
                            if (empty($this->productData['tags'])) {
                                echo '-';
                            }
                            else {
                                foreach($this->productData['tags'] as $tag) {
                                    echo '<u><a href=/public/search/result?tags=' . $tag . '>' . $tag . '</a></u> ';
                                }
                            }
                        ?></p>
                        <br> <hr> <br>
                        <h2>detail</h2>
                        <br>
                        <p> <? echo $this->productData['description'] ?></p>
                        
                        <br> <hr> <br> <br>

                        <form method="POST">
                            <h3>Belanja</h3> <br>
                            <p>Stock: <? echo $this->productData['stock'] ?></p> <br>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="" id="quantity" name="quantity" value="1" min="1" max="<? echo $this->productData['stock'] ?>" /> <br><br>
                            </div>
                            <button type="submit" class="green-button bold-text button">Add to cart</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
            
</body>
</html>