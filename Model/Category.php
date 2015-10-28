<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.10.15
 * Time: 13:17
 */
class Model_Category extends Model_Abstract {

    public function __construct() {
        $this->setTableName('category');
        $this->setTableIdEntity('id');
    }

}
