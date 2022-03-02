<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');
        if(isset($_POST['login_authentication']) && $_POST['login_authentication'])
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            //Prevent SQL injection
            $email = $db->con->real_escape_string($email);
            $password = $db->con->real_escape_string($password);
            $password = hash('sha256', $password);

            $query = "SELECT * FROM customer WHERE email='{$email}' AND password='{$password}' LIMIT 1";
            
            $result = $db->con->query($query);
            
            session_start();
            if($result->num_rows == 1)
            {
                //Redirect to admin pannel
                //$row = mysqli_fetch_array($result);
                $_SESSION['loggedInToTropicalInterior.shop'] = true;
                $_SESSION['email'] = $email;
                header('Location: /index.php?page=home');
                exit;

                //Reset session details on wrong credentials
                //$_SESSION['loggedInToTropicalInterior.shop'] = false;
                //$_SESSION['email'] = "";
            }
            else
            {
                echo "wrong credentials";
                return;
            }
        }
        else if(isset($_POST['register_authentication']) && $_POST['register_authentication'])
        {
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm-password"];
            
            //Prevent SQL injection
            $firstName = $db->con->real_escape_string($firstName);
            $lastName = $db->con->real_escape_string($lastName);
            $email = $db->con->real_escape_string($email);
            $password = $db->con->real_escape_string($password);
            $confirmPassword = $db->con->real_escape_string($confirmPassword);
            
            $error = 0;

            $error = $password != $confirmPassword ? 1 : 0;

            //$emailCheck = $db->con->query("SELECT * FROM customer WHERE email={$email} LIMIT 1");
            //$error = $emailCheck->num_rows > 0 ? 2 : 0;

            if($error == 1)
            {
                header("Location: /website/index.php?page=home&authentication=register&error=Confirmation password doesn't must be identical");
                exit;
            }
            else if($error == 2)
            {
                header("Location: /website/index.php?page=home&authentication=register&error=Email is already used");
                exit;
            }
            else
            {
                //Generate Vkey
                $vkey = md5(time().$firstName);
                
                $password = hash('sha256', $password);
                $query = 
                "INSERT INTO customer (firstname, lastname, email, password, vkey, verified, registration_date, update_date) 
                 VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$vkey}', 0, NOW(), NOW());";
                
                $result = $db->con->multi_query($query);
                
                if($result)
                {
                    $finalIP = getDomain();

                    $to = $email;
                    $subject = "Email Verification";
                    $message = "<a href='{$finalIP}/website/pages/email-verification.php?page=verify&vkey={$vkey}'>Verify Now</a>";
                    $header = "From: tropicalinteriorbusiness@gmail.com \r\n";
                    $header .= "MIME-Version: 1.0" . "\r\n";
                    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
                    mail($to, $subject, $message, $header);
    
                    header("Location: /website/pages/email-verification.php?page=email-sent&email={$email}");
                    exit;
                }
            }
        }
    }
    echo "<p>Something went wrong...</p>";
?>