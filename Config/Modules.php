<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:14
 */
class Config_Modules {

    static public function getModulesConfig()
    {
        return array(
            'index' => array(
                'config_class' => 'Index_Config_Config',
                'enable'      => true
            ),
            'contact' => array(
                'config_class' => 'Contact_Config_Config',
                'enable'      => true
            ),
        );
    }

}