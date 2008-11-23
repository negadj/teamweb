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
  <h3><?php if($member['MemberID'] == 0) {echo h(_T('ui_m_addmember'));} else {echo h(_T('ui_m_editmember'));} ?></h3>
  <div class="description"><?php if($member['MemberID'] == 0) {echo t(_T('ui_m_addmember_description'));} 
                             else {echo t(_T('ui_m_editmember_description'));}?></div>
  <br />
  <p class="error-msg"><?php echo $errorMessage; ?></p>
  <form action="<?php echo $this->_url($action); ?>" method="post" name="form1" id="form1" onsubmit="return fnOnSubmit(this);">
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_memid')); ?>:</strong>
    <?php html_textbox('MemberID', $member['MemberID'], 10, 10); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_loginname')); ?>:</strong>
    <?php html_textbox('LoginName', $member['LoginName'], 30, 24); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_p_sex')); ?>:</strong>
    <?php html_dropdown_list('Sex', array(h(_T('ui_p_male')), h(_T('ui_p_female'))), $member['Sex']); ?>
	<br />
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_p_email')); ?>:</strong>
    <?php html_textbox('Email', $member['Email'], 40, 80); ?>
	<br />	
	<br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_roles')); ?>:</strong><br>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <select name="roles[]" size="8" multiple="multiple" id="roles[]">
    	<?php
    	if (isset($member['roles'])) {
    		$selectedRoles = (array)$member['roles'];
    	} else {
    		$selectedRoles = array();
    	}
    	foreach ($roles as $role):
            $roleName = $role['Rolename'];
    	?>
    	<option value="<?php echo $role['RoleID']; ?>"<?php if (in_array($role['RoleID'], $selectedRoles)): ?>selected<?php endif; ?>>
    	    <?php echo t($roleName); ?></option>
    	<?php endforeach; ?>
    </select>
	<br />
    <br />
    <span class="error-msg">*&nbsp;</span><strong><?php echo h(_T('ui_m_leader')); ?>:</strong>
    <?php html_textbox('LeaderID', $member['LeaderID'], 10, 10); ?>
	<br />
    <br />
    <input name="Save" type="submit" id="Save" value="<?php echo h(_T('ui_g_submit')); ?>" />
	&nbsp;&nbsp;
    <input name="Cancel" type="button" id="Cancel" value="<?php echo h(_T('ui_g_cancel')); ?>" onclick="fnOnBack();" />
  </form>
</div>
</body>
</html>
