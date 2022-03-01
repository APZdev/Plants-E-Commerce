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

    require(__DIR__."/database/DBController.php");
    $db = new DBController();

    require(__DIR__."/database/CustomRequest.php");
    $customRequest = new CustomRequest($db);
?>
