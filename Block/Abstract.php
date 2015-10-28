<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Abstract {

    /**
     * private variable path to template
     * @var null
     */
    private $_template = null;

    /**
     * set template for block
     * @param $src
     * @return null | string
     */
    public function setTemplate($src)
    {
        $this->_template = $src;
        return $this->_template;
    }

    /**
     * get template
     * @return null | string
     */
    public function getTemplate()
    {
        return $this->_template;
    }

    /**
     * render block to html
     * @return bool
     */
    public function toHtml()
    {
        include($this->getTemplate());
        return true;
    }

    /**
     * get post value by key
     * @param $key
     * @return null | string
     */
    public function getPost($key)
    {
        if(isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }
    }

    /**
     * get chunk for template
     * @param $chanckPath
     * @return bool
     */
    public function getChunk($chanckPath)
    {
        include Core_App::getRootPath().'Template'.DIRECTORY_SEPARATOR.$chanckPath;
        return true;
    }

}