<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:03
 */

class Index_Config_Config {

    static public function getConfig()
    {
        return array(
            'blocks' => 'Index_Block',
            'models' => 'Index_Model',
            'controllers' => 'Index_Controller'
        );
    }

}