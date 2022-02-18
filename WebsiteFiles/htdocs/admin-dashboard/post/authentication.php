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

        if($result->num_rows == 1)
        {
            //Redirect to admin pannel
        }
        else
        {
            header('Location: ./../login.php?message=Incorrect credentials.&email=' . $email . '');
        }


        //filter_var($email, FILTER_VALIDATE_EMAIL)
        //header("Location: {$base_dir}login.php");
        //exit;
        //!empty($email)

    }
?>