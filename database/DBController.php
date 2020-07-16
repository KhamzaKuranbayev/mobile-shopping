<?php


class DBController
{
    //Database Connection properties
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'shopee';

    // connection property
    public $connection = null;

    // call constructor
    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            echo "Fail" . $this->connection->connect_error;
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    // for mysqli closing connection
    protected function closeConnection() {
        if($this->connection != null) {
            $this->connection->close();
            $this->connection = null;
        }
    }


}


