<html> 
    <head>
        <link rel="stylesheet" href="../css/connexion-form.css">
    </head>
    <body>
        <form class="form-container" action="../post/verification.php" method="post">
            <p class="email-title">Email</p>
            <?php echo '<input class="email-input" type="text" name="email" value="' . $_GET['email'] . '" placeholder="Enter Email"><br>'; ?>
            <p class="password-title">Password</p>
            <input class="password-input" type="text" name="password" placeholder="Enter Password"><br>
            <?php 
                if(isset($_GET['message']) && !empty($_GET['message']))
                {
                    echo '<h3 class="error-message">' . htmlspecialchars($_GET['message']) . '</h3>';
                }
            ?>
            <input class="submit-button" type="submit" value="Login">
        </form>
    </body>
 </html>
