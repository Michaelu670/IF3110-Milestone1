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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/adminProduct-detail.css">
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
            <form class="contents">
                <div class="column-flex">
                    <div class="media-column">
                        <div class="slideshow-container">
                            <?php require_once __DIR__ . '/../template/SlideshowContent.php';?>
                            <?php foreach ($this->productData['media_urls'] as $media_url) {echoSlideshowContent($media_url);}?>
                            <a class="prev" onclick="prevSlide()">&#10094;</a>
                            <a class="next" onclick="nextSlide()">&#10095;</a>
                        </div>
                        <div class="form-group-file">
                            <label class="bold-text" for="picture_url">Change images:</label>
                            <input type="file" name="picture_url" id="picture_url" accept="image/png, image/jpeg, image/jpg" multiple> <!-- Tambahkan input file untuk unggah foto profil -->
                        </div>
                    </div>
                    <div class="description-column">
                        <div class="group-column">
                            <p class="bold-text">Product Name:</p>
                            <input class="text-input" type="text" placeholder="<? echo $this->productData['name'] ?>" class="" id="name" name="name"/> <br><br>
                        </div>

                        <div class="group-column">
                            <p class="bold-text">Price: </p>
                            <div class="form-group">
                                <p class="bold-text center-text">Rp.</p>
                                <input class="number-input" type="number" placeholder="<? echo $this->productData['price'] ?>" id="price" name="price" min="0" /> <br><br>
                            </div>
                        </div>

                        <div class="group-column">
                            <p class="bold-text">Tags</p>
                                <?php $temp_tags = $this->productData['tags']?>
                                <div class="tag-area">
                                    <?php foreach($temp_tags as $tag){echo '<p onclick="" class="tag-cell">'.$tag.'</p>';} ?>
                                </div>
                            <!-- <textarea disabled class="desc-input" placeholder="<?php foreach($this->productData['tags'] as $tag){echo $tag.' ';} ?>" id="tags" name="tags" wrap="soft"></textarea> <br><br> -->
                            <p>Add Tags</p>
                            <select>
                                <option value="default">Tag</option>
                                <?php foreach($this->tagList as $tag) {
                                    echo '<option value="'.$tag['tag_name'].'">'.$tag['tag_name'].'</option>';
                                }?>
                            </select>
                        </div>

                        <div class="group-column">
                            <p class="bold-text">Detail</p>
                            <textarea class="desc-input" placeholder="<? echo $this->productData['description'] ?>" id="desc" name="desc" wrap="soft"></textarea> <br><br>
                        </div>

                        <form method="POST">
                            <div class="group-column">
                                <p class="bold-text">Stock: </p>
                                <input class="number-input" type="number" placeholder="<? echo $this->productData['stock'] ?>" class="" id="quantity" name="quantity" min="0" /> <br><br>
                            </div>
                            <button type="submit" class="green-button bold-text button">Add to cart</button>
                        </form>
                    </div>
                </div>
                <!-- <button type="submit" class="bluegreen-button bold-text button">Add to cart</button> -->
            </form>
        </div>
    </div>
            
</body>
</html>