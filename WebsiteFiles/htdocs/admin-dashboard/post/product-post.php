<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');

        if(isset($_POST["add_product"]) && $_POST["add_product"])
        {
            $name = $_POST["name"];
            $shortDesc = $_POST["shortdesc"];
            $longDesc = $_POST["longdesc"];
            $exclTaxPrice = $_POST["excltaxprice"];
            $stock = $_POST["stock"];
            $tax = $_POST["tax"];
            $category = $_POST["category"];
            
            //Prevent SQL injection
            $name = $db->con->real_escape_string($name);
            $shortDesc = $db->con->real_escape_string($shortDesc);
            $longDesc = $db->con->real_escape_string($longDesc);
            $exclTaxPrice = $db->con->real_escape_string($exclTaxPrice);
            $stock = $db->con->real_escape_string($stock);
            $tax = $db->con->real_escape_string($tax);
            $category = $db->con->real_escape_string($category);
    
            //Image import
            $image = $_FILES["image"];
            $fileName = $image['name'];
            $fileTmpName = $image['tmp_name'];
            $fileSize = $image['size'];
            $fileError = $image['error'];
            $fileType = $image['type'];
            $finalFileDestination = "";
            
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
    
            $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');
    
            if(in_array($fileActualExt, $allowedExt)) //Check if image extension is supported
            {
                if($fileError === 0) //Check if image imported with no error
                {
                    //Set a unique file name to prevent image with same name overwriting
                    $newFileName = uniqid('', true).".".$fileActualExt;
                    $fileDestination = './../../database/uploads/products-images/'.$newFileName;
                    move_uploaded_file($fileTmpName, $fileDestination); //Upload file to server
    
                    
                    //Get server server image
                    $rawImage = imagecreatefrompng($fileDestination);
                    list($rawImageWidth, $rawImageHeight) = getimagesize($fileDestination);
                    imagesavealpha($rawImage, true); //Save image alpha channel
                    imagealphablending($rawImage, 1);
                    
                    //Get watermark image
                    $watermarkPath = './../graphics/img/watermark.png';
                    $rawWatermark = imagecreatefrompng($watermarkPath);
                    imagesavealpha($rawWatermark, true);
                    imagealphablending($rawWatermark, 1);
                    $rawWatermark = imagecropauto($rawWatermark, IMG_CROP_DEFAULT);
                    list($watermarkWidth, $watermarkHeight) = getimagesize($watermarkPath);
                    
                    //Apply watermark to image and resize watermark
                    imagecopyresized($rawImage, $rawWatermark, 223, 415, 0, 0, $watermarkWidth / 7, $watermarkHeight / 7, $rawImageWidth - 25, $rawImageHeight - 25);
    
                    //Overwrite watermarked image with the saved one
                    imagepng($rawImage, $fileDestination);
                    $finalFileDestination = $fileDestination;
    
                    imagedestroy($rawImage); //Clear memory
                    imagedestroy($rawWatermark);
                }
            }
    
            $query = 
            "INSERT INTO tax (rate) VALUES ({$tax});
             SET @tax_id = LAST_INSERT_ID();
         
             INSERT INTO image (url) VALUES ('". $finalFileDestination ."');
             SET @image_id = LAST_INSERT_ID();
         
             INSERT INTO category (name, description) VALUES ('". $category ."', 'Category description');
             SET @category_id = LAST_INSERT_ID();
         
             INSERT INTO product (name, short_description, long_description, price_excl_tax, stock_quantity, tax_id, image_id, category_id) 
                 VALUES('". $name ."', '". $shortDesc ."', '". $longDesc ."', {$exclTaxPrice} , {$stock}, @tax_id, @image_id, @category_id);
            ";

            $result = $db->con->multi_query($query);
            
            if ($result) {
                header('Refresh:0.2; url=/admin-dashboard/dashboard.php?page=product-panel&result=success');
            }
            else
            {
                $message  = 'Requête invalide : ' . $db->con->error . "\n";
                $message .= 'Requête complète : ' . $query;
                die($message);
            }
        }
        else if(isset($_POST["modify_product_modal"]) && $_POST["modify_product_modal"])
        {
            $productid = $_POST['productid'];

            $product = $customRequest->getData(
                "SELECT p.name, p.short_description, p.long_description, p.price_excl_tax AS price, p.stock_quantity AS stock, t.rate AS tax, c.name AS category
                 FROM product p
                 LEFT JOIN (tax t CROSS JOIN image i CROSS JOIN  category c) ON (p.tax_id = t.tax_id AND p.category_id = c.category_id)
                 WHERE p.product_id = {$productid}
                 LIMIT 1;
                 ")[0];

            echo 
            '
                <div class="modify_product_modal_container">
                    <h1 class="form_container_title">Edit product</h1>
                    <p class="info_title">Name</p>
                    <input class="add_product_info_input" type="text" name="name" value="'. $product['name'].'">
                    <p class="info_title">Short Description</p>
                    <input class="add_product_info_input" type="text" name="shortdesc" value="'. $product['short_description'].'">
                    <p class="info_title">Long Description</p>
                    <input class="add_product_info_input" type="text" name="longdesc" value="'. $product['long_description'].'">
                    <p class="info_title">Excluded Tax Price</p>
                    <input class="add_product_info_input" type="text" name="excltaxprice" value="'. $product['price'].'">
                    <p class="info_title">Stock Quantity</p>
                    <input class="add_product_info_input" type="text" name="stock" value="'. $product['stock'].'">
                    <p class="info_title">Product Tax</p>
                    <input class="add_product_info_input" type="text" name="tax" value="'. $product['tax'].'">
                    <p class="info_title">Category</p>
                    <input class="add_product_info_input" type="text" name="category" value="'. $product['category'].'">
                </div>
            ';
        }
        else if(isset($_POST["modify_product"]) && $_POST["modify_product"])
        {
            $productid = $_POST['productid'];
            $name = $_POST["name"];
            $shortDesc = $_POST["shortdesc"];
            $longDesc = $_POST["longdesc"];
            $exclTaxPrice = $_POST["excltaxprice"];
            $stock = $_POST["stock"];
            $tax = $_POST["tax"];
            $category = $_POST["category"];
            
            //Prevent SQL injection
            $name = $db->con->real_escape_string($name);
            $shortDesc = $db->con->real_escape_string($shortDesc);
            $longDesc = $db->con->real_escape_string($longDesc);
            $exclTaxPrice = $db->con->real_escape_string($exclTaxPrice);
            $stock = $db->con->real_escape_string($stock);
            $tax = $db->con->real_escape_string($tax);
            $category = $db->con->real_escape_string($category);

            $query = "SELECT tax_id, category_id INTO @tax_id, @category_id FROM product WHERE product_id = {$productid};";
            $query .="UPDATE product SET name = '". $name ."', short_description = '". $shortDesc ."', long_description = '". $longDesc ."', price_excl_tax = {$exclTaxPrice}, stock_quantity = {$stock} WHERE product_id = {$productid};";
            $query .="UPDATE tax SET rate = {$tax} WHERE tax_id = @tax_id;";
            $query .="UPDATE category SET name = '". $category ."', description = 'Category description' WHERE category_id = @tax_id;";

            $result = $db->con->multi_query($query);

            if ($result) {
                header('Refresh:0; url=/admin-dashboard/dashboard.php?page=product-panel');
            }
        }
        else if(isset($_POST["delete_product_modal"]) && $_POST["delete_product_modal"])
        {
            $productid = $_POST['productid'];

            $query = "SELECT name FROM product WHERE product_id={$productid};";

            $result = $db->con->query($query);

            if ($result) {
                while($row = mysqli_fetch_assoc($result))
                {
                    $name = $row['name'];
                    echo "Are you sure you want to <strong>REMOVE</strong> '{$name}' from the store ?";
                }
            }
        }
        else if(isset($_POST["delete_product"]) && $_POST["delete_product"])
        {
            $productid = $_POST['productid'];

            $query = "DELETE FROM product WHERE product_id={$productid}";

            $result = $db->con->query($query);

            if ($result) {
                header('Refresh:0; url=/admin-dashboard/dashboard.php?page=product-panel');
            }
        }
    }
?>