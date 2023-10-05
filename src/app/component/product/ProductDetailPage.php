<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/product-detail.css">
    <!-- JavaScript Component -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/slideshow.js" defer></script>
    <title><?php echo $this->productData['name'] ?></title>
</head>
<body>
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
                <br>
                <h1>Rp.<? echo $this->productData['price'] ?> </h1>
                <br>
                <p>tags: <?php 
                    if (empty($this->productData['tags'])) {
                        echo '-';
                    }
                    else {
                        foreach($this->productData['tags'] as $tag) {
                            echo '<a href=/public/search/result?tags=' . $tag . '>' . $tag . '</a> ';
                        }
                    }
                ?></p>
                <br>
                <h2>detail</h2>
                <br>
                <p> <? echo $this->productData['description'] ?></p>
                
                <br><br>

                <form action="" method="post">
                    <h3>Belanja</h3> <br>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="" id="quantity" min="1" max="<? echo $this->productData['stock'] ?>"></input> <br><br>
                    </div>
                    <button type="submit" class="green-button bold-text button">Add to cart</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>