<div class='navbar'>
    <?php 
        function currentPage($getName){
            echo $_GET['page'] == $getName ? "selected" : "";
        }
    ?>
    <div>
        <a href="index.php?page=home">
            <img width="90px" height="90px" src="/website/graphics/img/logo.png" alt="logo">
        </a>
    </div>
    <div class="pages-button-container">
        <a class="page-btn <?php currentPage("shop"); ?>" href="index.php?page=shop">Shop</a>
        <a class="page-btn <?php currentPage("events"); ?>" href="index.php?page=events">Events</a>
        <a class="page-btn <?php currentPage("forum"); ?>" href="index.php?page=forum">Forum</a>
        <a class="page-btn <?php currentPage("contact-us"); ?>" href="index.php?page=contact-us">Contact Us</a>
    </div>
    <div class="icons-container">
        <i class="far fa-search"></i>
        <i class="far fa-shopping-cart"></i>
        <i class="authentication_modal_navbar_button far fa-user"></i>
        <div class="dark_mode_toggle_container">
            <input type="checkbox" class="checkbox" id="chk" />
            <label class="label" for="chk">
                <div class="ball"></div>
            </label>
        </div>
    </div>
</div>