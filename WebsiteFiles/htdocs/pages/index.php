<html> 
    <head>
        <title>Accueil with PHP</title>
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/footer.css">
    </head>
    <body>
        <?php include '../components/header.php'; ?>
        <main class="main_container">
            <div class="main_container_main_content">
                <h2 class="main_content_hashtag">#ORNAMENTAL PLANT</h2>
                <h1 class="main_content_title">Various Indoor Plant Shoop</h1>
                <p class="main_content_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam consectetur aliquam felis sed auctor.</p>
                <div class="main_content_btn_container">
                    <button class="main_content_cart_btn">Add To Cart</button>
                    <button class="main_content_more_btn">Learn More</button>
                </div>
            </div>
            <div class="main_container_graphics_container">
                <div class="graphics_images_block_container">
                    <div class="graphics_images_container">
                        <img class="graphics_item_background" src="../graphics/img/ring-bg.png" alt="plant_image">
                        <img class="graphics_item_plant" src="../graphics/img/plant1.png" alt="plant_image">
                    </div>
                </div>
                <div class="graphics_label_container">
                    <img class="graphics_label_premium_icon" src="../graphics/img/premium-icon.png" alt="premium_icon">
                    <div class="graphics_label_text_container">
                        <h2 class="graphics_label_title">Best Sell IndoorPlant</h2>
                        <p class="graphics_label_description">Lorem ipsum dolor sit amet, consectetur.</p>
                    </div>
                </div>
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