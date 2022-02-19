<?php require('./../utilities.php') ?>
<html> 
    <head>
        <title>Admin Dashboard</title>

        <link rel="stylesheet" href="/website/css/reset.css">
        <link rel="stylesheet" href="/website/css/all.css">
        <link rel="stylesheet" href="/admin-dashboard/css/dashboard.css">
        <link rel="stylesheet" href="/admin-dashboard/css/navbar.css">
        <link rel="stylesheet" href="/admin-dashboard/css/product-panel.css">
        <link rel="stylesheet" href="/admin-dashboard/css/command-panel.css">
        <link rel="stylesheet" href="/admin-dashboard/css/event-panel.css">
        <link rel="stylesheet" href="/admin-dashboard/css/forum-panel.css">
        <link rel="stylesheet" href="/admin-dashboard/css/activity-panel.css">

        <script src="/admin-dashboard/js/dashboard.js" defer></script>
    </head>
    <body>
        <div class="main_content">
            <?php include './components/navbar.php'; ?>
            <?php
                session_start();

                //Check if admin is logged in
                if (isset($_SESSION['adminLoggedInToTropicalInterior.shop']) && $_SESSION['adminLoggedInToTropicalInterior.shop'] == true) {
                    //Update content based on current page
                    if($_GET['page'] == "product-panel")
                        include('./pages/product-panel.php');
                    else if($_GET['page'] == "command-panel")
                        include('./pages/command-panel.php');
                    else if($_GET['page'] == "event-panel")
                        include('./pages/event-panel.php');
                    else if($_GET['page'] == "forum-panel")
                        include('./pages/forum-panel.php');
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
    </body>
 </html>