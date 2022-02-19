<?php require('./utilities.php') ?>
<div class='navbar'>
    <div>
        <a href="/index.php">
            <img width="90px" height="90px" src="/website/graphics/img/logo.png" alt="logo">
        </a>
    </div>
    <div class="pages-button-container">
        <a class="page-btn selected" href="/index.php">Shop</a>
        <a class="page-btn" href="/index.php">Events</a>
        <a class="page-btn" href="/index.php">Forum</a>
        <a class="page-btn" href="/index.php">Contact Us</a>
    </div>
    <div class="icons-container">
        <i class="far fa-search"></i>
        <i class="far fa-shopping-cart"></i>
        <a href="/login.php"><i class="far fa-user"></i></a>
        <div class="dark_mode_toggle_container">
            <input type="checkbox" class="checkbox" id="chk" />
            <label class="label" for="chk">
                <div class="ball"></div>
            </label>
        </div>
    </div>
</div>