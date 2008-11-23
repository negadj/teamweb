<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 实现首页面的显示
 *
 * @package OfficeBoard
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
 */
class Controller_ZobHome extends Controller_ZobBase
{
    /**
     * @var Model_Members
     */
    var $_modelMembers;
    
    /**
     * Model_Posts 对象
     *
     * @var Model_Posts
     */
    var $_modelPosts;
    
    
    /**
     * 构造函数
     *
     * @return Controller_ZobHome
     */
    function Controller_ZobHome() {
        parent::Controller_ZobBase();
        $this->_modelMembers =& FLEA::getSingleton('Model_Members');
        $this->_modelPosts =& FLEA::getSingleton('Model_Posts');
    }
    
    /**
     * 显示首页
     */
    function actionIndex() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelPosts->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'post_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();
       
        
        $this->_setBack();
        include(APP_DIR . '/ZobHome.php');
    }
    
    function actionTeam()
    {
        $this->_setBack();
        include(APP_DIR . '/ZobTeam.php');
    }
    
    function actionProjects()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelPosts->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'project_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();
        
        $this->_setBack();
        include(APP_DIR . '/ZobProjects.php');
    }

    function actionMembers()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelMembers->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'member_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();
        
        $this->_setBack();
        include(APP_DIR . '/ZobMembers.php');
    }


    /**
     * 显示个人主页
     */
    function actionPersonal() {
        $dispatcher =& $this->_getDispatcher();
        $user = $dispatcher->getUser();
        
        __TRY();
        $member = & $this->_modelMembers->getMember($user['ID']);
        $ex = __CATCH();
        $errorMessage = "";
        if (__IS_EXCEPTION($ex)) {
            $errorMessage = $ex->getMessage();
        }
        
        include(APP_DIR . '/ZobIndex.php');
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
        $dispatcher =& FLEA::getSingleton(FLEA::getAppInf('dispatcher'));
        /* @var $dispatcher FLEA_Dispatcher_Auth */
        if ($dispatcher->check('ZobBoard', 'phpinfo') &&
            function_exists('phpinfo'))
        {
            $enablePhpinfo = true;
        } else {
            $enablePhpinfo = false;
        }
        include(APP_DIR . '/ZobWelcome.php');
    }

    /**
     * 设置当前界面语言
     */
    function actionChangeLang() {
        $_SESSION['LANG'] = $_GET['lang'];
        redirect($this->_url());
    }
    
    /**
     * 使用 BBCode 格式化文本
     *
     * @param string $body
     *
     * @return string
     */
    function _formatPost($body)
    {
        require_once APP_DIR . '/Helper/bbcode.php';
        return bbencode_all($body, 'post');
    }
}
