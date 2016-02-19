<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:46
 */
session_start();
include 'Core/App.php';
Core_App::setBaseUrl('http://host-most.local/');
// require slash in end
Core_App::setRootPath('/var/www/host-most/');
Core_App::setThemes('default');
try {
    Core_App::runApplet();
} catch (Exception_Notfound $notFound) {
    new Core_Block_Notfound();
} catch (Exception $error) {
    new Core_Block_Error();
} catch (PDOException $errorPdo) {
    new Error_Block_Error();
}
