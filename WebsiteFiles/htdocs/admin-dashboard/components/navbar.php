<div class="navbar-container">
    <img class="navbar-logo" width="90px" height="90px" src="/website/graphics/img/logo.png" alt="logo">
    <div class="navbar_item_container">
        <?php 
            function isNavbarButtonSelected($getName)
            {
                echo $_GET['page'] == $getName ? "selected" : "";
            }
        ?>
        <a href="/admin-dashboard/dashboard.php?page=product-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("product-panel"); ?>">
                <i class="navbar_item_image far fa-seedling"></i>
                <h2 class="navbar_item_title selected">Products</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=command-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("command-panel"); ?>">
                <i class="navbar_item_image far fa-shopping-bag"></i>
                <h2 class="navbar_item_title">Commands</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=event-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("event-panel"); ?>">
                <i class="navbar_item_image far fa-calendar-check"></i>
                <h2 class="navbar_item_title">Events</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=forum-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("forum-panel"); ?>">
                <i class="navbar_item_image far fa-comment"></i>
                <h2 class="navbar_item_title">Forum</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=activity-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("activity-panel"); ?>">
                <i class="navbar_item_image far fa-analytics"></i>
                <h2 class="navbar_item_title">Activity</h2>
            </div>
        </a>
    </div>
    <a class="exit_button" href="/admin-dashboard/login.php?session=logout">
        <i class="exit_icon far fa-sign-out-alt"></i>
    </a>
</div>