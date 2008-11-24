<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<?php FLEA::loadFile('FLEA_Helper_Html.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function fnOnBack() {
	var url = '<?php echo $this->_getBack(); ?>';
	document.location.href = url;
}

function fnOnSubmit(form) {
	form.Save.disabled = true;
	if (form.name.value == '' || form.introduction.value == '' || form.status.value == '')
	{
		alert('<?php echo h(_T('ui_p_form_validation')); ?>');
		form.Save.disabled = false;
		return false;
	}

	return true;
}

// -->
</script>
</head>
<body>
<div id="content">
  <h3><?php echo h(_T('ui_p_edit')); ?></h3>
  <br />
  <form action="<?php echo $this->_url('save'); ?>" method="post" name="form1" id="form1" onsubmit="return fnOnSubmit(this);">
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_p_name')); ?></strong><br />
    <?php html_textbox('name', $project['name'], 80, 120); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_p_introduction')); ?></strong><br />
    <?php html_textarea('introduction', $project['introduction'], 60, 10); ?>
	<br />
	<br />
	<span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_p_status')); ?></strong><br />
    <?php html_textbox('status', $project['status'], 80, 120); ?>
	<br />
    <br />
    <input name="Save" class="btn" type="submit" id="Save" value="<?php echo h(_T('ui_g_submit')); ?>" />
	&nbsp;&nbsp;
    <input name="Cancel" class="btn" type="button" id="Cancel" value="<?php echo h(_T('ui_g_cancel')); ?>" onclick="fnOnBack();" />
    <input name="project_id" type="hidden" id="project_id" value="<?php echo $project['project_id']; ?>" />
  </form>
</div>
</body>
</html>
