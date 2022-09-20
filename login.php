<?php
require_once 'notifications.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login form</title>
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
        <?php notification('login') ?>
        <div class="wrapper" style="width: 700px;">
            <div class="title-text">
                <div class="title login">
                    Login Form
                </div>
            </div>
            <div class="form-container">
                <div class="form-inner">
                    <form method="post" action="UserController.php">
                        <input type="hidden" name="action" value="login">
                        <div class="field">
                            <input type="text" name="username/email" placeholder="Email or Username" autofocus required>
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="pass-link">
                            <a href="reset-password.php">Forgot password?</a>
                        </div><br>
                        <button type="submit" name="submit" class="btn">Sign Up</button>
                        <div class="signup-link">
                            Not a member? <a href="registration.php">Sign up now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>