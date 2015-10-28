<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Search extends Block_Abstract
{
    protected $_searchResult = null;

    /**
     * call block and render
     */
    public function __construct() {
        $this->setTemplate(Core_App::getRootPath().'Template/searchresult.phtml');
        $this->toHtml();
    }

    public function getFiles() {
        $files = array();
        $fileModel = new Model_Files();
        foreach($this->getSearchResult()[0]['matches'] as $key => $val ) {
            $files[] = reset($fileModel->load($key));
        }
        return $files;
    }

    public function getCountSearch() {
        $result = reset($this->getSearchResult());
        return $result['total_found'];
    }

    public function getSearchResult()
    {
        if(!is_null($this->_searchResult)) {
            return $this->_searchResult;
        } else {
            $sphinx = new Library_SphinxClient();
            $sphinx->SphinxClient();
            $sphinx->SetServer('127.0.0.1','3314');
            $sphinx->SetSortMode(SPH_SORT_RELEVANCE);
            $sphinx->SetFieldWeights(
                array(
                    'name' => 30,
                    'description' => 20,
                )
            );
            $sphinx->AddQuery($_GET['query']);
            $this->_searchResult = $sphinx->RunQueries();
            return $this->_searchResult;
        }

    }
}
