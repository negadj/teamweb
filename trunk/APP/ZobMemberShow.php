<?php include 'ZobHeader.php' ?>
<div id=home_cont class="home_cont">
  <div style="float:left; width:35%">
    <a href="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['photo']; ?>"
       target="blank">
     <img src="<?php echo FLEA::getAppInf('uploadRoot') . '/' . $member['photo']; ?>" 
        border="0" width=300 /></a>
  </div>
  <div style="float:right; width:55%">
    <div><span class=membername><?php echo $member['name']; ?></span>
        <hr style="color:lightblue; height:1px;"/></div>
    <table class="memberblock">
      <tr><td class=memberitem><?php echo h(_T('ui_m_sex')); ?>:</td>
          <td class=memberinfo><?php if(0 == $member['sex']) {echo h(_T('ui_m_male')); } else {echo h(_T('ui_m_female')); } ?></td></tr>
      <tr><td class=memberitem><?php echo h(_T('ui_m_university')); ?>:</td>
          <td class=memberinfo><?php echo $member['university']; ?></td></tr>
      <tr><td class=memberitem><?php echo h(_T('ui_m_experience')); ?>:</td>
          <td class=memberinfo><?php echo $member['experiences']; ?></td></tr>
      <tr><td class=memberitem><?php echo h(_T('ui_m_hobby')); ?>:</td>
          <td class=memberinfo><?php echo $this->_formatText($member['hobbies']); ?></td></tr>
      <tr><td class=memberitem><?php echo h(_T('ui_m_skill')); ?>:</td>
          <td class=memberinfo><?php echo $this->_formatText($member['skills']); ?></td></tr>
      <tr><td class=memberitem><?php echo h(_T('ui_m_introduction')); ?>:</td>
          <td class=memberinfo><?php echo $this->_formatText($member['introduction']); ?></td></tr></table>
  </div>
</div>
<?php include 'ZobFoot.php' ?>