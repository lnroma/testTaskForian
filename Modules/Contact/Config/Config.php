<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 14:15
 */

class Contact_Config_Config {

    static public function getConfig()
    {
        return array(
            'blocks' => 'Contact_Block',
            'models' => 'Contact_Model',
            'controllers' => 'Contact_Controller'
        );
    }

}