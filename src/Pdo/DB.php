<?php

namespace App\Pdo;


use Exception;
use PDO;
use PDOException;

class DB
{
    private const PDO_CONFIG = __DIR__ . '/../../config/config.ini';
    protected $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): DB
    {
        try {
            if (!($config = parse_ini_file(self::PDO_CONFIG))) {
                throw new Exception("Ошибка при парсинге файла конфигурации", 1);
            }

            $this->pdo = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['login'], $config['password']);
            return $this;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}