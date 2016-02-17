<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 30.10.15
 * Time: 22:52
 */
class Block_Notfound extends Block_Abstract {
    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/notfound.phtml');
        $this->toHtml();
    }

}