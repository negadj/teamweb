<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 定义 Controller_ZobProject 类， 实现贴吧信息的显示
 *
 * @package TeamWeb
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-24
 */
class Controller_ZobProject extends Controller_ZobBase
{
    /**
     * Model_Projects 对象
     *
     * @var Model_Projects
     */
    var $_modelProjects;

    /**
     * 构造函数
     *
     * @return Controller_ZobProject
     */
    function Controller_ZobProject()
    {
        parent::Controller_ZobBase();
        $this->_modelProjects =& FLEA::getSingleton('Model_Projects');
    }

    /**
     * 索引动作
     */
    function actionIndex()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelProjects->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'project_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();

        $this->_setBack();
        include(APP_DIR . '/ZobProjectsList.php');
    }

    /**
     * 添加帖子
     */
    function actionAdd()
    {
        $table =& $this->_modelProjects->getTable();
        $project = $this->_prepareData($table->meta);

        $this->_editProject($project);
    }
    
    /**
     * 删除帖子
     * 
     * @return
     */
    function actionDelete() {
        $this->_modelProjects->removeProject($_GET['id']);
        $this->_goBack();
    }

    /**
     * 编辑帖子
     * 
     * @return
     */
    function actionEdit() {        
        $post = & $this->_modelProjects->getProject($_GET['id'], true);
        
        $this->_editProject($project);
    }
    
    /**
     * 显示帖子编辑页
     */
    function _editProject($project, $errorMessage = '') {
        
        include(APP_DIR . '/ZobProjectAdd.php');
    }

    /**
     * 保存帖子
     */
    function actionSave()
    {
        __TRY();
        $this->_modelProjects->saveProject($_POST);

        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            return $this->_editProject($post, $ex->getMessage());
        }
        js_alert(_T('ui_c_success_post'), '', $this->_url('index'));
    }
    
    /**
     * 使用 BBCode 格式化文本
     *
     * @param string $body
     *
     * @return string
     */
    function _formatText($body)
    {
        require_once APP_DIR . '/Helper/bbcode.php';
        return bbencode_all($body, 'post');
    }
}
