<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:30
 */
class Contact_Block_Create extends Core_Block_Abstract {

    public function __construct()
    {
        $this->setTemplate('contact/create');
    }

    /**
     * get contact attribute for form count
     * @return array
     */
    public function getCountField() {
        $contactAttribute = new Contact_Model_Contacts_Attribute();
        return $contactAttribute->getCount();
    }

    public function getFormFields() {
        $contAttrib = new Contact_Model_Contacts_Attribute();
        return $contAttrib->load();
    }

    public function getFieldValue() {

        if(!isset(Core_App::getParams()['id'])) {
            return array();
        }

        $contModel = new Contact_Model_Contact();

        $result = $contModel->executeDirectQuery('
          SELECT cont.*,val.* FROM `contacts_entity` as `cont`
          LEFT JOIN contacts_attribute_value as `val`
          ON cont.id = val.id_contact
          WHERE val.id_contact = '.Core_App::getParams()['id'].'
        ');

        $tmpRes = array();


        foreach($result as $_res) {
            $tmpRes[$_res['id_attribute']] = $_res['value'];
            $tmpRes['name'] = $_res['name'];
            $tmpRes['id']   = $_res['id_contact'];
        }

        return $tmpRes;
    }

}