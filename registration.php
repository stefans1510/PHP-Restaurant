<?php
require_once 'notifications.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration form</title>
    <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">
    <link rel="shortcut icon" type="image/png" href="img/favicon.img">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
    <a href="index.php">
        <div class="close-container">
            <div class="leftright"></div>
            <div class="rightleft"></div>
            <label class="close">close</label>
        </div>
    </a </header>

    <body>
        <?php notification('register') ?>
        <div class="wrapper" style="width: 700px;">
            <div class="title-text">
                <div class="title login">
                    Registration Form
                </div>
            </div>
            <div class="form-container">
                <div class="form-inner">
                    <form method="post" action="UserController.php">
                        <input type="hidden" name="action" value="register">
                        <div class="field">
                            <input type="text" name="name" placeholder="Name" autofocus required>
                        </div>
                        <div class="field">
                            <input type="text" name="username" placeholder="Username" pattern="[A-Za-z0-9]{4,}" title="Must contain at least 4 characters. Letters and numbers only" autofocus required>
                        </div>
                        <div class="field">
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="field">
                            <input type="text" name="address" placeholder=" Home Address" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password_1" placeholder="Password" pattern="[A-Za-z0-9]{6,}" title="Must contain at least 6 characters. Letters and numbers only" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password_2" placeholder="Repeat password" required>
                        </div><br>
                        <button type="submit" name="submit" class="btn">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>