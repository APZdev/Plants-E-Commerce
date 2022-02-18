<html> 
    <head>
        <link rel="stylesheet" href="/website/css/authentication-form.css">
    </head>
    <body>
        <form class="form-container" action="/website/post/verification.php" method="post">
            <p class="email-title">Email</p>
            <input class="email-input" type="text" name="email" value="" placeholder="Enter Email">
            <p class="password-title">Password</p>
            <input class="password-input" type="text" name="password" placeholder="Enter Password"><br>
            <?php 
                if(isset($_GET['message']) && !empty($_GET['message']))
                    echo '<h3 class="error-message">' . htmlspecialchars($_GET['message']) . '</h3>';
            ?>
            <input class="submit-button" type="submit" value="Login">
        </form>
    </body>
 </html>
