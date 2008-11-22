<?php

/**
 * 定义后台管理界面左侧的菜单
 *
 * @package OfficeBoard
 * @subpackage Menu
 * @author  Zhou Yuhui (xuchangyuhui@sohu.com)
 * @version 1.0, 2008-09-19
 */

$catalog = array();

$menu = array();
$menu[] = array(_T('ui_w_menu_no_overtime'), 'ZobOvertimes', 'displayUnhandled');
$menu[] = array(_T('ui_w_menu_today_ok_overtime'), 'ZobOvertimes');
$menu[] = array(_T('ui_w_menu_approved_overtime'), 'ZobOvertimes', 'displayApproved');
$menu[] = array(_T('ui_w_menu_rejected_overtime'), 'ZobOvertimes', 'displayRejected');
$menu[] = array(_T('ui_w_menu_ot_setting'), 'ZobSetting', 'lsetting');
$catalog[] = array(_T('ui_w_catalog_overtimes'), $menu);

$menu = array();
$menu[] = array(_T('ui_u_overtime_apply_menu'), 'ZobOvertimes', 'applyOvertime');
$menu[] = array(_T('ui_u_overtime_history_menu'), 'ZobOvertimes', 'queryHistoryOvertime');
$catalog[] = array(_T('ui_u_overtime_catalog'), $menu);

/*
$menu = array();
$menu[] = array(_T('ui_u_holiday_apply_menu'), 'ZobOvertimes', 'applyOvertime');
$menu[] = array(_T('ui_u_holiday_history_menu'), 'ZobOvertimes', 'queryHistoryOvertime');
$catalog[] = array(_T('ui_u_holiday_catalog'), $menu);
*/

$menu = array();
$menu[] = array(_T('ui_u_comment_menu'), 'ZobPost', 'add');
$menu[] = array(_T('ui_u_preference_menu'), 'ZobPreference', 'editProfile');
$menu[] = array(_T('ui_u_headimage_menu'), 'ZobPreference', 'picman');
$menu[] = array(_T('ui_u_setting_menu'), 'ZobSetting', 'msetting');
$menu[] = array(_T('ui_u_change_password_menu'), 'ZobPreference', 'changePassword');
$catalog[] = array(_T('ui_u_preference_catalog'), $menu);

$menu = array();
$menu[] = array(_T('ui_m_memberlist_menu'), 'ZobMember', 'list');
$menu[] = array(_T('ui_m_add_member_menu'), 'ZobMember', 'add');
$catalog[] = array(_T('ui_m_manage_catalog'), $menu);

return $catalog;

?>
