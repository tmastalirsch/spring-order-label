<?php

namespace App\Service;

use PDO;
use PDOException;

class ParcelServiceBasic {

    private $connection;

    public function __construct(){
        $this->connection = self::createPDO('', '', '', '', '', '');
    }
    

    public static function createPDO(string $host, string $port,string $dbase, string $username, string $pw) {
        try {
            $options = array(PDO::ATTR_ERRMODE=>true, PDO::ERRMODE_EXCEPTION=>true);
            return new PDO('mysql:host='.$host.';dbname='.$dbase.';port='.$port, $username, $pw, $options);	
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function select($query) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
                throw $e;
        }
    }

}