<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.10.15
 * Time: 12:17
 */
class Core_Db {

    private static $_connection = null;

    /**
     * close construct
     */
    private function __construct() {
        return false;
    }

    /**
     * get connection
     * @return PDO
     * @throws Exception
     */
    public static function getResource() {
        if(!is_null(self::$_connection)) {
            return self::$_connection;
        } else {
            $config = Config_Db::getConf();
            try {
                self::$_connection = new PDO($config['db_host'],$config['user'],$config['pass']);
                self::$_connection->query('SET NAMES utf8');
            } catch (Exception $error) {
                throw new Exception($error->getMessage());
            }
            return self::$_connection;
        }
    }

}