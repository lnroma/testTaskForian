<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 13:25
 */
class Core_Controller_Abstract {

    private $__block = null;

    public function setBlock($block) {
        $params = Core_App::getConfigModul();
        $this->__block = $params['blocks'].'_'.$block;
        return $this;
    }

    public function render() {
        $block = new $this->__block;
        $block->toHtml();
        return $this;
    }

}