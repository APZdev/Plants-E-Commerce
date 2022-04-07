<?php 
    require(__DIR__."/database/DBController.php");
    $db = new DBController();

    require(__DIR__."/database/CustomRequest.php");
    $customRequest = new CustomRequest($db);
    
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
            return "Credit Card";
    }

    function fromIdToCardImage($id) {
        if($id == 1)
            return "/admin-dashboard/graphics/img/visa-logo.png";
        elseif($id == 2)
            return "/admin-dashboard/graphics/img/mastercard-logo.png";
        else
            return "/admin-dashboard/graphics/img/cb-logo.png";
    }

    function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    function sendActivityLog($db, $activityMessage)
    {
        $query = "";
        if(is_session_started())
        {
            if(isset($_SESSION['email']))
            {
                $customerId = $db->con->query("SELECT customer_id FROM customer WHERE email = '{$_SESSION['email']}';")->fetch_object()->cutomer_id;
            }
    
            $query = 
                "INSERT INTO activity_log (action, created_at, customer_id) 
                VALUES ('{$activityMessage}', NOW(), $customerId";
        }
        else
        {
            $query = 
                "INSERT INTO activity_log (action, created_at, customer_id) 
                VALUES ('{$activityMessage}', NOW(), 1)";
        }
    
        $db->con->query($query);
    }
?>
