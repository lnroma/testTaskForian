<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:49
 */
class Block_Result extends Block_Abstract
{
    /**
     * call block and render
     */
    public function __construct() {
        Core_App::loadLibrary();
        $this->setTemplate(Core_App::getRootPath().'Template/result.phtml');
        $this->toHtml();
    }
}