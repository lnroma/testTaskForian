<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Index_Block_Index extends Core_Block_Abstract
{
    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate('index');
    }

    /**
     * get last ten files
     * @return array
     */
    public function getAllContacts() {
        $contModel = new Contact_Model_Contact();
        $result = $contModel->executeDirectQuery('
          SELECT cont.*,val.* FROM `contacts_entity` as `cont`
          LEFT JOIN contacts_attribute_value as `val`
          ON cont.id = val.id_contact
          WHERE val.id_contact <> ""
          ');

        $result = $this->_restructArray($result);
        return $result;
    }

    protected function _restructArray($arrayRest) {
        $result = array();
        foreach($arrayRest as $arr) {
            $result[$arr['id_contact']]['name'] = $arr['name'];
            $result[$arr['id_contact']][$arr['id_attribute']] = $arr['value'];
        }
        return $result;
    }

    /**
     * get count for check exist contact in your boock
     * @return array
     */
    public function getCountContacts() {
        $contModel = new Contact_Model_Contact();
        return $contModel
            ->getCount();
    }

    public function getGreedAttribute() {
        $contAttrModel = new Contact_Model_Contacts_Attribute();
        return $contAttrModel
            ->addFieldToFilter('show_in_greed','1')
            ->load();
    }

    public function getAllAttribute() {
        $contAttrModel = new Contact_Model_Contacts_Attribute();
        return $contAttrModel->load();
    }
}
