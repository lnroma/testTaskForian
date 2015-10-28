<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Upload extends Block_Abstract
{
    protected $_urlFile = null;
    protected $_nameFile = null;

    /**
     * call block and render
     */
    public function __construct() {
        $prefix = rand(10000,10000000);
        $nameFile = filter_var(isset($_POST['name']) ? $_POST['name'] : '' ,FILTER_SANITIZE_SPECIAL_CHARS);
        $descriptionFile = filter_var(isset($_POST['description']) ? $_POST['description'] : '',FILTER_SANITIZE_SPECIAL_CHARS);
        $uploadFilePath = Core_App::getRootPath().'uploads'.DIRECTORY_SEPARATOR.'disk2'.DIRECTORY_SEPARATOR.$prefix.$_FILES['fileUpload']['name'];
        $mimeType = $_FILES['fileUpload']['type'];
        $url = '/uploads/disk2/'.$prefix.$_FILES['fileUpload']['name'];
        $this->_urlFile = trim(Core_App::getBaseUrl(),'/').$url;
        $this->_nameFile = $nameFile;
        if($_FILES['fileUpload']['error'] == 0) {
            $userId = 0;
            if(isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
            }

            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$uploadFilePath)) {
                $fileMod = new Model_Files();
                $fileMod->addDataToSave(
                    array(
                        'id' => null,
                        'name' => $nameFile,
                        'path' => $uploadFilePath,
                        'description' => $descriptionFile,
                        'mimetype' => $mimeType,
                        'url' => $url,
                        'id_user' => $userId
                    )
                );
                $this->setTemplate(Core_App::getRootPath().'Template/result/success.phtml');
                $this->toHtml();
            } else {
                $this->setTemplate(Core_App::getRootPath().'Template/result/error.phtml');
                $this->toHtml();
            }
        } else {
            $this->setTemplate(Core_App::getRootPath().'Template/result/error.phtml');
            $this->toHtml();
        }
    }

    /**
     * get last ten files
     * @return array
     */
    public function getUrlFile() {
        return $this->_urlFile;
    }

    public function getNameFile() {
        return $this->_nameFile;
    }

    public function getLastId() {
        $file = new Model_Files();
        $result = $file
            ->setFieldToSelect(array('id'))
            ->setPage(0)
            ->setPageSize(1)
            ->setOrder('id','DESC')
            ->load();
        $result = reset($result);
        return $result['id'];
    }
}
