<?php
    class DBController
    {
        //Properties
        protected $host = '127.0.0.1';
        protected $user = 'root';
        protected $pwd = '#Apomposelli1';
        protected $database = 'tropicalinterior';

        public $con = null;

        public function __construct()
        {
            $this->con = mysqli_connect($this->host, $this->user, $this->pwd, $this->database);
            if($this->con->connect_error)
                debug_to_console("Failed : ".$this->con->connect_errno);
            else
                debug_to_console("Connection successful");
        }

        public function __destruct()
        {
            $this->closeConnection();
        }

        protected function closeConnection()
        {
            if($this->con != null)
            {
                $this->con->close();
                $this->con = null;
            }
        }
    }
?>