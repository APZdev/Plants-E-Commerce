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
        <a href="/admin-dashboard/dashboard.php?page=order-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("order-panel"); ?>">
                <i class="navbar_item_image far fa-shopping-bag"></i>
                <h2 class="navbar_item_title">Orders</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=user-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("user-panel"); ?>">
                <i class="navbar_item_image far fa-user"></i>
                <h2 class="navbar_item_title">Users</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=event-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("event-panel"); ?>">
                <i class="navbar_item_image far fa-calendar-check"></i>
                <h2 class="navbar_item_title">Events</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=thread-panel">
            <div class="navbar_item <?php isNavbarButtonSelected("thread-panel"); ?>">
                <i class="navbar_item_image far fa-comment"></i>
                <h2 class="navbar_item_title">Threads</h2>
            </div>
        </a>
        <a href="/admin-dashboard/dashboard.php?page=activity-panel&type=list">
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