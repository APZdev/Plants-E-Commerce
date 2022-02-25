<div class="product_main_container">
    <div class="add_product_section_container">
        <form class="add_product_form_container" runat="server" action="/admin-dashboard/post/product-post.php"
            method="post" enctype="multipart/form-data">
            <h1 class="form_container_title">Add product</h1>
            <p class="info_title">Image</p>
            <div class="add_product_image_selector_container">
                <input id="image_selector" accept="image/*" type="file" name="image">
                <img id="product_selected_image" onerror="this.style.display='none';" src="#" alt="your image" />
            </div>
            <p class="info_title">Name</p>
            <input class="add_product_info_input" type="text" name="name">
            <p class="info_title">Short Description</p>
            <input class="add_product_info_input" type="text" name="shortdesc">
            <p class="info_title">Long Description</p>
            <input class="add_product_info_input" type="text" name="longdesc">
            <p class="info_title">Excluded Tax Price</p>
            <input class="add_product_info_input" type="text" name="excltaxprice">
            <p class="info_title">Stock Quantity</p>
            <input class="add_product_info_input" type="text" name="stock">
            <p class="info_title">Product Tax</p>
            <input class="add_product_info_input" type="text" name="tax">
            <p class="info_title">Category</p>
            <input class="add_product_info_input" type="text" name="category"><br>
            <input class="add_product_add_button" type="submit" name="add_product" value="Add Product">
            <?php 
                if(isset($_GET['result']) && !empty($_GET['result']) && $_GET['result'] == "success")
                    echo '<h3 class="add_product_success_upload_message"> Successfully added product. </h3>';
            ?>
        </form>
    </div>
    <div class="modify_product_section_container">
        <h1 class="form_container_title">Modify Product</h1>
        <?php 
            $products = $customRequest->getData(
                "SELECT p.product_id, p.name, p.short_description, p.long_description, p.price_excl_tax AS price, p.stock_quantity AS stock, t.rate AS tax, i.url AS image_url, c.name AS category
                 FROM product p 
                 LEFT JOIN (tax t CROSS JOIN image i CROSS JOIN  category c) ON (p.tax_id = t.tax_id AND p.image_id = i.image_id AND p.category_id = c.category_id);
                 ");
        ?>
        <?php foreach($products as $item) {?>
        <div class="modify_product_form_container">
            <div class="item_foreground">
                <div class="img_name_category_shortdesc_container">
                    <div class="modify_product_product_image_container">
                        <img class="modify_product_product_image" src="<?php echo $item['image_url'] ?>"
                            alt="your image" />
                    </div>
                    <div class="name_category_shortdesc_container">
                        <div class="name_category_container">
                            <div class="name_container">
                                <p class="modify_product_info_title">Name</p>
                                <p class="modify_product_info_content"><?php echo $item['name'] ?></p>
                            </div>
                            <div class="category_container">
                                <p class="modify_product_info_title">Category</p>
                                <p class="modify_product_info_content"><?php echo $item['category'] ?></p>
                            </div>
                        </div>
                        <div class="shortdesc_container">
                            <p class="modify_product_info_title">Short Description</p>
                            <p class="modify_product_info_content"><?php echo $item['short_description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="longdesc_container">
                    <p class="modify_product_info_title">Long Description</p>
                    <p class="modify_product_info_content"><?php echo $item['long_description'] ?></p>
                </div>
                <div class="excltaxprice_stock_tax_container">
                    <div class="excltaxprice_container">
                        <p class="modify_product_info_title">Excluded Tax Price</p>
                        <p class="modify_product_info_content"><?php echo $item['price'] ?> $</p>
                    </div>
                    <div class="stock_container">
                        <p class="modify_product_info_title">Stock Quantity</p>
                        <p class="modify_product_info_content"><?php echo $item['stock'] ?></p>
                    </div>
                    <div class="tax_container">
                        <p class="modify_product_info_title">Product Tax</p>
                        <p class="modify_product_info_content"><?php echo $item['tax'] ?></p>
                    </div>
                </div>
            </div>
            <div class="item_background">
                <div class="modify_product_button">
                    <i class="button_icon modify far fa-pen"></i>
                    <button class="modify_product" data-id="<?php echo $item['product_id'] ?>" value="">
                </div>
                <div class="modify_product_button">
                    <i class="button_icon delete far fa-trash-alt"></i>
                    <button class="delete_product" data-id="<?php echo $item['product_id'] ?>" value="">
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>