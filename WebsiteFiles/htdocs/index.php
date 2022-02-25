<?php require_once('utilities.php') ?>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="./website/css/reset.css">
        <link rel="stylesheet" href="./website/css/all.css">
        <link rel="stylesheet" href="./website/css/navbar.css">
        <link rel="stylesheet" href="./website/css/authentication-modal.css">
        <link rel="stylesheet" href="./website/css/index.css">
        <link rel="stylesheet" href="./website/css/home.css">
        <link rel="stylesheet" href="./website/css/footer.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
        <script src="./website/js/index.js" defer></script>
    </head>
    <body>
        <header>
            <?php include './website/components/navbar.php'; ?>
            <?php include './website/components/authentication-modal.php'; ?>
        </header>
        <main>
            <?php
                //Update content based on current page
                if(isset($_GET['page']))
                {
                    if($_GET['page'] == "home")
                        include('./website/pages/home.php');
                    else if($_GET['page'] == "shop")
                        include('./website/pages/shop.php');
                    else if($_GET['page'] == "events")
                        include('./website/pages/events.php');
                    else if($_GET['page'] == "forum")
                        include('./website/pages/forum.php');
                    else if($_GET['page'] == "contact-us")
                        include('./website/pages/contact-us.php');
                }
            ?>
        </main>
        <footer>
            <?php include './website/components/footer.php'; ?>
        </footer>
    </body>
 </html>