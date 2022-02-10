<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $r_email = "admin@site.com";
        $r_password = "php123";
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email))  //Check email
        {
            if($email == $r_email && $password == $r_password)
            {
                setcookie('email', $email, time()+3600, "/");
                header('Location: ../pages/index.php');
                exit;
            }
            else
            {
                header('Location: ../pages/login.php?message=Identifiants incorrects.&email=' . $email . '');
                exit;
            }
        }
        else
        {
            header('Location: ../pages/login.php?message=Email invalide.');
            exit;
        }
    }
?>