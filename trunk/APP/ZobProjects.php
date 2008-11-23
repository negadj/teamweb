<?php include 'ZobHeader.php' ?>
<script language="javascript" type="text/javascript">
    function mouseOver(li) {
        li.className = "hover";
    } 
    function mouseOut(li) {
        li.className = "current";
    }     
    
    function fnOnPageChanged(page) {
    	var url = '<?php echo $this->_url(null); ?>&page=' + page;
    	document.location.href = url;
    }
</script>
<div id=home_cont class="home_cont">
    <div id=home_left class="home_left">
        <?php $i = 0; foreach($rowset as $row): $id = array('id' => $row[$pk]); ?>
            <div class="title"><img class="image" src="images/arrow.bmp" /><?php echo $row['name']; ?></div>
            <span><?php echo $this->_formatPost($row['introduction']); ?></span>
            <div class="time"><?php echo _T('ui_p_status') . $row['status']; ?></div>
            <hr size="1" noshade style="{border:1px dotted #A0A0A0}" />
        <?php $i++; endforeach; ?>
        <?php if ($pager->count > 0): ?>
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
            <tr>
              <td bgcolor="#FCFCFC">
                <input name="FirstPage" type="button" id="FirstPage" 
                       value=" |&lt; " onclick="fnOnPageChanged(<?php echo $pager->firstPage; ?>);" />
                <input name="PrevPage" type="button" id="PrevPage" value=" &lt; " 
                       onclick="fnOnPageChanged(<?php echo $pager->prevPage; ?>);" />
                <?php $pager->renderPageJumper(_T('ui_p_jump_page')); ?>
                <input name="NextPage" type="button" id="NextPage" value=" &gt; " 
                       onclick="fnOnPageChanged(<?php echo $pager->nextPage; ?>);" />
                <input name="LastPage" type="button" id="LastPage" value=" &gt;| " 
                       onclick="fnOnPageChanged(<?php echo $pager->lastPage; ?>);" />
              </td></tr></table>
        <?php endif; // if ($pager->count > 0) ?>
    </div>
    <?php include 'ZobRightBar.php' ?>
</div>
<?php include 'ZobFoot.php' ?>