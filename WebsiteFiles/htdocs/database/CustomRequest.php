<?php 

    class CustomRequest
    {
        public $db = null;

        public function __construct(DBController $db)
        {
            if(!isset($db->con)) return null;
            $this->db = $db;
        }

        public function getData($query)
        {
            $result = $this->db->con->query($query);

            $resultArray = array();

            while($item = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

?>