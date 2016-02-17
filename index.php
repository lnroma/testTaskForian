<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:46
 */
session_start();
include 'Core/App.php';
Core_App::setBaseUrl('http://host-most.ru/');
Core_App::setRootPath('/var/www/host-most.ru/');
try {
    Core_App::runApplet();
} catch (Exception_Notfound $error) {
//    echo $error->getMessage();
//    die;
    new Block_Notfound();
}