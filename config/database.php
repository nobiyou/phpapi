<?php
/**
 *  file used for connecting to the database.
 */

class Database {


    //Db credentials
    private $host = '61.129.33.79';
    private $db_name = 'demo';
    private $username = 'demo';
    private $password = 'aseraser';

    public $conn;

    //Db connection
    /**
     * @return mixed
     */
    public function getConnection()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch (PDOException $exception){
            echo "Connection error: ". $exception->getMessage();
        }
        return $this->conn;
    }
}
