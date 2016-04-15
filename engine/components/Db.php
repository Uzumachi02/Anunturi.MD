<?php

class Db {

    /**
     * Conectarea cu Baza de date
     * @return \PDO <p>Obiectul ale clasei PDO cu conectarea la BD</p>
     */
    public static function getConnection() {

        $params = include ENGINE_DIR . '/config/db_config.php';

        $con = "mysql:host={$params['DBHOST']};dbname={$params['DBNAME']}";
        $db = new PDO($con, $params['DBUSER'], $params['DBPASS']);

        $db->exec("SET NAMES 'utf8'");

        return $db;
    }
}