<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 定义 Controller_ZobPost 类， 实现贴吧信息的显示
 *
 * @package TeamWeb
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-24
 */
class Controller_ZobPost extends Controller_ZobBase
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
     * @return Controller_Post
     */
    function Controller_ZobPost()
    {
        parent::Controller_ZobBase();
        $this->_modelPosts =& FLEA::getSingleton('Model_Posts');
    }

    /**
     * 索引动作
     */
    function actionIndex()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelPosts->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, null, 'post_id DESC');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();

        $this->_setBack();
        include(APP_DIR . '/ZobPostsList.php');
    }

    /**
     * 添加帖子
     */
    function actionAdd()
    {
        $table =& $this->_modelPosts->getTable();
        $post = $this->_prepareData($table->meta);

        $this->_editComment($post);
    }
    
    /**
     * 删除帖子
     * 
     * @return
     */
    function actionDelete() {
        $this->_modelPosts->removePost($_GET['id']);
        $this->_goBack();
    }

    /**
     * 编辑帖子
     * 
     * @return
     */
    function actionEdit() {        
        $post = & $this->_modelPosts->getPost($_GET['id'], true);
        
        $this->_editComment($post, 'save');
    }
    
    /**
     * 显示帖子编辑页
     */
    function _editComment($post, $errorMessage = '') {
        
        include(APP_DIR . '/ZobPostAdd.php');
    }

    /**
     * 保存帖子
     */
    function actionSave()
    {
        $post = array(
            'post_id'   => $_POST['post_id'],
            'title'     => $_POST['title'],
            'body'      => strip_tags($_POST['body']),
        );
        __TRY();
        $this->_modelPosts->savePost($post);

        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            return $this->_editComment($post, $ex->getMessage());
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
    function _formatPost($body)
    {
        require_once APP_DIR . '/Helper/bbcode.php';
        return bbencode_all($body, 'post');
    }
}
