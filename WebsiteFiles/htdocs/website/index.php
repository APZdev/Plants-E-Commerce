<?php require_once('./../utilities.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./graphics/img/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/authentication-modal.css">
    <link rel="stylesheet" href="./css/shopping-cart-modal.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/shop.css">
    <link rel="stylesheet" href="./css/footer.css">


    <script src="./js/index.js" defer></script>
</head>

<body>
    <header>
        <?php include './components/navbar.php'; ?>
        <?php include './components/authentication-modal.php'; ?>
        <?php include './components/shopping-cart-modal.php'; ?>
    </header>
    <main>
        <?php
                //Update content based on current page
                if(isset($_GET['page']))
                {
                    if($_GET['page'] == "home")
                    {
                        include('./pages/home.php');
                        setTabTitle("Home");
                    }
                    else if($_GET['page'] == "shop")
                    {
                        include('./pages/shop.php');
                        setTabTitle("Shop");
                    }
                    else if($_GET['page'] == "events")
                    {
                        include('./pages/events.php');
                        setTabTitle("Events");
                    }
                    else if($_GET['page'] == "thread")
                    {
                        include('./pages/thread.php');
                        setTabTitle("Threads");
                    }
                    else if($_GET['page'] == "contact-us")
                    {
                        include('./pages/contact-us.php');
                        setTabTitle("Contact Us");
                    }
                }
            ?>
    </main>
    <footer>
        <?php include './components/footer.php'; ?>
    </footer>
</body>

</html>