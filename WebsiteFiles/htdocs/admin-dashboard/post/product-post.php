<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if($_POST["add-product"])
        {
            require_once('./../../utilities.php');
            
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
    
            if(in_array($fileActualExt, $allowedExt)) //Check supported image id
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
    
            $query = "INSERT INTO tax (rate) VALUES ({$tax});
                      INSERT INTO image (url) VALUES ('". $finalFileDestination ."');
                      INSERT INTO category (name, description) VALUES ('". $category ."', 'Category description');
                      INSERT INTO product (name, short_description, long_description, price_excl_tax, stock_quantity, tax_id, image_id, category_id) 
                          VALUES('". $name ."', '". $shortDesc ."', '". $longDesc ."', '". $exclTaxPrice ."', '". $stock ."', LAST_INSERT_ID(), LAST_INSERT_ID(), LAST_INSERT_ID());";
    
            $result = $db->con->multi_query($query);
            
            if ($result) {
                header('Location: /admin-dashboard/dashboard.php?page=product-panel&result=success');
            }
            else
            {
                $message  = 'Requête invalide : ' . $db->con->error . "\n";
                $message .= 'Requête complète : ' . $query;
                die($message);
            }
            /*
            header('Location: /admin-dashboard/dashboard.php?page=product-panel&result=success');
            //filter_var($email, FILTER_VALIDATE_EMAIL)
            //exit;
            //!empty($email)
            */
        }
        else if($_POST["modify-product"])
        {

        }
        else if($_POST["delete-product"])
        {

        }
    }
?>