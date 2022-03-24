<?php 
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('PHP LOG : " . $output . "' );</script>";
    }

    function setTabTitle($title)
    {
        echo "<script>document.title = '".$title."';</script>";
    }

    function getDomain()
    {
        //Redirect to localhost on developement & redirect to server's website on production
        return $_SERVER['SERVER_ADDR'] == "::1" ? "http://127.0.0.1" : "https://tropicalinterior.shop";
    }

    function fromIdToCardName($id) {
        if($id == 1)
            return "Visa";
        elseif($id == 2)
            return "Mastercard";
        else
            return "Standard Credit Card";
    }

    function fromIdToCardImage($id) {
        if($id == 1)
            return "/admin-dashboard/graphics/img/visa-logo.png";
        elseif($id == 2)
            return "/admin-dashboard/graphics/img/mastercard-logo.png";
        else
            return "/admin-dashboard/graphics/img/cb-logo.png";
    }

    require(__DIR__."/database/DBController.php");
    $db = new DBController();

    require(__DIR__."/database/CustomRequest.php");
    $customRequest = new CustomRequest($db);
?>
