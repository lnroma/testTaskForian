<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Index extends Block_Abstract
{
    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/index.phtml');
        $this->toHtml();
    }

    /**
     * get last ten files
     * @return array
     */
    public function getLastFile() {
        $filesModel = new Model_Files();
        $result = $filesModel
            ->addFieldToFilter('name',array('neq'=>''))
            ->setPageSize(10)
            ->setPage(0)
            ->setOrder('id','DESC')
            ->load();
        return $result;
    }
}
