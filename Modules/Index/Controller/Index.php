<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.02.16
 * Time: 1:05
 */
class Index_Controller_Index extends Core_Controller_Abstract
{

    public function indexAction() {
        $this
            ->setBlock('Index')
            ->render();
    }
}