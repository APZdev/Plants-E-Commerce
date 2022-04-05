<?php require_once('../../utilities.php'); ?>
    
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/website/graphics/img/favicon.ico">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/global.css">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/authentication-modal.css">
        <link rel="stylesheet" href="../css/shopping-cart-modal.css">
        <link rel="stylesheet" href="../css/selected-product.css">
        <link rel="stylesheet" href="../css/footer.css">

        <script type="module" src="../js/utilities.js"></script>
        <script type="module" src="../js/selected-product.js"></script>
    </head>
    <body>
        <header>
            <?php include '../components/navbar.php'; ?>
            <?php include '../components/authentication-modal.php'; ?>
            <?php include '../components/shopping-cart-modal.php'; ?>
        </header>
        <main>
            <?php
                if(isset($_GET['product_id']) && $_GET['product_id'] != "")
                {
                    $productInfo = $customRequest->getData(
                        "SELECT p.name, p.short_description, p.price_excl_tax, t.rate AS tax_rate, i.url AS image_url
                        FROM product p 
                        LEFT JOIN (tax t CROSS JOIN image i) ON (p.tax_id = t.tax_id AND p.image_id = i.image_id)
                        WHERE p.product_id = {$_GET['product_id']};
                    ")[0];
    
                    setTabTitle($productInfo['name']);
                }
            ?>
            <div class="product_informations_main_container">
                <div class="name_description_price_buy_container">
                    <p class="quality_band_title">100% QUALITY, 100% SATISFACTION</p>
                    <p class="product_name_title"><?= $productInfo['name'] ?></p>
                    <p class="product_description"><?= $productInfo['short_description'] ?></p>
                    <p class="price_title">Price</p>
                    <p class="price_value"><?= ($productInfo['price_excl_tax'] + ($productInfo['price_excl_tax'] * $productInfo['tax_rate'] / 100)) ?> $</p>
                    <div class="add_to_cart_button" data-id="<?= $_GET['product_id'] ?>">Add to Cart</div>
                </div>
                <div class="design_image_container">
                    <img src="<?= $productInfo['image_url'] ?>" alt="product_image" class="product_image">
                    <img src="/website/graphics/img/thick-design-circle.png" alt="design_image" class="design_ring">
                </div>
                <div class="more_offers_container">
                    <div class="more_offer_item">
                        <div class="more_offer_item_image_container">
                            <img src="/website/graphics/img/plant1.png" alt="product_image" class="more_product_image">
                            <img src="/website/graphics/img/thick-design-circle.png" alt="design_image" class="more_design_ring">
                        </div>
                        <p class="more_offer_product_name">Tropical Livingroom Plant</p>
                    </div>
                    <div class="more_offer_item">
                        <div class="more_offer_item_image_container">
                            <img src="/website/graphics/img/plant1.png" alt="product_image" class="more_product_image">
                            <img src="/website/graphics/img/thick-design-circle.png" alt="design_image" class="more_design_ring">
                        </div>
                        <p class="more_offer_product_name">Tropical Livingroom Plant</p>
                    </div>
                    <div class="more_offer_item">
                        <div class="more_offer_item_image_container">
                            <img src="/website/graphics/img/plant1.png" alt="product_image" class="more_product_image">
                            <img src="/website/graphics/img/thick-design-circle.png" alt="design_image" class="more_design_ring">
                        </div>
                        <p class="more_offer_product_name">Tropical Livingroom Plant</p>
                    </div>
                    <i class="more_arrow_button far fa-arrow-down"></i>
                </div>
            </div>
        </main>
        <footer>
            <?php include '../components/footer.php'; ?>
        </footer>
    </body>
</html>