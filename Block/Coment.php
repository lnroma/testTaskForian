<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.10.15
 * Time: 20:42
 */
class Block_Coment extends Block_Abstract {

    private $_fileData = null;
    private $_fileComment = null;
    private $_message = null;

    public function __construct() {
        if($this->getPost('action') == 'saveComent') {
            $this->saveComment();
            header('Location: '.$_SERVER['REQUEST_URI']);
            die;
        }
        $this->setTemplate('Template/coment.phtml');
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
     * get comment
     * @return array|null
     */
    public function getComent() {
        if(is_null($this->_fileComment)) {
            $fileComent = new Model_Files_Coment();
            $this->_fileComment =
                $fileComent
                    ->addFieldToFilter('id_file',Core_App::getParams()['fileId'])
                    ->load();
        }

        return $this->_fileComment;
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

    /**
     * save comment
     */
    public function saveComment() {
        $fileComent = new Model_Files_Coment();
        try {
            if(trim($this->getPost('coment')) == '') {
                throw new Exception('Поле ваш коментарий обязательно');
            }

            $_SESSION['psevdoname'] = $this->getPost('name');
            
            $fileComent
                ->addDataToSave(
                    array(
                        'id' => null,
                        'id_file' => $this->getPost('id'),
                        'name' => $this->getPost('name'),
                        'text' => $this->getPost('coment'),
                    )
                );

            $this->setMessage('Ваш коментарий сохранён');
        } catch (Exception $error) {
            $this->setMessage($error->getMessage());
        }
    }

    /**
     * set message
     * @param $msg
     */
    public function setMessage($msg) {
        $_SESSION['msg'] = $msg;
    }

    /**
     * get message
     * @return null
     */
    public function getMessage() {
        if(isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $msg;
        } else {
            return null;
        }
    }

}