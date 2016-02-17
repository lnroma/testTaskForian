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

    /**
     * get files result
     * @return array
     */
    public function getFiles() {
        $files = array();
        $fileModel = new Model_Files();
        foreach($this->getSearchResult()[0]['matches'] as $key => $val ) {
            $files[] = reset($fileModel->load($key));
        }
        return $files;
    }

    /**
     * get count search result
     * @return int
     */
    public function getCountSearch() {

        if(!$this->getSearchResult()) {
            return 0;
        }

        $result = reset($this->getSearchResult());

        if(!isset($result['total_found'])) {
            return 0;
        }

        return $result['total_found'];
    }

    /**
     * get search result
     * @return array|bool|null
     */
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
