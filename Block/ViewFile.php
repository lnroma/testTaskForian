<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 23.10.15
 * Time: 23:56
 */
class Block_ViewFile extends Block_Abstract {

    /**
     * initialize construct
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/view_file.phtml');
        $this->toHtml();
    }

    public function getLastFile() {
        
    }

}