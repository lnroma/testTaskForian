<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.10.15
 * Time: 21:42
 */
class Model_Chunks_Head extends Model_Abstract {

    public function __construct() {
        $this->setTableName('chunks_head');
        $this->setTableIdEntity('id');
    }

}