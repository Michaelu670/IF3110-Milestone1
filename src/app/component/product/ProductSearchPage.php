<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/search-result.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/product/searchPage.css">
    <!-- JavaScript Constant -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <!-- JavaScript Component -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/searchresult.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/searchpage.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    
    <title>Search results for <?php $searchStr = isset($_GET['q']) ? $_GET['q'] : ' '; echo $searchStr; ?></title>
</head>
<body onload="getSearchResult(<?php if (isset($_GET['page'])) {echo $_GET['page'];} ?>)">
    <div class="white-body">
        <!-- sidebar -->
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <div class="gridbox">
                <div class="search-result" id="search-result">
                
                </div>
                <div class="filter">
                    <div class="search-searchPage">
                        <label class="title" for='q'>Search</label>
                        <input type="search" id='q' value="<?php echo $this->data['q'] ?>" />
                    </div>
                    <div class="sort-searchPage">
                        <label class="title" for='sort'>Sorted by</label>
                        <select class="tag-sort-searchPage" id='sort'>
                            <option value='name' <?php if($this->data['sortVar'] == 'name') {echo 'selected';} ?>>name</option>
                            <option value='price' <?php if($this->data['sortVar'] == 'price') {echo 'selected';} ?> >price</option>
                            <option value='stock' <?php if($this->data['sortVar'] == 'stock') {echo 'selected';} ?> >stock</option>
                            <option value='sold' <?php if($this->data['sortVar'] == 'sold') {echo 'selected';} ?> >sold</option>
                            <option value='create_date' <?php if($this->data['sortVar'] == 'create_date') {echo 'selected';} ?> >date created</option>
                            <option value='last_modified_date' <?php if($this->data['sortVar'] == 'last_modified_date') {echo 'selected';} ?> >date modified</option>
                        </select>
                        <select id='order'>
                            <option value='asc' <?php if($this->data['order'] == 'asc') {echo 'selected';} ?>>ascending</option>
                            <option value='desc' <?php if($this->data['order'] == 'desc') {echo 'selected';} ?>>descending</option>
                        </select>
                    </div>
                    <div class="price-searchPage">
                        <label class="title" >Price range</label> <br>
                        <input class="min-price-searchPage" placeholder="Min Price" type='search' id='minPrice' value="<?php echo $this->data['minPrice'] ?>" />
                        <input placeholder="Max Price" type='search' id='maxPrice' value="<?php echo $this->data['maxPrice'] ?>" />
                    </div>
                    <div class="tag-searchPage">
                        <label class="title" >Tags</label> <br>
                        <span class="tagcheckbox-searchPage"><?php require_once 'TagCheckbox.php'?></span>
                        <span class="tagitem-searchPage"><?php foreach($this->data['all_tags'] as $tag) {echoTagCheckbox($tag['tag_name']);} ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    

</body>
</html>