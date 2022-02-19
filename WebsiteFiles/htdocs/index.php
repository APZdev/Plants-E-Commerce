<html> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        
        <link rel="stylesheet" href="./website/css/reset.css">
        <link rel="stylesheet" href="./website/css/index.css">
        <link rel="stylesheet" href="./website/css/header.css">
        <link rel="stylesheet" href="./website/css/footer.css">
        <link rel="stylesheet" href="./website/css/all.css">

        <script src="./website/js/index.js" defer></script>
    </head>
    <body>
        <?php include './website/components/header.php'; ?>
        <main class="main_container">
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
                            <img class="graphics_item_background" src="./website/graphics/img/ring-bg.png" alt="plant_image">
                            <img class="graphics_item_plant" src="./website/graphics/img/plant1.png" alt="plant_image">
                        </div>
                    </div>
                    <div class="graphics_label_container">
                        <img class="graphics_label_premium_icon" src="./website/graphics/img/premium-icon.png" alt="premium_icon">
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
                            <img class="card_item_image'.$isSpecial.'" src="./website/graphics/img/plant'.(4 + $i).'.png" alt="plant_image">
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
        </main>
        <!-- 
            <?php 
            if(!isset($_COOKIE['email'])) {
                //Email not set
                echo '<h1 class="welcome-title">Contenu non disponible</h1>';
            }
            else
            {
                echo '<h2 class="welcome-title">Logged in with ';
                echo $_COOKIE["email"];
                echo '</h2>';
                echo '<h1 class="welcome-title">Contenu privé</h1>';
            }
        ?> 
        -->
    </body>
 </html>