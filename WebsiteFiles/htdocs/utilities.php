<?php 
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('PHP LOG : " . $output . "' );</script>";
    }

    require(__DIR__."/database/DBController.php");
    $db = new DBController();

    require(__DIR__."/database/CustomRequest.php");
    $customRequest = new CustomRequest($db);
?>
