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
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/slideshow.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/product/AddProduct.js" defer></script>
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <title>Add Product</title>
</head>
<body>
    <div class="white-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <form class="contents" id="contents">
                <div class="column-flex">
                    <div class="media-column">
                        <div class="slideshow-container">
                            <?php require_once __DIR__ . '/../template/SlideshowContent.php';?>
                            <?php foreach ($this->defaultImage as $media_url) {echoSlideshowContent($media_url);}?>
                            <a class="prev" onclick="prevSlide()">&#10094;</a>
                            <a class="next" onclick="nextSlide()">&#10095;</a>
                        </div>
                        <div class="form-group-file">
                            <label class="bold-text" for="thumbnail_url">Add thumbnail:</label>
                            <input type="file" name="thumbnail_url" id="thumbnail_url" accept="image/png, image/jpeg, image/jpg"> <!-- Tambahkan input file untuk unggah foto profil -->
                            <p class="alert-hide" id="thumbnail-alert"></p>
                        </div>
                        <div class="form-group-file">
                            <label class="bold-text" for="media_url">Add slideshow medias:</label>
                            <input type="file" name="media_url[]" id="media_url" accept="image/png, image/jpeg, image/jpg, video/mp4, video/ogg" multiple> <!-- Tambahkan input file untuk unggah foto profil -->
                        </div>
                    </div>
                    <div class="description-column">
                        <div class="group-column">
                            <p class="bold-text">Product Name:</p>
                            <input class="text-input" type="text" placeholder="Product name" class="" id="name" name="name"/>
                            <p class="alert-hide" id="name-alert"></p>
                        </div>

                        <div class="group-column">
                            <p class="bold-text">Price: </p>
                            <div class="form-group">
                                <p class="bold-text center-text">Rp.</p>
                                <input class="number-input" type="number" placeholder="0000" id="price" name="price" min="0" /> <br><br>
                                <p class="alert-hide" id="price-alert"></p>
                            </div>
                        </div>                        

                        <div class="group-column">
                            <p class="bold-text">Tags</p>
                            <div class="tag-area" id="tag-area"></div>
                
                            <p>Add Tags</p>
                            <select class='dropbox' id='dropbox' onchange="addOption()">
                                <option value="default">Tag</option>
                                <?php foreach($this->tagList as $tag) {
                                    echo '<option value="'.$tag['tag_name'].'">'.$tag['tag_name'].'</option>';
                                }?>
                            </select>
                        </div>

                        <div class="group-column">
                            <p class="bold-text">Detail</p>
                            <textarea class="desc-input" placeholder="Description" id="desc" name="desc" wrap="soft"></textarea>
                        </div>

                        <form method="POST">
                            <div class="group-column">
                                <p class="bold-text">Stock: </p>
                                <input class="number-input" type="number" placeholder="0" class="" id="stock" name="stock" min="0" />
                            </div>
                            <button form="contents" type="submit" class="green-button bold-text button">Save</button>
                        </form>
                    </div>
                </div>
                <!-- <button type="submit" class="bluegreen-button bold-text button">Add to cart</button> -->
            </form>
        </div>
    </div>
            
</body>
</html>