<?php
/**
 *  file used for connecting to the database.
 */

class Database {


    //Db credentials
    private $host = '127.0.0.1';
    private $db_name = 'demo';
    private $username = 'demo';
    private $password = 'demo';

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
