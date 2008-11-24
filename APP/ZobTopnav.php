<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topnav">
  <h3></h3>
  <div id="topnav_menu"> 
    <?php echo h(_T('ui_l_admin')); ?>&nbsp;[<?php echo $user['ADMIN']; ?>]
    &nbsp;&nbsp;
    <a href="<?php echo url('ZobLogin', 'logout'); ?>" target="_parent"><?php echo h(_T('ui_a_logout')); ?></a>
  </div>
</div>
</body>
</html>
