<?php require('./utilities.php') ?>
<div class='navbar'>
    <div>
        <a href="/index.php">
            <img width="90px" height="90px" src="/website/graphics/img/logo.png" alt="logo">
        </a>
    </div>
    <div class="pages-button-container">
        <a class="page-btn" href="/index.php">Shop</a>
        <a class="page-btn" href="/index.php">Events</a>
        <a class="page-btn" href="/index.php">Forum</a>
        <a class="page-btn" href="/index.php">Contact Us</a>
    </div>
    <div class="icons-container">
        <img width="22px" height="22px" src="/website/graphics/svg/search-icon.svg" alt="search-icon">
        <img width="22px" height="22px" src="/website/graphics/svg/shopping-cart-icon.svg" alt="shopping-cart-icon">
        <a href="/login.php"><img width="22px" height="22px" src="/website/graphics/svg/user-icon.svg" alt="user-icon"></a>
        <div class="dark_mode_toggle_container">
            <input type="checkbox" class="checkbox" id="chk" />
            <label class="label" for="chk">
                <div class="ball"></div>
            </label>
        </div>
    </div>
</div>