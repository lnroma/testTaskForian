<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_User extends Block_Abstract
{
    private $_fileList = null;
    private $_fileCount = null;

    /**
     * @return float
     */
    public function getPageFile() {
        $common = $this->getCountFiles();
        $pages = ceil($common/10);
        return $pages;
    }

    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/user.phtml');
        $this->toHtml();
    }

    /**
     * @return array
     */
    public function getUserFile() {
        $filesModel = new Model_Files();

        $page = 0;

        if(isset(Core_App::getParams()['p'])) {
            $page = Core_App::getParams()['p'] - 1;
        }

//        var_dump($page);die;

        $result = $filesModel
            ->addFieldToFilter('id_user',$_SESSION['id'])
            ->setPageSize(10)
            ->setPage($page)
            ->setOrder('id','DESC')
            ->load();
        return $result;
    }

    /**
     * get count files
     * @return mixed
     */
    public function getCountFiles() {

        if(!is_null($this->_fileCount)) {
            return $this->_fileCount;
        }

        $filesModel = new Model_Files();

        $result = $filesModel
            ->addFieldToFilter('id_user',$_SESSION['id'])
            ->getCount();
        $this->_fileCount = $result->cnt;

        return $this->_fileCount;
    }


}
