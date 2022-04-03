<div class="shop_main_container">
    <script src="./js/shop.js" defer></script>
    <div class="design_section_container">
        <div class="title_button_container">
            <p class="graphics_title">Take Care Of The Trees & They Will Take Care Of You.</p>
            <div class="shop_now_button">Shop Now</div>
        </div>
        <div class="design_graphics_container">
            <img src="/website/graphics/img/shop-example-design-product.png" alt="plant-image" class="design_plant_image">
            <img src="/website/graphics/img/shop-design-shape.png" alt="design-shape" class="design_shape_image">
        </div>
    </div>
    <div class="selection_section_main_container">
        <div class="filters_sidebar_container">
            <p class="filter_title">Categories</p>
            <div class="selected filter_category_filter_item">
                <p class="filter_category_filter_name">Home Plants</p>
                <p class="filter_category_filter_amount">(32)</p>
            </div>
            <div class="filter_category_filter_item">
                <p class="filter_category_filter_name">Potter Plants</p>
                <p class="filter_category_filter_amount">(21)</p>
            </div>
            <p class="filter_title">Price Range</p>
            <div class="filter_range_wrapper">
                <div class="filter_range_values">
                    <p id="range-1">0</p>
                    <p id="range-2">100</p>
                </div>
                <div class="double-range-slider-container">
                    <div class="slider-track"></div>
                    <input type="range" min="0" max="100" value="0" id="slider-1" oninput="slideOne()">
                    <input type="range" min="0" max="100" value="100" id="slider-2" oninput="slideTwo()">
                </div>
            </div>
        </div>
        <div class="sort_results_products_container">
            <div class="sort_results_container">
                <input type="text" placeholder="Keywords..." class="sort_search_bar">
                <select class="sort_by_dropdown" name="sorting_dropdown" class="sorting_dropdown">
                    <option value="Name_A_To_Z">Sort by: A-Z</option>
                    <option value="Name_Z_To_A">Sort by: Z-A</option>
                    <option value="Price_Low_To_High">Sort by: Low to High</option>
                    <option value="Price_High_To_Low">Sort by: High to Low</option>
                </select>
                <p class="showing_results">Showing 1-12 of 26 results</p>
            </div>
            <div class="products_grid_container">
                <?php
                $products = $customRequest->getData(
                    "SELECT p.product_id, p.name, p.price_excl_tax, t.rate AS tax_rate, i.url AS image_url
                    FROM product p 
                    LEFT JOIN (tax t CROSS JOIN image i) ON (p.tax_id = t.tax_id AND p.image_id = i.image_id);
                    ");
                ?>
                <?php foreach($products as $product) { ?>
                    <a href="/website/pages/selected-product.php?product_id=<?= $product['product_id'] ?>" class="product_card_item">
                        <img class="product_card_image"src="<?= $product['image_url'] ?>" alt="product_image">
                        <p class="product_card_name"><?= $product['name'] ?></p>
                        <p class="product_card_price"><?= ($product['price_excl_tax'] + ($product['price_excl_tax'] * $product['tax_rate'] / 100)) ?> $</p>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>