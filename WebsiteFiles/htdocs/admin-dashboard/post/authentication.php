<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once(__DIR__.'/../../utilities.php');

        $email = $_POST["email"];
        $password = $_POST["password"];


        //Prevent SQL injection
        $email = $db->con->real_escape_string($email);
        $password = $db->con->real_escape_string($password);

        $query = "SELECT * FROM admin_user WHERE email='".$email."' AND password='".$password."' LIMIT 1";

        $result = $db->con->query($query);

        session_start();
        if($result->num_rows == 1)
        {
            //Redirect to admin pannel
            $_SESSION['adminLoggedInToTropicalInterior.shop'] = true;
            $_SESSION['email'] = $email;
            header('Location: ./../dashboard.php?page=product-panel');
            exit;
        }
        else
        {
            //Reset session details on wrong credentials
            $_SESSION['adminLoggedInToTropicalInterior.shop'] = false;
            $_SESSION['email'] = "";
            header('Location: ./../login.php?message=Incorrect email or password.&email=' . $email . '');
            exit;
        }


        //filter_var($email, FILTER_VALIDATE_EMAIL)
        //header("Location: {$base_dir}login.php");
        //exit;
        //!empty($email)

    }
?>