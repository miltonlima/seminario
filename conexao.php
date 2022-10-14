<?php

define('DB_HOST', "192.168.0.214");
define('DB_USER', "bmi");
define('DB_PASSWORD', "bmi");
define('DB_NAME', "bmi");
define('DB_DRIVER', "sqlsrv");

/*
define('DB_HOST', "192.168.0.147");
define('DB_USER', "bpspessoasweb");
define('DB_PASSWORD', "bpspessoasweb");
define('DB_NAME', "bpspessoasweb");
define('DB_DRIVER', "sqlsrv");
*/

class Conexao
{
    private static $connection;

    private function __construct()
    {
    }

    public static function getConnection()
    {

        $pdoConfig  = DB_DRIVER . ":" . "Server=" . DB_HOST . ";";
        $pdoConfig .= "Database=" . DB_NAME . ";";

        try {
            if (!isset($connection)) {
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }
}
