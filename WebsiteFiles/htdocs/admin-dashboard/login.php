<?php require_once('./../utilities.php') ?>
<html> 
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="/admin-dashboard/css/authentication.css">
    </head>
    <body>
        <div>
            <?php 
                //Destroy session if admin clicked logout button in the dashboard
                if(isset($_GET['session']) && $_GET['session'] == 'logout') 
                {
                    session_start();
                    session_destroy(); 
                }
            ?>
            <form class="form-container" action="/admin-dashboard/post/authentication.php" method="post">
                <h1 class="form-container-title">Admin Dashboard</h1>
                <p class="email-title">Email</p>
                <input class="email-input" type="text" autocomplete="username" name="email" value="" placeholder="Email">
                <p class="password-title">Password</p>
                <input class="password-input" type="password" autocomplete="current-password" name="password" placeholder="Password">
                <?php 
                    if(isset($_GET['message']) && !empty($_GET['message']))
                        echo '<h3 class="error-message">' . htmlspecialchars($_GET['message']) . '</h3>';
                ?>
                <input class="submit-button" type="submit" value="Login">
            </form>
        </div>
    </body>
 </html>