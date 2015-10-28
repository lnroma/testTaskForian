<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.10.15
 * Time: 20:44
 */
class Model_Files_Coment extends Model_Abstract
{

    public function __construct() {
        $this->setTableName('files_coment');
        $this->setTableIdEntity('id');
    }

}