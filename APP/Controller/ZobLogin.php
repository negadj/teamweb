<?php

/**
 * Controller_ZobLogin 实现了用户登录和注销
 *
 * @package TeamWeb
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-24
 */
class Controller_ZobLogin extends FLEA_Controller_Action
{
    /**
     * 构造函数
     *
     * @return Controller_ZobLogin
     */
    function Controller_ZobLogin() {
        load_language('ui');
    }

    /**
     * 显示登录界面
     */
    function actionIndex() {
    	$ui =& FLEA::initWebControls();
    	require(APP_DIR . '/ZobLoginIndex.php');
    }
    
    /**
     * 注销
     */
    function actionLogout() {
        session_destroy();

        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/ZobLoginIndex.php');
    }

    /**
     * 登录
     */
    function actionLogin() {
        do {
            /**
             * 验证用户名和密码是否正确
             */
            $modelSysUsers =& FLEA::getSingleton('Model_SysUsers'); 

            $user = $modelSysUsers->findByUsername($_POST['username']);
            if (!$user) {
                $msg = _T('ui_l_invalid_username');
                break;
            }

            if (!$modelSysUsers->checkPassword($_POST['password'], $user['password']))
            {
                $msg = _T('ui_l_invalid_password');
                break;
            }
            
            /**
             * 登录成功，通过 RBAC 保存用户信息和角色
             */
            $data = array();
            $data['ADMIN'] = $user['username'];
            $rbac =& FLEA::getSingleton('FLEA_Rbac');
            
            /* @var $rbac FLEA_Rbac */
            $rbac->setUser($data, array('SYSTERM_ADMIN'));
            
            //重定向
            redirect(url('ZobAdmin'));
        }
        while (false);

        //登录发生错误，再次显示登录界面
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/ZobLoginIndex.php');
    }
}

?>
