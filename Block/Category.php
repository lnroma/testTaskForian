<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Category extends Block_Abstract
{
    private $_category = null;

    /**
     * call block and render
     */
    public function __construct()
    {
        $this->setTemplate(Core_App::getRootPath() . 'Template/category.phtml');
        $this->toHtml();
    }

    public function getCategoryFile()
    {
        $params = Core_App::getParams();

        if (isset($params['subcategory'])) {

            $page = 0;
            if (isset(Core_App::getParams()['p'])) {
                $page = Core_App::getParams()['p'] - 1;
            }

            $categoryMod = $this->getCategoryCollection($params);

            $idCategory = $categoryMod['id'];

            $fileModel = new Model_Files();

            $result = $fileModel
                ->addFieldToFilter('id_category', $idCategory)
                ->setPageSize(10)
                ->setPage($page)
                ->setOrder('id', 'DESC')
                ->load();
            $result['category'] = $categoryMod;
            return $result;
        }
        return null;
    }

    public function getCategoryCollection($params) {

        if(!is_null($this->_category)) {
            return $this->_category;
        }

        $categoryModel = new Model_Category();

        $category = $categoryModel
            ->addFieldToFilter('url_key', $params['subcategory'])
            ->load();
        $categoryMod = reset($category);

        return $categoryMod;
    }

    public function getPageFile()
    {
        $categoryCol = $this->getCategoryCollection(Core_App::getParams());
        $common = $this->getCountFiles($categoryCol['id']);
        $pages = ceil($common / 10);
        return $pages;
    }

    /**
     * @return array
     */
    public function getFileCategory()
    {
        $categoryModel = new Model_Category();

        return $categoryModel
            ->setOrder('sort_index', 'ASC')
            ->load();
    }

    /**
     * get count files
     * @return mixed
     */
    public function getCountFiles($categoryId)
    {
        $filesModel = new Model_Files();

        $result = $filesModel
            ->addFieldToFilter('id_category', $categoryId)
            ->getCount();
        return $result->cnt;
    }


}
