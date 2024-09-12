<?php
class Database
{
    /* private $hostname = "localhost:3306";
        private $database = "sarmienspace_db_tienda";
        private $username = "sarmienspace";
        private $password = "Me12Mo34Ra56";
        private $charset = "utf8"; */

    private $hostname = "localhost";
    private $database = "sarmienspace_db_tienda_2";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}
$db = new Database();
$con = $db->conectar();
