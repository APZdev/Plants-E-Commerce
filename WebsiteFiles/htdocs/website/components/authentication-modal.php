<?php
    $modalOpened =  0;
    $register = 0;

    if(isset($_GET['authentication']))
    { 
        $register = $_GET['authentication'] == "register" ? 1 : 0;
        $modalOpened =  1;
    }
?>
<script src="/website/js/captcha.js" defer></script>
<script src="/website/js/authentication-modal.js" defer></script>
<div class="authentication_modal_container <?php echo $modalOpened ? "" : "closed"; ?>">
    <div class="authentication_modal_content_container">
        <i class="close_button far fa-times"></i>
        <div class="modal_design_container">
            <div class="modal_design_info_content">
                <p class="modal_design_title">Welcome to Tropical Interior</p>
                <p class="modal_design_description">Shop all the tropical plants</p>
            </div>
            <img class="design_image" src="/website/graphics/img/authentication_design_image.png"
                alt="design plant image">
        </div>
        <div class="authentication_form_container">
            <div class="form_category_buttons_container">
                <button class="authentication_login_button selected">Login</button>
                <button class="authentication_register_button">Register</button>
            </div>
            <div class="form_category_design_bar <?php echo $register ? "selected" : ""; ?>"></div>
            <div class="authentication_form_fields_container <?php echo $register ? "switched" : ""; ?>">
                <div class="form_login_field_container">
                    <form class="login_form_container" action="/website/post/authentication.php" method="post">
                        <p class="email_title">Email</p>
                        <input class="email_input" type="text" name="email" value="" placeholder="Email">
                        <p class="password_title">Password</p>
                        <input class="password_input" type="password" name="password" placeholder="Password">
                        <?php 
                            if(isset($_GET['message']) && !empty($_GET['message']))
                                echo '<h3 class="error-message">' . htmlspecialchars($_GET['message']) . '</h3>';
                        ?>
                        <div class="form_helpers_container">
                            <div class="checkbox_container">
                                <input class="login_rememberme_checkbox" type="checkbox">
                                <p class="rememberme_title">Remember me</p>
                            </div>
                            <p class="forgot_password_btn">Forgot Password ?</p>
                        </div>
                        <input class="submit_button" type="submit" name="login_authentication" value="Login">
                        <?php 
                            if(isset($_GET['authentication']) && $_GET['authentication'] == "login" && isset($_GET['error']))
                                echo '<p class="error_message">'. $_GET['error'] .'</p>';
                        ?>
                    </form>
                </div>
                <div class="form_register_field_container">
                    <form class="login_form_container" action="/website/post/authentication.php" method="post">
                        <div class="fistlastname_container">
                            <div>
                                <p class="firstname_title">First Name</p>
                                <input class="firstname_input" type="text" name="firstname" value=""
                                    placeholder="First Name">
                            </div>
                            <div>
                                <p class="lastname_title">Last Name</p>
                                <input class="lastname_input" type="text" name="lastname" value=""
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <p class="email_title">Email</p>
                        <input class="email_input" type="text" name="email" value="" placeholder="Email">
                        <p class="password_title">Password</p>
                        <input class="password_input" type="password" name="password" placeholder="Password">
                        <p class="password_title">Confirm Password</p>
                        <input class="confirmpassword_input" type="password" name="confirm-password"
                        placeholder="Confirm Password">
                        <?php 
                            if(isset($_GET['authentication']) && $_GET['authentication'] == "register" && isset($_GET['error']))
                                echo '<p class="error_message">'. $_GET['error'] .'</p>';
                        ?>
                        <div class="captcha_btn_container">
                            <div class="captcha_checkbox_title_container">
                                <div class="captcha_checkbox_container">
                                    <div class="captcha_checkbox"></div>
                                    <i class="captcha_check_icon far fa-check hide"></i>
                                </div>
                                <p class="captcha_title">I'm not a robot</p>
                            </div>
                            <div class="recaptcha_logo_description_container">
                                <img class="recaptcha_logo" src="/website/graphics/img/recaptcha-logo.png"
                                    alt="re-captcha-logo" />
                                <p class="recaptcha_description">Privacy - Terms</p>
                            </div>
                        </div>
                        <input class="submit_button" type="submit" name="register_authentication" value="Register">
                    </form>
                </div>
            </div>
            <div class="captcha_puzzle_container_modal hide">
                <p class="captcha_puzzle_instruction">Sort the boxes in ascending order.</p>
                <div class="draggable_container_content_container">
                    <div class="first_container draggable_container"></div>
                    <div class="second_container draggable_container"></div>
                    <div class="third_container draggable_container"></div>
                    <div class="fourth_container draggable_container"></div>
                </div>
                <div class="draggable_content_container">
                    <div class="starting_draggable_container">
                        <div class="draggables" draggable="true">1</div>
                    </div>
                    <div class="starting_draggable_container">
                        <div class="draggables" draggable="true">2</div>
                    </div>
                    <div class="starting_draggable_container">
                        <div class="draggables" draggable="true">3</div>
                    </div>
                    <div class="starting_draggable_container">
                        <div class="draggables" draggable="true">4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>