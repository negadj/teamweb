<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<!-- <title><?php echo FLEA::getAppInf('appTitle'); ?><?php echo h(_T('ui_w_title')); ?></title> -->
<title><?php echo h(_T('ui_g_title')); ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="width: 780px; padding: 10px;">
     <div>
         <img src="images/logo.bmp" width="180px"/><br /><br /></div>
    <div style="float:left; width:200px; text-align: center;">
        <br /><br />
        <div>
            <p><strong color=blue><?php echo h(_T('ui_g_about')); ?></strong></p>
            <p><a href="<?php echo url('ZobHome', 'index'); ?>"><?php echo h(_T('ui_g_home')); ?></a></p>
        </div></div>
    
    <div style="float:right; width:560px; padding-left:10px; border-left:1px solid darkblue;  ">
        <p><?php echo h(_T('ui_t_team_introduction')); ?></p>
        <strong><?php echo h(_T('ui_a_connection')); ?></strong>
        <p><?php echo h(_T('ui_a_address')). "<br />" . h(_T('ui_a_phone')); ?></p>
        <p><img src="images/481map.jpg" width=550px/></p>
    </div>
</div>
</body>
</html>