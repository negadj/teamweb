<?php include 'ZobHeader.php' ?>
<div id=home_cont class="home_cont">
  <div style="float:left; width:35%">
    <a href="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['photo']; ?>"
       target="blank">
     <img src="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['photo']; ?>" 
        border="0" width=300 /></a>
  </div>
  <div style="float:right; width:55%">
    <table class="memberblock">
      <tr>
        <td class=MemberInfo><?php echo h(_T('ui_m_name')); ?>:</td>
        <td ><?php echo $member['name']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_sex')); ?>:</td>
          <td><?php if(0 == $member['sex']) {echo h(_T('ui_m_male')); } else {echo h(_T('ui_m_female')); } ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_university')); ?>:</td>
          <td><?php echo $member['university']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_experience')); ?>:</td>
          <td><?php echo $member['experiences']; ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_hobby')); ?>:</td>
          <td><?php echo $this->_formatText($member['hobbies']); ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_skill')); ?>:</td>
          <td><?php echo $this->_formatText($member['skills']); ?></td></tr>
      <tr><td class=MemberInfo><?php echo h(_T('ui_m_introduction')); ?>:</td>
          <td><?php echo $this->_formatText($member['introduction']); ?></td></tr></table>
  </div>
</div>
<?php include 'ZobFoot.php' ?>