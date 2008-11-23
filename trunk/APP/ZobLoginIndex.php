<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<title><?php echo h(_T('ui_l_title')); ?></title>
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
<div id="header" class="header" >
    <div id="logo" class="logo">
        <a href="http://localhost:8080/zob"><img alt="ZOB" border=0 src="images/logo.gif" /></a></div>
</div>
<div id="body" class="welcome">
    <div id="intro" class="intro">
       <div>
            <p><?php echo t(sprintf(_T('ui_l_welcome'), FLEA::getAppInf('appTitle'))); ?></p></div>
        <div><img alt=welcome src="images/welcome.gif" /></div><br>
        <div><img src="images/list.gif" align=absMiddle><?php echo h(_T('ui_l_intro1')); ?></div><br>
        <div><img src="images/list.gif" align=absMiddle><?php echo h(_T('ui_l_intro2')); ?></div><br>
        <div><img src="images/list.gif" align=absMiddle><?php echo h(_T('ui_l_intro3')); ?></div></div>
    <div id="login" class="login">
        <div style="font-size:14px;"><p><?php echo h(_T('ui_l_login')); ?></p></div>
        <?php if (isset($msg)): ?>
        <div class=infobox>
            <p><?php echo t($msg); ?></p></div>
        <?php endif; ?>
        <form name="loginform" id="loginform" method="post" action="<?php echo url('ZobLogin', 'login'); ?>" onsubmit="return fnOnSubmit(this);">
        <label><?php echo h(_T('ui_l_username')); ?></label>
        <br />
        <?php $ui->control('textbox', 'username', array('size' => 22)); ?>
        <br />
        <br />
        <label><?php echo h(_T('ui_l_password')); ?></label>
        <br />
    	<?php $ui->control('password', 'password', array('size' => 24)); ?>
        <br />
        <br />
        <label><?php echo h(_T('ui_l_imgcode')); ?></label>
        <img src="<?php echo $this->_url('imgcode'); ?>" /><br />
    	<?php $ui->control('textbox', 'imgcode', array('size' => 22)); ?>
        <br />
        <br />
        <label><?php echo h(_T('ui_l_languages')); ?></label><br />
		<?php $ui->control('dropdownlist', 'language', array('items' => FLEA::getAppInf('languages'))); ?>
		<br />
		<br />
		<?php $ui->control('checkbox', 'zobcookie'); ?><label><?php echo h(_T('ui_l_cookie')); ?></label>
		<br />
        <br />
        <input name="login" type="submit" id="login" value="<?php echo h(_T('ui_l_login')); ?>" class="loginbtn" />
      </form>
    </div>
</div>
<div id="bottom" class="bottom" >
    <p style="text-align:right">
        <a href="" target=_blank><?php echo h(_T('ui_l_about')); ?></a>
        <a href="" target=_blank><?php echo h(_T('ui_l_connect')); ?></a>
        <a href="mailto:xuchangyuhui@sohu.com" target=_blank><?php echo h(_T('ui_l_help')); ?></a>
        <a>&nbsp;&#169; 2008 zob.com</a></p>
</div>
</body>
</html>