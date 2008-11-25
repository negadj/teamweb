<?php include 'ZobHeader.php' ?>
<script language="javascript" type="text/javascript">
    function fnOnPageChanged(page) {
    	var url = '<?php echo $this->_url('members'); ?>&page=' + page;
    	document.location.href = url;
    }
</script>
<div id=home_cont class="home_cont">
  <div class=HeaderBlock>
     <img src="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['HeadImage']; ?>" 
          border="0" />
  </div>
  <div class=MemberBlock>
    <table cellSpacing=0 cellPadding=0 border=0 >
      <tr>
        <td class=MemberInfo><?php echo h(_T('ui_p_nickname')); ?>:</td>
        <td ><?php echo $member['name']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_sex')); ?>:</td>
          <td><?php if(0 == $member['sex']) {echo h(_T('ui_p_male')); } else {echo h(_T('ui_p_female')); } ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_memid')); ?>:</td>
          <td><?php echo $member['MemberID']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_email')); ?>:</td>
          <td><?php echo $member['Email']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_university')); ?>:</td>
          <td><?php echo $member['university']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_leader')); ?>:</td>
          <td><?php $leader = $this->_modelMembers->getMember($member['LeaderID']); 
                    echo $leader['NickName']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_p_city')); ?>:</td>
          <td><?php echo $member['HomeCity']; ?></td></tr></table>
  </div>
</div>
<?php include 'ZobFoot.php' ?>