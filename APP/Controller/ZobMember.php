<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 定义 Controller_ZobMember 类， 实现成员管理，信息显示等
 *
 * @package TeamWeb
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-24
 */
class Controller_ZobMember extends Controller_ZobBase
{
    /**
     * @var Model_Members
     */
    var $_modelMembers;
    
    /**
     * 构造函数
     *
     * @return Controller_ZobMember
     */
    function Controller_ZobMember() {
        parent::Controller_ZobBase();
        $this->_modelMembers =& FLEA::getSingleton('Model_Members');
    }
    
    /**
     * 显示指定的成员信息
     * 
     */
    function actionShowMember() {
        $memberID = $_GET["id"]; // $memberID = $_POST["id"]; 
        
        __TRY();
        $member = & $this->_modelMembers->getMember($memberID);
        $ex = __CATCH();
        $errorMessage = "";
        if (__IS_EXCEPTION($ex)) {
            $errorMessage = $ex->getMessage();
        }
        
        include(APP_DIR . '/ZobMemberShow.php');
        //js_alert(_T('ui_u_change_password_successed'), '', url('ZobBoard', 'welcome'));
    }
    
    /**
     * 列出所有的成员
     */ 
    function actionIndex() {        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        FLEA::loadClass('FLEA_Helper_Pager');
        $table =& $this->_modelMembers->getTable();
        $pager =& new FLEA_Helper_Pager($table, $page, 20, '', 'member_id');
        $pk = $table->primaryKey;
        $rowset = $pager->findAll();

        $this->_setBack();
        
        include(APP_DIR . '/ZobMembersList.php');
    }
    
    
    /**
     * 添加新成员
     * 
     * @return
     */
    function actionAdd() {
        $table =& $this->_modelMembers->getTable();
        $member = $this->_prepareData($table->meta);
    
        $this->_editMember($member);
    }
    
    /**
     * 删除成员
     * 
     * @return
     */
    function actionDelete() {
        $this->_modelMembers->removeMember($_GET['id']);
        $this->_goBack();
    }

    /**
     * 编辑成员
     * 
     * @return
     */
    function actionEdit() {        
        $member = & $this->_modelMembers->getMember($_GET['id'], true);
        
        $this->_editMember($member);
    }
    
    /**
     * 显示成员信息编辑页面
     *
     * @param array $product
     * @param string $errorMessage
     */
    function _editMember($member, $errorMessage = "") {
        include(APP_DIR . '/ZobMemberEdit.php');
    }
    /**
     * 保存成员信息
     */
    function actionSave() {
        __TRY();
        $this->_modelMembers->saveMember($_POST);
        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            return $this->_editMember($_POST, $ex->getMessage());
        }

        js_alert(_T('ui_m_member_success'), '', $this->_url('index'));
    }
}

?>
