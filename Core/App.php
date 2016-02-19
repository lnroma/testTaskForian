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
    static private $_themes = null;
    static private $_modulConfig = null;
    static private $_controllObject = null;
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
     * set themes
     * @param $themes
     * @return string
     */
    static public function setThemes($themes) {
        self::$_themes = $themes;
        return self::$_path;
    }

    /**
     * set themes
     * @return string
     */
    static public function getThemes() {
        return self::$_themes;
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
     * get modules config
     * @return Config_Modules
     */
    static public function getModulesConfig() {
        return Config_Modules::getModulesConfig();
    }

    /**
     * run application
     * @return bool
     */
    static public function runApplet() {
        $params = self::getParams();

        if(!isset(self::getModulesConfig()[$params['controller']])) {
            throw new Exception_Notfound('Page not found!');
        }

        $modulesConfig = self::getModulesConfig()[$params['controller']];

        if($modulesConfig['enable'] == false) {
            throw new Exception_Notfound('Modul not found');
        }

        $configModul = $modulesConfig['config_class'];
        $configModul = $configModul::getConfig();

        self::$_modulConfig = $configModul;

        self::$_controllObject = self::_loadController($configModul,$params);

        return true;
    }

    /**
     * get current controller
     * @return null
     */
    static public function getConObj() {
        return self::$_controllObject;
    }

    /**
     * load controller
     * @param $modulConfig
     * @param $params
     * @return mixed
     * @throws Exception_Notfound
     */
    static protected function _loadController($modulConfig,$params) {

        if(!isset($modulConfig['controllers'])) {
            throw new Exception_Notfound('Page not found');
        }

        $controllersModul = $modulConfig['controllers'].'_'.ucfirst($params['controller']);

        $object = new $controllersModul;

        $params = Core_App::getParams();
        $action = $params['action'].'Action';

        call_user_func(array($object,$action));

        return $object;
    }

    static public function getConfigModul() {
        return self::$_modulConfig;
    }

    /**
     * @param $key
     * @param bool $filtered
     * @return mixed|null
     */
    static public function getPost($key,$filtered = true) {

        if(!isset($_POST[$key])) {
            return null;
        }

        if(is_array($_POST[$key])) {

            $result = array();

            foreach($_POST[$key] as $_key => $_post) {
                if ($filtered) {
                    $result[$_key] = filter_var($_post,FILTER_SANITIZE_SPECIAL_CHARS);
                } else {
                    $result[$_key] = $_post;
                }
            }

            return $result;
        }

        if($filtered) {
            return filter_var($_POST[$key],FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            return $_POST[$key];
        }
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

        // generate controller
        if(reset($params)=='') {
            $result['controller'] = 'index';
        } else {
            $result['controller'] = $params[0];
        }

        // generate action
        if(isset($params[1])) {
            $result['action'] = $params[1];
        } else {
            $result['action'] = 'index';
        }

        // generate params
        for ( $i=2; $i<count($params); $i++ ) {
            if( $i%2 != 0 ) {
                if(isset($params[$i-1])) {
                    $result[$params[$i-1]] = $params[$i];
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
    if(!file_exists($classFile)) {
        include_once(
            Core_App::getRootPath().
            'Modules/'
            .trim(implode(DIRECTORY_SEPARATOR,$classPath),
                DIRECTORY_SEPARATOR).'.php');
    } else {
        include_once($classFile);
    }
}