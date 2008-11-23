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

	if (form.postfile.value == '') {
		alert('<?php echo t2js(_T('ui_p_picman_form_validation')); ?>');
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
  <h3><?php echo h(_T('ui_p_picman_welcome')); ?></h3>
  <div class="description"><?php echo t(_T('ui_p_picman_description')); ?></div>
  <br />
  <p class="error-msg"><?php echo $errorMessage; ?></p>
	<br />
	<strong><?php echo h(sprintf(_T('ui_p_picman_thumb'), FLEA::getAppInf('thumbWidth'), FLEA::getAppInf('thumbHeight'))); ?>:</strong><br />
      <table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="#DDEEEE">
        <tr>
          <?php if ($member['HeadImage'] != ''): ?>
          <td width="<?php echo FLEA::getAppInf('thumbWidth') + 20; ?>" align="center" valign="middle"><img src="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['HeadImage']; ?>" border="0" width="<?php echo FLEA::getAppInf('thumbWidth'); ?>" height="<?php echo FLEA::getAppInf('thumbHeight'); ?>" /></td>
          <?php endif; ?>
          <td valign="top"><br />
            <?php if ($member['HeadImage'] != ''): ?>
            <?php echo h(_T('ui_p_picman_filename')); ?>: <?php echo h($member['HeadImage']); ?><br />
            <?php echo h(_T('ui_p_picman_filesize')); ?>: <?php echo ceil(filesize(FLEA::getAppInf('uploadDir') . DS . $member['HeadImage']) / 1024); ?> KB<br />
            <br />
            <?php endif; ?>
            <form action="<?php echo url($this->_controllerName, 'uploadThumb', array('id' => $member['MemberID'])); ?>" method="post" enctype="multipart/form-data" name="form2" id="form2" style="margin: 0px; padding: 0px;" onsubmit="return fnOnSubmit(this);">
              <?php echo h(_T('ui_p_picman_thumb_upload')); ?>:<br />
              <input name="postfile" type="file" size="40" />
              <br />
              <br />
              <input name="Save" type="submit" value="<?php echo h(_T('ui_p_picman_upload')); ?>" />
              <br />
              <br />
              <span class="red"><?php echo t(_T('ui_p_picman_thumb_note')); ?></span>
            </form>
            <br /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
	<br />
    <br />
    <input name="MemberID" type="hidden" id="MemberID" value="<?php echo $member['MemberID']; ?>" />
</div>
</body>
</html>
