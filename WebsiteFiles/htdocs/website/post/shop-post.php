<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        require_once('./../../utilities.php');

        if(isset($_POST["shop_filtered_product_fetch"]) && $_POST["shop_filtered_product_fetch"])
        {
            $safeKeyords = $db->con->real_escape_string($_POST["keywords"]);
            $keywords = explode(":", $safeKeyords);

            $finalQuery = 
            "SELECT p.product_id, p.name, p.price_excl_tax, t.rate AS tax_rate, i.url AS image_url
                FROM product p 
                LEFT JOIN (tax t CROSS JOIN image i) ON (p.tax_id = t.tax_id AND p.image_id = i.image_id)";

            if(count($keywords) > 0)
                $finalQuery .= " WHERE";

            for($i = 0; $i < count($keywords); $i++)
            {
                if($i == count($keywords) - 1)
                    $finalQuery .= " name LIKE '%".$keywords[$i]."%'";
                else
                    $finalQuery .= " name LIKE '%agave%' OR";
            }
            $finalQuery .= ";";

            $products = $customRequest->getData($finalQuery);

            $output = "";
            foreach($products as $product)
            {
                $output .=
                "                
                    <a href='/website/pages/selected-product.php?product_id={$product['product_id']}' class='product_card_item'>
                        <img class='product_card_image'src='{$product['image_url']}' alt='product_image'>
                        <p class='product_card_name'>{$product['name']}</p>
                        <p class='product_card_price'>". ($product['price_excl_tax'] + ($product['price_excl_tax'] * $product['tax_rate'] / 100))." $</p>
                    </a>
                ";
            }
                
            //Fill page with content in js ajax .then()
            echo $output;
        }
    }
?>