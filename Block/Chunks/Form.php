<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.10.15
 * Time: 21:40
 */
class Block_Chunks_Form {

    private $_fileForm = null;

    /**
     * get seo info
     * @return array|null
     */
    public function getFileCategory() {
        if(is_null($this->_fileForm)) {
            $categoryModel = new Model_Category();
            $this->_fileForm = $categoryModel
                ->load();
        }

        return $this->_fileForm;
    }

}