<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/tablecloth.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/tablecloth.js"></script>
<script language="javascript" type="text/javascript">
<!--
function fnOnPageChanged(page) {
	var url = '<?php echo $this->_url('list'); ?>&page=' + page;
	document.location.href = url;
}
// -->
</script>
</head>
<body>
<div id="content">
  <h3><?php echo t(_T('ui_mlist_title')); ?></h3>
  <div class="description"><?php echo t(_T('ui_mlist_description')); ?></div>
  <br />
  <table >
    <tr>
      <th align="center" nowrap="nowrap">ID</th>
      <th align="left" nowrap="nowrap"><?php echo t(_T('ui_m_loginname')); ?></th>
      <th align="left" nowrap="nowrap"><?php echo t(_T('ui_m_nickname')); ?></th>
      <th align="right" nowrap="nowrap"><?php echo t(_T('ui_m_email')); ?></th>
      <th align="left" nowrap="nowrap"><?php echo t(_T('ui_m_roles')); ?></th>
      <th align="right" nowrap="nowrap"><?php echo t(_T('ui_m_leader')); ?></th>
      <th align="center" nowrap="nowrap"><?php echo t(_T('ui_o_operation')); ?></th>
      <!-- <th width="100%" align="left" nowrap="nowrap">&nbsp;</th> -->
    </tr>
    <?php $i = 0; foreach($rowset as $row): $css_class = $i % 2 ? 'even' : 'odd'; $rowid = array('id' => $row[$pk]); ?>
    <tr>
     <td align="right" nowrap="nowrap"><?php echo $row[$pk]; ?></td>
     <td align="left" nowrap="nowrap"><a href="<?php echo $this->_url('showMember', array('id' => $row[$pk])); ?>"><?php echo h($row['LoginName']); ?></a></td>
     <td align="left" nowrap="nowrap"><?php echo h($row['NickName']); ?></td>
     <td align="right" nowrap="nowrap"><?php echo h($row['Email']); ?></td>
     <td align="left" nowrap="nowrap">
       <?php foreach ($row['roles'] as $name => $value) { echo $value['Rolename'] . ' '; } ?></td>
     <td align="right" nowrap="nowrap"><?php echo h($row['LeaderID']); ?></td>
     <td align="center" nowrap="nowrap">
	  <a href="<?php echo $this->_url('edit', $rowid); ?>" ><?php echo t(_T('ui_g_operation_edit')); ?></a>&nbsp;/&nbsp;<a href="<?php echo $this->_url('delete', $rowid); ?>" onClick="return(confirm('<?php echo t(_T('ui_p_delete_promption')); ?>'));"><?php echo t(_T('ui_g_operation_remove')); ?></a>
	  </td>
      <!-- <td nowrap="nowrap">&nbsp;</td> -->
    </tr>
    <?php $i++; endforeach; ?>
  </table>
  <?php if ($pager->count > 0): ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td bgcolor="#FCFCFC"><input name="FirstPage" type="button" id="FirstPage" value=" |&lt; " onclick="fnOnPageChanged(<?php echo $pager->firstPage; ?>);" />
        <input name="PrevPage" type="button" id="PrevPage" value=" &lt; " onclick="fnOnPageChanged(<?php echo $pager->prevPage; ?>);" />
        <?php $pager->renderPageJumper(_T('ui_p_jump_page')); ?>
        <input name="NextPage" type="button" id="NextPage" value=" &gt; " onclick="fnOnPageChanged(<?php echo $pager->nextPage; ?>);" />
        <input name="LastPage" type="button" id="LastPage" value=" &gt;| " onclick="fnOnPageChanged(<?php echo $pager->lastPage; ?>);" />
      </td>
    </tr>
  </table>
  <?php else: // if ($pager->count > 0) ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td><?php echo h(_T('ui_o_no_overtimes')); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <?php endif; // if ($pager->count > 0) ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td><?php printf(_T('ui_p_page_info'), $pager->totalCount, $pager->count, $pager->pageCount, $pager->currentPage + 1); ?></td>
    </tr>
  </table>
  </p>
</div>
</body>
</html>
