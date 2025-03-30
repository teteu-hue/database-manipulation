<?php

namespace Connection;

use Exception;
use PDO;

final class TConnection
{
    private function __construct() { }

    public static function open($name)
    {
        $filePath = __DIR__ . "/../src/config/database/{$name}.ini";
        if(!self::fileExists($filePath)) throw new Exception("File {$name} not exits! in {$filePath}");

        $data = self::mountDatabaseConfig($filePath);

        return self::defineDatabaseConnection($data);
    }

    private static function fileExists($name)
    {
        return file_exists($name);
    }

    private static function mountDatabaseConfig($filePath)
    {
        $db = parse_ini_file($filePath);

        $user = isset($db['DB_USERNAME']) ? $db['DB_USERNAME'] : null;
        $dbname = isset($db['DB_NAME']) ? $db['DB_NAME'] : null;
        $pass = isset($db['DB_PASSWORD']) ? $db['DB_PASSWORD'] : null;
        $host = isset($db['DB_HOSTNAME']) ? $db['DB_HOSTNAME'] : null;
        $driver = isset($db['DB_DRIVER']) ? $db['DB_DRIVER'] : null;
        $port = isset($db['DB_PORT']) ? $db['DB_PORT'] : null;

        $data = [
            "user" => $user,
            "pass" => $pass,
            "host" => $host,
            "driver" => $driver,
            "port" => $port,
            "dbname" => $dbname
        ];

        return $data;
    }

    private static function defineDatabaseConnection($data)
    {
        switch($data['driver']){
            case 'mysql': 
                $conn = new PDO("mysql:host={$data['host']};
                         port={$data['port']};
                         dbname={$data['dbname']};", $data['user'], $data['pass']);
            break;
        }

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $conn;
    }

}

echo !file_exists(__DIR__ . "/../src/config/database/mysql.ini");