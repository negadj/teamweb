<?php

/**
 * 定义后台管理界面左侧的菜单
 *
 * @package TeamWeb
 * @subpackage Menu
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-11-24
 */

$catalog = array();

$menu = array();
$menu[] = array(_T('ui_m_post_menu'), 'ZobPost', 'index');
$menu[] = array(_T('ui_m_add_post_menu'), 'ZobPost', 'add');
$menu[] = array(_T('ui_m_projects_menu'), 'ZobMember', 'list');
$menu[] = array(_T('ui_m_add_project_menu'), 'ZobMember', 'add');
$menu[] = array(_T('ui_m_members_menu'), 'ZobMember', 'list');
$menu[] = array(_T('ui_m_add_member_menu'), 'ZobMember', 'add');
$catalog[] = array(_T('ui_m_manage_catalog'), $menu);

return $catalog;

?>
