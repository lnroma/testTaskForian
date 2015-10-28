<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.10.15
 * Time: 12:18
 */

class Config_Db {

    /**
     * get config
     * @return array
     */
    static function getConf() {
        return array(
            'db_host' => 'mysql:host=localhost;dbname=host-most',
            'user'  => 'root',
            'pass'  => 'test'
        );
    }

}