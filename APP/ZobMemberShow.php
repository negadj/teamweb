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
-->
</script>
</head>
<body>
<div id="member">
  <h3><?php echo h(_T('ui_m_profile')); ?></h3>
  <br />
  <input name="Back" type="button" id="Back" value="<?php echo h(_T('ui_g_back')); ?>" onclick="fnOnBack();" />
  <p class="error-msg"><?php echo $errorMessage; ?></p>
  <div class=HeaderBlock>
    <table cellSpacing=0 cellPadding=0 border=0>
    <tr><td class=HeadImage align="center" valign="middle"
            width="<?php echo FLEA::getAppInf('thumbWidth') + 20; ?>" 
            height="<?php echo FLEA::getAppInf('thumbHeight'); ?>" >
            <img src="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['HeadImage']; ?>" 
            border="0" width="<?php echo FLEA::getAppInf('thumbWidth'); ?>" /></td></tr></table>
  </div>
  <div class=MemberBlock>
    <table cellSpacing=0 cellPadding=0 border=0 >
      <tr>
        <td class=MemberInfo><?php echo h(_T('ui_p_nickname')); ?>:</td>
        <td ><?php echo $member['NickName']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_sex')); ?>:</td>
          <td><?php if(0 == $member['Sex']) {echo h(_T('ui_p_male')); } else {echo h(_T('ui_p_female')); } ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_memid')); ?>:</td>
          <td><?php echo $member['MemberID']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_email')); ?>:</td>
          <td><?php echo $member['Email']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_university')); ?>:</td>
          <td><?php echo $member['University']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_leader')); ?>:</td>
          <td><?php $leader = $this->_modelMembers->getMember($member['LeaderID']); 
                    echo $leader['NickName']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_city')); ?>:</td>
          <td><?php echo $member['HomeCity']; ?></td></tr></table>
  </div>
  <br />
</div>
</body>
</html>
