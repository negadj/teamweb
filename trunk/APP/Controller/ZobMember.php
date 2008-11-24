<?php

// {{{ includes
FLEA::loadClass('Controller_ZobBase');
// }}}

/**
 * 定义 Controller_ZobMember 类， 实现成员管理，信息显示等
 *
 * @package OfficeBoard
 * @subpackage Controller
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
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
        $pager =& new FLEA_Helper_Pager($table, $page, 20, '', 'MemberID');
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
    
        $this->_editMember($member, 'create');
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
        
        $this->_editMember($member, 'save');
    }
    
    /**
     * 显示成员信息编辑页面
     *
     * @param array $product
     * @param string $errorMessage
     */
    function _editMember($member, $action, $errorMessage = "") {
        $tbRoles =& FLEA::getSingleton('Table_Roles');
        $roles = $tbRoles->findAll();
        if (count($roles) == 0) {
            js_alert(_T('ui_p_create_class_first'), '');
        }
        
        if (isset($member['roles']) && is_array($member['roles'])) {
            FLEA::loadFile('FLEA_Helper_Array.php', true);
            $member['roles'] = array_col_values($member['roles'], 'RoleID');
        }

        include(APP_DIR . '/ZobMemberEdit.php');
    }
    /**
     * 保存成员信息
     */
    function actionSave() {
        __TRY();
        //foreach ($_POST['roles'] as $name => $value) {
        //    echo $name . " " . $value . "<br>";
        //}
        $this->_modelMembers->updateMember($_POST);
        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            return $this->_editMember($_POST, 'save', $ex->getMessage());
        }

        js_alert(_T('ui_m_member_success'), '', $this->_url('list'));
        //$this->_goBack();
    }
    
    /**
     * 创建成员信息
     */
    function actionCreate() {
        __TRY();

        $this->_modelMembers->createMember($_POST);
        $ex = __CATCH();
        if (__IS_EXCEPTION($ex)) {
            //echo $ex->getMessage();
            return $this->_editMember($_POST, 'create', $ex->getMessage());
        }
        
        js_alert(_T('ui_m_member_success'), '', $this->_url('list'));

        //$this->_goBack();
    }
}

?>
