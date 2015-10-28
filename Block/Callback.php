<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09.10.15
 * Time: 22:48
 */
class Block_Callback extends Block_Abstract
{
    /**
     * call block and render
     */
    public function __construct() {
        $params = Core_App::getParams();
        $users = new Model_Users();
        $this->checkEndAuthUser($users,$params);
        try {
            $users->addDataToSave(
                array(
                    'id' => null,
                    'id_user' => $params['id'],
                    'email'   => $params['email'],
                    'name'  => $params['name'],
                )
            );

            $this->checkEndAuthUser($users,$params);
        } catch (Exception $error) {

        }
    }

    /**
     * check end auth user by google+
     * @param $users
     * @param $params
     */
    protected function checkEndAuthUser($users,$params) {
        $result = $users
            ->addFieldToFilter('id_user',$params['id'])
            ->load();

        if(count($result) > 0) {
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['name'] = $result[0]['name'];
            header('Location: /');
            die;
        }
    }
}
