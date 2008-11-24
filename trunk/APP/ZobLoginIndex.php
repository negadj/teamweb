<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<title><?php echo h(_T('ui_g_title')); ?></title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function fnOnSubmit(form) {
	if (form.username.value == '' || form.password.value == '') {
		alert('<?php echo t2js(_T('ui_l_form_validation')); ?>');
		return false;
	}
	return true;
}
function bodyonload()
{
	document.loginform.username.focus();
}
</script>
</head>
<body onload="javascript:if ('function' == typeof(bodyonload)) { bodyonload(); }">
<center>
<div>
    <div style="font-size:14px; font-weight: bold; margin-top:50px;">
        <p><?php echo h(_T('ui_l_login')); ?></p></div>
    <div class="login">
        <form name="loginform" id="loginform" method="post" action="<?php echo url('ZobLogin', 'login'); ?>" onsubmit="return fnOnSubmit(this);">
        <label><?php echo h(_T('ui_l_admin')); ?></label>
        <?php $ui->control('textbox', 'username', array('size' => 22)); ?>
        <br /><br />
        <label><?php echo h(_T('ui_l_password')); ?></label>
    	<?php $ui->control('password', 'password', array('size' => 24)); ?>
        <br /><br />
        <input name="login" type="submit" id="login" value="<?php echo h(_T('ui_g_login')); ?>" class="loginbtn" />
      </form>
    </div>
</div>
</center>
</body>
</html>