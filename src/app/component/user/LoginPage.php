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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/login.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script>
    <title>Login</title>
</head>

<body>
    <div class="gradient-bluegreen-body">
        <div class="wrapper-small">
            <main class="pad-40">
                <header class="login-header">
                    <img class="login-image" src="<?= BASE_URL ?>/images/assets/logo-text-color.svg" alt="Ikomers Logo">
                    <p>To continue, log in to <span class="bold-text">IKOMERS</span>.</p>
                </header>
                <form class="login-form">
                    <div class="form-group">
                        <label class="bold-text" for="username">What's your username?</label>
                        <input type="text" name="username" placeholder="Username" id="username">
                        <p id="username-alert" class="alert-hide">Please fill out your username first!</p>
                    </div>
                    <div class="form-group">
                        <label  class="bold-text" for="password">Enter your password!</label>
                        <input type="password" name="password" placeholder="Password" id="password" autocomplete="on">
                        <p id="password-alert" class="alert-hide">Please fill out your password first!</p>
                    </div>
                    <div class="form-button">
                        <p id="login-alert" class="alert-hide">Wrong username/password!</p>
                        <button type="submit" class="button black-button bold-text">Log in</button>
                    </div>
                </form>
                <div class="form-hyperlink">
                    <p>Don't have an account? <a href="<?= BASE_URL ?>/user/register">Register</a>.</p>
                </div>
            </main>
        </div>
    </div>
</body>

</html>