<nav class="bluegreen-navbar">
    <div class="pad-32">
        <div class="flex-between">
            <div class="nav-left-portion">
                <a href="/public/home">
                    <img src="<?= BASE_URL ?>/images/assets/logo-color.svg" alt="Ikomers Logo">
                </a>
                <div class="nav-top-search">
                    <form action="<?= BASE_URL ?>/search/result" METHOD="GET">
                        <div class="top-search-input">
                            <input type="text" placeholder="Search Product" name="q">
                            <button type="submit">
                                <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="nav-right-portion">
                <?php if ($this->data['username']) : ?>
                    <form id="setting-form" action="<?= BASE_URL ?>/user/setting" method="GET">
                        <div class="nav-username" style="cursor: pointer;" onclick="document.getElementById('setting-form').submit();">
                            <img class="profilePictureNavbar" src="<?= BASE_URL ?>/../storage/images/<?=$this->data['picture_url']?>" alt="profile icon">
                            <p class="usernameNavbar"><?= $this->data['username'] ?></p>
                        </div>
                    </form>
                <?php endif; ?>
                <button class="toggle" id="toggle">
                    <img src="<?= BASE_URL ?>/images/assets/bars.svg" alt="Bars">
                </button>
            </div>
        </div>
    </div>
    <?php
    if (!$this->data['username'] || $this->data['access_type'] == 0) : ?>
        <div class="nav-container" id="nav-container">
            <form action="<?= BASE_URL ?>/search/result" METHOD="GET" class="container-search">
                <div class="nav-search-input">
                    <input type="text" placeholder="Search Product" name="q">
                    <button type="submit">
                        <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                    </button>
                </div>
            </form>
            <a href="/public/home" class="nav-link">
                Product list
            </a>
            <a href="/public/cart" class="nav-link">
                Cart
            </a>
            <a href="/public/checkout" class="nav-link">
                Checkout
            </a>
            <a href="/public/order" class="nav-link">
                Order
            </a>
            <?php if ($this->data['username']) : ?>
                <a href="/public/user/login" id="log-out" class="nav-link log-out">
                    Log out
                </a>
            <?php else : ?>
                <a href="/public/user/login" class="nav-link">
                    Log in
                </a>
                <a href="/public/user/register" class="nav-link">
                    Register
                </a>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="nav-container" id="nav-container">
            <form action="<?= BASE_URL ?>/search/result" METHOD="GET" class="container-search">
                <div class="nav-search-input">
                    <input type="text" placeholder="Search Product" name="q">
                    <button type="submit">
                        <img src="<?= BASE_URL ?>/images/assets/search.svg" alt="Search icon">
                    </button>
                </div>
            </form>
            <a href="/public/product/add" class="nav-link">
                Add product
            </a>
            <a href="/public/transaction" class="nav-link">
                Transaction
            </a>
            <a href="/public/history" class="nav-link">
                History
            </a>
            <a href="/public/home" class="nav-link">
                Product list
            </a>
            <a href="/public/user/login" id="log-out" class="nav-link log-out">
                Log out
            </a>
        </div>
    <?php endif; ?>
</nav>
