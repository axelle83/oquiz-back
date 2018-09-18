<?php

namespace Oquiz\Utils;

class Database {

    private static $db;
    private static $config;

    public static function setConfig($conf) {
        self::$config = $conf;
    }

    // retourne la connexion à la BDD
    public static function getDB() {

        if(!isset(self::$db)) {
            try {
                self::$db = new \PDO(
                    "mysql:host=".self::$config['host'].";dbname=".self::$config['dbname'].";charset=".self::$config['charset'],
                    self::$config['dbuser'],
                    self::$config['dbpassword']
                );
            } catch (\PDOException $e) {
                die('ERREUR DE CONNEXION');
            }
        }
        return self::$db;
    }
}
