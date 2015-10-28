<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 23.10.15
 * Time: 23:56
 */
class Block_Viewfile extends Block_Abstract {

    private $_fileData = null;

    /**
     * initialize construct
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/view_file.phtml');
        $this->toHtml();
    }

    /**
     * get file data
     * @return array
     */
    public function getFileData() {
        if(is_null($this->_fileData)) {
            $file = new Model_Files();
            $this->_fileData = $file->load((int)Core_App::getParams()['fileId']);
        }
        return $this->_fileData;
    }


    /**
     * get count comment
     * @return mixed
     */
    public function getCountComent() {
        $fileComent = new Model_Files_Coment();
        $count =
            $fileComent
                ->addFieldToFilter('id_file',Core_App::getParams()['fileId'])
                ->getCount();
        return $count->cnt;
    }

}