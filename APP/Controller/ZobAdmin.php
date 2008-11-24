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
     * Model_Posts 对象
     *
     * @var Model_Posts
     */
    var $_modelPosts;
    
    /**
     * 构造函数
     *
     * @return Controller_ZobAdmin
     */
    function Controller_ZobAdmin() {
        parent::Controller_ZobBase();
        $this->_modelPosts =& FLEA::getSingleton('Model_Posts');
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

    /**
     * 显示欢迎信息
     */
    function actionWelcome() {
        // 获取最新的10个帖子信息
        $table =& $this->_modelPosts->getTable();
        $postset = $table->findAll(null, "CommentID DESC", 10);
        $postpk = $table->primaryKey;
        
        $this->_setBack();
        include(APP_DIR . '/ZobWelcome.php');
    }
}
