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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/checkout/checkout.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/checkout/checkout.js" defer></script>
    <title>Checkout</title>
</head>

<body>
    <div class="white-body">
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>
                <div class="wrapper">
                    <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
                    <form class="main-form" id="main-form">
                        <div class="gridview">
                            <div class="detail-grid">
                                <div class="leftbar-container">

                                    <!-- Setting Tabs -->
                                    <div class="detail-container">
                                        <div class="title-card">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm64 320H64V320c35.3 0 64 28.7 64 64zM64 192V128h64c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64v64H448zm64-192c-35.3 0-64-28.7-64-64h64v64zM288 160a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                                            </svg>
                                            <p class="bold-text title">Billing Details</p>
                                        </div>

                                        <!-- Payment Method -->
                                        <div class="payment-method" id="payment-methods">
                                            <p class="bold-text">Select payment method</p>    
                                            <div class="radio-group">
                                                <input type="radio" id="ewallet" name="payment-method" onclick="openSection('ewallet-detail');" value="ewallet">
                                                <label for="ewallet">E-Wallet</label><br>
                                            </div>
                                            <div class="radio-group">
                                                <input type="radio" id="card" name="payment-method" onclick="openSection('card-detail');" value="card">
                                                <label for="card">Credit/Debit</label><br>
                                            </div>
                                            <div class="radio-group">
                                                <input type="radio" id="cod" name="payment-method" onclick="openSection('cod-detail');" value="cod">
                                                <label for="cod">Cash on Delivery (COD)</label>
                                            </div>
                                            <p id="method-alert" class="alert-hide"></p>
                                        </div>
                                        
                                        <!-- Payment Details -->
                                        <div class="payment-detail" id="payment-details">
                                            <!-- E-WALLET DETAILS -->
                                            <div class="detail" id="ewallet-detail">
                                                <div class="title-card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                                                    </svg>
                                                    <p class="bold-text title">E-Wallet Details</p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="bold-text" for="ewallet">E-Wallet Number</label>
                                                    <input type="text" name="ewallet" placeholder="E-Wallet number" id="ewallet-number">
                                                    <p id="ewallet-alert" class="alert-hide"></p>
                                                </div>
                                            </div>

                                            <!-- CARD DETAILS -->
                                            <div class="detail" id="card-detail">
                                                <div class="title-card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z"/>
                                                    </svg>
                                                    <p class="bold-text title">Card Details</p>
                                                </div>

                                                <div class="form-group">
                                                    <label class="bold-text">Card Number</label>
                                                    <input type="text" name="card-number" placeholder="1234 5678 9012 3456" id="card-number">
                                                    <p id="card-number-alert" class="alert-hide"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="bold-text">Expiration Date</label>
                                                    <input type="text" name="card-number" placeholder="mmyy" id="card-exp">
                                                    <p id="card-exp-alert" class="alert-hide"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="bold-text">CVV</label>
                                                    <input type="password" name="card-cvv" placeholder="123" id="card-cvv" autocomplete="on">
                                                    <p id="card-cvv-alert" class="alert-hide"></p>
                                                </div>
                                            </div>

                                            <!-- COD -->
                                            <div class="detail" id="cod-detail">
                                                <!-- <p class="bold-text">For your convenience, we highly recommend that you prepare the exact amount for payment as our delivery agents may not have change on hand.</p> -->
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="detail-container">
                                        <div class="title-card">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 320 512">
                                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M16 144a144 144 0 1 1 288 0A144 144 0 1 1 16 144zM160 80c8.8 0 16-7.2 16-16s-7.2-16-16-16c-53 0-96 43-96 96c0 8.8 7.2 16 16 16s16-7.2 16-16c0-35.3 28.7-64 64-64zM128 480V317.1c10.4 1.9 21.1 2.9 32 2.9s21.6-1 32-2.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32z"/>
                                            </svg>
                                            <p class="bold-text title">Address Details</p>
                                        </div>

                                        <!-- Address detail -->
                                        <div class="address-detail" id="address-details">
                                            <div class="form-group">
                                                <label class="bold-text">Phone Number</label>
                                                <input type="text" name="phone" placeholder="Phone Number" id="phone">
                                                <p id="phone-alert" class="alert-hide">Please fill you phone number</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="bold-text">Province</label>
                                                <input type="text" name="province" placeholder="Province" id="province">
                                                <p id="province-alert" class="alert-hide"></p>
                                            </div>
                                            <div class="form-group">
                                                <label class="bold-text">City</label>
                                                <input type="text" name="city" placeholder="City" id="city">
                                                <p id="city-alert" class="alert-hide"></p>
                                            </div>
                                            <div class="form-group">
                                                <label class="bold-text">Postal Code</label>
                                                <input type="text" name="postal-code" placeholder="Postal code" id="postal-code">
                                                <p id="postal-alert" class="alert-hide"></p>
                                            </div>
                                            <div class="form-group">
                                                <label class="bold-text">Full Address</label>
                                                <input type="text" name="full-address" placeholder="Full address" id="full-address">
                                                <p id="fulladdress-alert" class="alert-hide"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-grid">
                                <div class="wrapper-column">
                                    <!-- Change profile Tab -->
                                    <div class="cart-details" id="Profile">
                                        <div class="title-card cart">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                            </svg>
                                            <p class="bold-text">Cart Summary</p>
                                        </div>

                                        <?php require_once __DIR__ . '/CartSummary.php'?>
                                        <?php foreach($this->data['products']['products'] as $product) {echoCartItem($product);}?>
                                        <label class="bold-text">Total price: Rp.<?php echo $this->data['products']['total_price']; ?></label>
                                    </div>

                                    <form class="button-wrapper" id="button-wrapper">
                                        <button type="submit" form="main-form"class="buy-button bluegreen-button bold-text">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
    <div class="pop-up" id="pop-up">
        <p>test</p>
        <button type="confirm" id="close">Close</button>
    </div>
</body>

</html>