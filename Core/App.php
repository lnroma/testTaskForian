<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:51
 */
class Core_App {

    /**
     * this variable path to root directory
     * @var null
     */
    static private $_path = null;
    static private $_baseUrl = null;

    /**
     * set root path
     * @param $basePath
     * @return null | string
     */
    static public function setRootPath($basePath) {
        self::$_path = $basePath;
        return self::$_path;
    }

    /**
     * get root path
     * @return null | string
     */
    static public function getRootPath() {
        return self::$_path;
    }

    /**
     * set base url application
     * @param $baseUrl
     * @return null
     */
    static public function setBaseUrl($baseUrl) {
        self::$_baseUrl = $baseUrl;
        return self::$_baseUrl;
    }

    /**
     * get base url
     * @return null | string
     */
    static public function getBaseUrl() {
        return self::$_baseUrl;
    }

    /**
     * run application
     * @return bool
     */
    static public function runApplet() {
        $params = self::getParams();
        $class = 'Block_'.ucfirst($params['controller']);
        $path = self::getRootPath().'Block'.DIRECTORY_SEPARATOR.ucfirst($params['controller']).'.php';

        if(!file_exists($path)) {
            throw new Exception_Notfound('Page not found');
        }
        new $class;
        return true;
    }


    /**
     * get params request
     * @return array
     */
    static public function getParams() {
        $result = array();

        $baseUri = parse_url(self::getBaseUrl());

        $requestUri = $_SERVER['REQUEST_URI'];

        if(isset($baseUri['path']) && $baseUri['path'] != '/') {
            $requestUri = str_replace($baseUri['path'],'',$requestUri);
        }

        $params = explode('/',trim($requestUri,'/'));

        if(reset($params)=='') {
            $result['controller'] = 'index';
        } else {
            $result['controller'] = $params[0];
        }

        for ( $i=1; $i<count($params); $i++ ) {
            if( $i%2 != 0 ) {
                if(isset($params[$i+1])) {
                    $result[$params[$i]] = $params[$i + 1];
                }
            }
        }

        return $result;
    }
}

/**
 * autoload  class file
 * @param $className
 */
function __autoload($className) {
    $classPath = explode('_',$className);
    $classFile = Core_App::getRootPath().trim(implode(DIRECTORY_SEPARATOR,$classPath),DIRECTORY_SEPARATOR).'.php';
    include_once($classFile);
}