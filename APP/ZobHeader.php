<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); 
      FLEA::loadFile('FLEA_Helper_Html.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<!-- <title><?php echo FLEA::getAppInf('appTitle'); ?><?php echo h(_T('ui_w_title')); ?></title> -->
<title><?php echo h(_T('ui_g_title')); ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<div>
    <img src="images/ironman.jpg" /></div>
<div id=home_header class="home_header">
    <div>
        <a href="<?php echo url('ZobHome', 'index'); ?>"><?php echo h(_T('ui_g_home')); ?></a>
        <a href="<?php echo url('ZobPost', 'index'); ?>"><?php echo h(_T('ui_g_team')); ?></a>
        <a href="<?php echo url('ZobHome', 'personal'); ?>"><?php echo h(_T('ui_g_projects')); ?></a>
        <a href="<?php echo url('ZobBoard', 'index'); ?>"><?php echo h(_T('ui_g_members')); ?></a></div>
</div>