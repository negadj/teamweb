<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 实现后台界面的显示
 *
 * @package OfficeBoard
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
 */
class Controller_ZobAdmin extends Controller_ZobBase
{
    /**
     * 构造函数
     *
     * @return Controller_ZobAdmin
     */
    function Controller_ZobAdmin() {
        parent::Controller_ZobBase();
    }
    /**
     * 显示 frames 页面
     */
    function actionIndex() {
        include(APP_DIR . '/ZobAdmin.php');
    }

    /**
     * 显示顶部导航栏
     */
    function actionTopNav() {
        $dispatcher =& $this->_getDispatcher();
        $user = $dispatcher->getUser();
        
        $ui =& FLEA::initWebControls();
        include(APP_DIR . '/ZobTopnav.php');
    }

    /**
     * 显示左侧菜单
     */
    function actionSidebar() {
        // 首先定义菜单
        $catalog = FLEA::loadFile('Config_Menu.php');
        // 借助 FLEA_Dispatcher_Auth 对用户角色和控制器 ACT 进行验证
        $dispatcher =& $this->_getDispatcher();
        include(APP_DIR . '/ZobSidebar.php');
    }

}
