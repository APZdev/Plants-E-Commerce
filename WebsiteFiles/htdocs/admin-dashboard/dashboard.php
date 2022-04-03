<?php require_once('./../utilities.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/website/graphics/img/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/website/css/reset.css">
    <link rel="stylesheet" href="/website/css/all.css">
    <link rel="stylesheet" href="/admin-dashboard/css/dashboard.css">
    <link rel="stylesheet" href="/admin-dashboard/css/navbar.css">
    <link rel="stylesheet" href="/admin-dashboard/css/product-panel.css">
    <link rel="stylesheet" href="/admin-dashboard/css/order-panel.css">
    <link rel="stylesheet" href="/admin-dashboard/css/user-panel.css">
    <link rel="stylesheet" href="/admin-dashboard/css/event-panel.css">
    <link rel="stylesheet" href="/admin-dashboard/css/thread-panel.css">
    <link rel="stylesheet" href="/admin-dashboard/css/activity-panel.css">
    
    <script src="/admin-dashboard/js/dashboard.js" defer></script>
</head>

<body>
    <div class="dashboard_container">
        <?php include './components/navbar.php'; ?>
        <div class="main_content">
            <?php
                session_start();
                //Check if admin is logged in
                if (isset($_SESSION['adminLoggedInToTropicalInterior.shop']) && $_SESSION['adminLoggedInToTropicalInterior.shop'] == true) {
                    //Update content based on current page
                    if($_GET['page'] == "product-panel")
                        include('./pages/product-panel.php');
                    else if($_GET['page'] == "order-panel")
                        include('./pages/order-panel.php');
                    else if($_GET['page'] == "user-panel")
                        include('./pages/user-panel.php');
                    else if($_GET['page'] == "event-panel")
                        include('./pages/event-panel.php');
                    else if($_GET['page'] == "thread-panel")
                        include('./pages/thread-panel.php');
                    else if($_GET['page'] == "activity-panel")
                        include('./pages/activity-panel.php');
                } 
                else 
                {
                    //If not logged in, redirect to login page
                    header('Location: ./login.php');
                    exit;
                }
            ?>
        </div>
    </div>
    <div class="product_modal closed">
        <div class="delete_product_modal_content_container">
            <p class="modal_description">Are you sure you want to remove "Product Name" ?</p>
            <div class="modal_button_container">
                <button type="button" class="close_modal_btn" data-dismiss="modal">Cancel</button>
                <button name="delete_product" data-id="" type="submit" class="delete_product_btn">Remove
                    Product</button>
            </div>
        </div>
        <div class="modify_product_modal_content_container">
            <div class="modal_content">Content</div>
            <div class="modal_button_container">
                <button type="button" class="close_modal_btn" data-dismiss="modal">Cancel</button>
                <button name="modify_product" data-id="" type="submit" class="modify_product_btn">Save</button>
            </div>
        </div>
    </div>
</body>

</html>