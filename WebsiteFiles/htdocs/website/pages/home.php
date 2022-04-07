<?php sendActivityLog($db, "Visit : Home Page"); ?>
<div class="home_main_container">
    <div class="main_container_presentation">
        <div class="main_container_main_content">
            <h2 class="main_content_hashtag">#ORNAMENTAL PLANT</h2>
            <h1 class="main_content_title">Various Indoor Plant Shop</h1>
            <p class="main_content_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consectetur aliquam felis sed auctor.</p>
            <div class="main_content_btn_container">
                <button class="main_content_btn cart_btn">Add To Cart</button>
                <button class="main_content_btn more_btn">Learn More</button>
            </div>
        </div>
        <div class="main_container_graphics_container">
            <div class="graphics_images_block_container">
                <div class="graphics_images_container">
                    <img class="graphics_item_background" src="./graphics/img/ring-bg.png" alt="plant_image">
                    <img class="graphics_item_plant" src="./graphics/img/plant1.png" alt="plant_image">
                </div>
            </div>
            <div class="graphics_label_container">
                <img class="graphics_label_premium_icon" src="./graphics/img/premium-icon.png" alt="premium_icon">
                <div class="graphics_label_text_container">
                    <h2 class="graphics_label_title">Best Sell IndoorPlant</h2>
                    <p class="graphics_label_description">Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="products_container">
        <?php
            $map = ['foo', 'Severin Candrian', 'Lorem Ipsum is simply dummy text.', 59.99];

            for ($i = 0; $i < 4 ; $i++) {
                $isSpecial = $i == 0 ? " special" : "";
                $addButton = $i == 0 ? '<button class="card_item_add_button">Add to Cart</button>' : "";

                echo 
                '                
                <div class="card_item'.$isSpecial.'">
                    <img class="card_item_image'.$isSpecial.'" src="./graphics/img/plant'.(4 + $i).'.png" alt="plant_image">
                    <div class="card_item_info_container'.$isSpecial.'">
                        <h3 class="card_item_title'.$isSpecial.'">'.$map[1].'</h3>
                        <p class="card_item_description'.$isSpecial.'">'.$map[2].'</p>
                        <h2 class="card_item_price'.$isSpecial.'">$'.$map[3].'</h2>
                        '.$addButton.'
                    </div>
                </div>
                ';
            }
        ?>
    </div>
</div>