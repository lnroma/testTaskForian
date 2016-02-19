<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:14
 */
class Contact_Model_Contact extends Core_Model_Abstract {

    public function __construct()
    {
        $this->setTableName('contacts_entity');
    }

}