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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/setting/setting.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
    </script>
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <!-- JavaScript Library -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/setting/setting.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>

    <title>Setting</title>
</head>

<body>
    <div class="white-body">
        <?php include(dirname(__DIR__) . '/template/sidebar.php') ?>

        <div class="wrapper">
            <?php include(dirname(__DIR__) . '/template/navbar.php') ?>

        <!-- sidebar -->
        <div class="wrapper-small">
            <main class="pad-40">
                <div class="wrapper-main">
                    <div class="profile">
                        <?php if ($this->data['username']) : ?>
                            <img class="profilePicture" src="<?= BASE_URL ?>/../storage/images/<?=$this->data['picture_url']?>" alt="profile icon" ?>
                            <p><?= $this->data['username'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="wrapper2">
                        <div class="leftbar-container">
                            <!-- Setting Tabs -->
                            <div class="nav-containers">
                                <!-- <p>nav-container</p> -->
                                <div class='box-container 1'>
                                    <button type="tab" class="button-tab" onclick="openTab('Profile');" id="defaultOpen">Profile</button>
                                    <!-- <p onclick="openTab(event, 'Profile')" id="defaultOpen">Profile</p> -->
                                </div>
                                <div class='box-container 2'>
                                    <!-- <p onclick="openTab(event, 'Password')">Password</p> -->
                                    <button type="tab" class="button-tab" onclick="openTab('Pass');">Password</button>
                                </div>
                            </div>

                        </div>

                        <!-- Setting Details -->
                        <div class="wrapper-column">
                            <!-- Change profile Tab -->
                            <div class="form" id="Profile">
                                <form class="profile-form">
                                    <div class="form-group">
                                        <label class="bold-text" for="full-name">Change fullname</label>
                                        <input type="text" name="fullname" placeholder="New fullname" id="fullname">
                                        <p id="fullname-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="bold-text" for="username">Change username</label>
                                        <input type="text" name="username" placeholder="New username" id="username">
                                        <p id="username-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="bold-text" for="picture_url">Change profile picture</label>
                                        <input type="file" name="picture_url" id="picture_url" accept="image/png, image/jpeg"> <!-- Tambahkan input file untuk unggah foto profil -->
                                        <p id="profile-picture-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" class="button black-button bold-text">Save</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Change password tab -->
                            <div class="form" id="Pass">
                                <form class="password-form">
                                    <div class="form-group">
                                        <label class="bold-text" for="password">Pick a new password!</label>
                                        <input type="password" name="password" placeholder="New password" id="password" autocomplete="on">
                                        <p id="password-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="bold-text" for="confirm-password">Confirm your new password!</label>
                                        <input type="password" name="confirm-password" placeholder="Enter your new password again." id="confirm-password" autocomplete="on">
                                        <p id="confirm-password-alert" class="alert-hide"></p>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit-password" class="button black-button bold-text">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="f"></div>
            </main>
        </div>
    </div>
</body>

</html>