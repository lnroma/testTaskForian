<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.10.15
 * Time: 21:40
 */
class Block_Chunks_Head {

    private $_seoTable = null;

    /**
     * get seo info
     * @return array|null
     */
    public function getSeoInfo() {
        if(is_null($this->_seoTable)) {
            $headModel = new Model_Chunks_Head();
            $this->_seoTable = $headModel
                ->addFieldToFilter('path',Core_App::getParams()['controller'])
                ->load();
        }
        // load default seo table
        if(count($this->_seoTable) == 0) {
            $headModel = new Model_Chunks_Head();
            $this->_seoTable = $headModel
                ->addFieldToFilter('path','index')
                ->load();
        }

        return $this->_seoTable;
    }

}