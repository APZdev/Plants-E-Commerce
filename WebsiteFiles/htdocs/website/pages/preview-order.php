<?php require_once('../../utilities.php'); ?>
    
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/website/graphics/img/favicon.ico">
        <?php setTabTitle("Preview Order");?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/global.css">
        <link rel="stylesheet" href="../css/navbar.css">
        <link rel="stylesheet" href="../css/authentication-modal.css">
        <link rel="stylesheet" href="../css/preview-order.css">
        <link rel="stylesheet" href="../css/shopping-cart-modal.css">
        <link rel="stylesheet" href="../css/footer.css">

        <script type="module" src="../js/utilities.js" defer></script>
        <script type="module" src="../js/preview-order.js" defer></script>
    </head>
    <body>
        <header>
            <?php include '../components/navbar.php'; ?>
            <?php include '../components/authentication-modal.php'; ?>
            <?php include '../components/shopping-cart-modal.php'; ?>
        </header>
        <main>
            <div class="preview_order_main_container">
                <div class="top_design_container">
                    <div class="top_design_left_side">
                        <div class="top_left_design_bar"></div>
                    </div>
                    <div class="top_design_right_side">
                    </div>
                </div>
                <div class="products_table_titles_container">
                    <div class="products_product_titles_container">
                        <p class="product_title">PRODUCT</p>
                    </div>
                    <div class="product_price_quantity_total_titles_container">
                        <div class="product_price_quantity_total_titles_container_content">
                            <p class="product_price_title">PRICE</p>
                            <p class="product_quantity_title">QTY</p>
                            <p class="product_total_title">TOTAL</p>
                        </div>
                    </div>
                </div>
                <div class="products_items_content_container">
                    <div class="product_item">
                        <div class="product_item_left_side">
                            <img src="/website/graphics/img/plant1.png" alt="product_plant_image" class="product_item_image">
                            <div class="product_item_name_stock_container">
                                <p class="product_item_name">Carnivorous Plant</p>
                                <p class="product_item_stock">In Stock : 5</p>
                            </div>
                        </div>
                        <div class="product_item_right_side">
                            <div class="product_item_right_side_content">
                                <p class="product_item_unit_price">$ 99.99</p>
                                <div class="quantity_modifier_container">
                                    <p class="quantity_remove_button">-</p>
                                    <input type="number" class="product_item_quantity_input" value="0">
                                    <p class="quantity_add_button">+</p>
                                </div>
                                <p class="product_item_total_price">$ 99.99</p>
                                <i class="product_delete_button fal fa-times"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="product_item_left_side">
                            <img src="/website/graphics/img/plant1.png" alt="product_plant_image" class="product_item_image">
                            <div class="product_item_name_stock_container">
                                <p class="product_item_name">Carnivorous Plant</p>
                                <p class="product_item_stock">In Stock : 5</p>
                            </div>
                        </div>
                        <div class="product_item_right_side">
                            <div class="product_item_right_side_content">
                                <p class="product_item_unit_price">$ 99.99</p>
                                <div class="quantity_modifier_container">
                                    <p class="quantity_remove_button">-</p>
                                    <input type="number" class="product_item_quantity_input" value="0">
                                    <p class="quantity_add_button">+</p>
                                </div>
                                <p class="product_item_total_price">$ 99.99</p>
                                <i class="product_delete_button fal fa-times"></i>
                            </div>
                        </div>
                    </div>  
                    <div class="product_item">
                        <div class="product_item_left_side">
                            <img src="/website/graphics/img/plant1.png" alt="product_plant_image" class="product_item_image">
                            <div class="product_item_name_stock_container">
                                <p class="product_item_name">Carnivorous Plant</p>
                                <p class="product_item_stock">In Stock : 5</p>
                            </div>
                        </div>
                        <div class="product_item_right_side">
                            <div class="product_item_right_side_content">
                                <p class="product_item_unit_price">$ 99.99</p>
                                <div class="quantity_modifier_container">
                                    <p class="quantity_remove_button">-</p>
                                    <input type="number" class="product_item_quantity_input" value="0">
                                    <p class="quantity_add_button">+</p>
                                </div>
                                <p class="product_item_total_price">$ 99.99</p>
                                <i class="product_delete_button fal fa-times"></i>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="before_footer_spacer">
                    <div class="before_footer_spacer_left"></div>
                    <div class="before_footer_spacer_right"></div>
                </div>
                <div class="bottom_design_container">
                    <div class="bottom_design_left_side"></div>
                    <div class="bottom_design_right_side">
                        <div class="bottom_left_design_bar"></div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="subtotal_checkout_footer_container">
                <i class="subtotal_back_button far fa-long-arrow-left"></i>
                <div class="subtotal_checkout_terms_container">
                    <div class="subtotal_price_container">
                        <p class="subtotal_title">SUBTOTAL</p>
                        <p class="subtotal_value">$ 249.96</p>
                    </div>
                    <div class="terms_and_conditions_container">
                        <label class="terms_and_condition_checkbox_container">
                            <input class="terms_and_condition_checkbox" type="checkbox" name="">
                            <span class="terms_and_condition_checkmark"></span>
                        </label>
                        <p class="terms_agreement_text">I agree to <a class="therms_and_condition_link">Terms & Conditions</a></p>
                    </div>
                    <p class="order_checkout_button">CHECKOUT</p>
                </div>
            </div>
        </footer>
    </body>
</html>