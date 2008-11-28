<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 实现首页面的显示
 *
 * @package TeamWeb
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-23
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
     * Model_Projects 对象
     *
     * @var Model_Projects
     */
    var $_modelProjects;
    
    
    /**
     * 构造函数
     *
     * @return Controller_ZobHome
     */
    function Controller_ZobHome() {
        parent::Controller_ZobBase();
        $this->_modelMembers =& FLEA::getSingleton('Model_Members');
        $this->_modelPosts =& FLEA::getSingleton('Model_Posts');
        $this->_modelProjects =& FLEA::getSingleton('Model_Projects');
    }
    
    /**
     * 显示首页、新闻信息
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
    
    /**
     * 显示组介绍
     */
    function actionTeam()
    {
        $this->_setBack();
        include(APP_DIR . '/ZobTeam.php');
    }
    
    /**
     * 显示项目信息
     */
    function actionProjects()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelProjects->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'project_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();
        
        $this->_setBack();
        include(APP_DIR . '/ZobProjects.php');
    }

    /**
     * 显示成员信息
     */
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
    
    function actionAbout() {
        $this->_setBack();
        include(APP_DIR . '/ZobAbout.php');
    }
    
    /**
     * 设置当前界面语言
     */
    function actionChangeLang() {
        $_SESSION['LANG'] = $_GET['lang'];
        
        $this->_goBack();
        //redirect($this->_url());
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
