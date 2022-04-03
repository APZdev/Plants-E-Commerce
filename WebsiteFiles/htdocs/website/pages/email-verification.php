<?php require_once('./../../utilities.php') ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./../css/reset.css">
    <link rel="stylesheet" href="./../css/all.css">
    <link rel="stylesheet" href="./../css/navbar.css">
    <link rel="stylesheet" href="./../css/email-verification.css">
    <link rel="stylesheet" href="./../css/footer.css">
</head>

<body>
    <main>
        <div class="info_container">
        <?php
            if(isset($_GET['page']))
            {
                if($_GET['page'] == "email-sent" && isset($_GET['email']))
                {
                    $email = $_GET['email'];
                    echo "
                        <p>Thank you for registering. We have sent a verification email to <strong>{$email}</strong></p>
                        <i class='email_icon_indicator fal fa-envelope'></i>
                        <p>You will be redirected shortly...</p>";

                        header( "refresh:6; url=/website/index.php?page=home" ); 
                        exit;
                }
                else if($_GET['page'] == "verify" && isset($_GET['vkey']))
                {
                    $vkey = $_GET['vkey'];
                    $query = "SELECT verified, vkey FROM customer WHERE vkey='{$vkey}' LIMIT 1";
            
                    $result = $db->con->query($query);
                    
                    if($result->num_rows == 1)
                    {
                        $row = mysqli_fetch_array($result);
                        if($row['verified'])
                        {
                            echo "
                            <p>Your account has already been verified</p>
                            <i class='email_icon_indicator fal fa-envelope-open'></i>
                            <p>Redirecting in few seconds...</p>";

                            header( "refresh:3; url=/website/index.php?page=home&authentication=login" ); 
                            exit;
                        }
                        else
                        {
                            $update = $db->con->query("UPDATE customer SET verified=1 WHERE vkey='{$vkey}' LIMIT 1");
                            if($update)
                            {
                                echo "
                                <p>Your account has been successfully verified</p>
                                <i class='email_icon_indicator fal fa-envelope-open'></i>
                                <p>Redirecting in few seconds...</p>";
                                      
                                header( "refresh:3; url=/website/index.php?page=home&authentication=login" ); 
                                exit;
                            }
                        }
                    }
                }
            }
            echo "<p>Something went wrong...</p>";
        ?>
        </div>
    </main>
    <footer>
        <?php include './../components/footer.php'; ?>
    </footer>
</body>

</html>