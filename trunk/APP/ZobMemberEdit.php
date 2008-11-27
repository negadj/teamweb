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
	if (form.MemberID.value == '' ||
	    form.LoginName.value == '' ||
	    form.Email.value == '')
	{
		alert('<?php echo h(_T('ui_o_form_validation')); ?>');
		form.Save.disabled = false;
		return false;
	}
	
	var el = form['roles[]'];
	if (el.selectedIndex == -1) {
		alert('<?php echo h(_T('ui_o_form_validation')); ?>');
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
  <h3><?php if($member['member_id'] == 0) {echo h(_T('ui_m_addmember'));} else {echo h(_T('ui_m_editmember'));} ?></h3>
  <form action="<?php echo $this->_url('save'); ?>" method="post" name="form1" id="form1" 
        enctype="multipart/form-data"  onsubmit="return fnOnSubmit(this);">
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_name')); ?>:</strong>
    <?php html_textbox('name', $member['name'], 30, 24); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_sex')); ?>:</strong>
    <?php html_dropdown_list('sex', array(h(_T('ui_m_male')), h(_T('ui_m_female'))), $member['sex']); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_university')); ?>:</strong>
    <?php html_textbox('university', $member['university'], 30, 24); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_experience')); ?>:</strong>
    <?php html_textbox('experiences', $member['experiences'], 30, 24); ?>
	<br />
	<br />
	<span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_headimg')); ?>:</strong>
	<input name="headimg" type="file" size="60" /><br />
	<span style="color: red"><?php echo t(_T('ui_m_headimg_note')); ?></span>
	<br />
	<br />
	<span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_photo')); ?>:</strong>
	<input name="photo" type="file" size="60" /><br />
	<span style="color: red"><?php echo t(_T('ui_m_photo_note')); ?></span>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_hobby')); ?></strong><br />
    <?php html_textarea('hobbies', $member['hobbies'], 60, 5); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_skill')); ?></strong><br />
    <?php html_textarea('skills', $member['skills'], 60, 5); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_introduction')); ?></strong><br />
    <?php html_textarea('introduction', $member['introduction'], 60, 5); ?>
	<br />
    <br />
    <input class="btn" name="Save" type="submit" id="Save" value="<?php echo h(_T('ui_g_save')); ?>" />
	&nbsp;&nbsp;
    <input class="btn" name="Cancel" type="button" id="Cancel" value="<?php echo h(_T('ui_g_cancel')); ?>" onclick="fnOnBack();" />
    <input name="member_id" type="hidden" id="member_id" value="<?php echo $member['member_id']; ?>" />
  </form>
</div>
</body>
</html>
