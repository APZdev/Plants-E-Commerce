<?php require_once('../../utilities.php'); ?>
    
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/website/graphics/img/favicon.ico">
        <?php setTabTitle("Preview Order");?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/global.css">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/authentication-modal.css">
        <link rel="stylesheet" href="../css/preview-order.css">
        <link rel="stylesheet" href="../css/shopping-cart-modal.css">
        <link rel="stylesheet" href="../css/footer.css">

        <script type="module" src="../js/utilities.js"></script>
        <script type="module" src="../js/preview-order.js"></script>
    </head>
    <body>
        <header>
            <?php include '../components/navbar.php'; ?>
            <?php include '../components/authentication-modal.php'; ?>
            <?php include '../components/shopping-cart-modal.php'; ?>
        </header>
        <!-- Shopping cart items fetched using POST req -->
    </body>
</html>