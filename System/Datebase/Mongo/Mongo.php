<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

class MongoDBConnection
{
    private $connection;

    public function __construct($host, $username, $password, $port = 23456, $authMechanism = 'SCRAM-SHA-1', $tls = false)
    {
        $connectionString = 'mongodb://';
        if ($username && $password) {
            $connectionString .= $username . ':' . $password . '@';
        }
        $connectionString .= $host . ':' . $port . '/?authMechanism=' . $authMechanism . '&tls=' . ($tls ? 'true' : 'false');

        try {
            $this->connection = new MongoDB\Driver\Manager($connectionString);
        } catch (MongoDB\Driver\Exception\Exception $e) {
             $this->showError($e);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function showError($e)
    {
         'Error: ' . $e->getMessage();
    }
}






 ?>
