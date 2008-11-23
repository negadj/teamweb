<?php include 'ZobHeader.php' ?>
<script language="javascript" type="text/javascript">
    function fnOnPageChanged(page) {
    	var url = '<?php echo $this->_url(null); ?>&page=' + page;
    	document.location.href = url;
    }
</script>
<div id=home_cont class="home_cont">
    <div id=home_left class="home_left">
        <?php $i = 0; $dataCount = count($rowset); for($i = 0; $i < $dataCount; $i = $i+3): ?>
            <br />
            <?php $rowCount = $i + 3; if($i + 3 > $dataCount) $rowCount = $dataCount; 
                  for($j = $i; $j < $rowCount; $j++): 
                  $marginleft = $j*160;
                  if($j > 2) $marginleft = ($j - 3)*160;
                  $margintop = 0;
                  if($j % 3 != 0) $margintop = -70; ?>
            <div class="headerimg" 
                 style="margin-left:<?php echo $marginleft; ?>px; margin-top: <?php echo $margintop; ?>px;">
                <img style={padding-top: 2px;} height=55 src="upload/defaulthead.jpg" width=55 border=0></div>
            <div style="margin-left:<?php echo $marginleft + 90; ?>px; margin-top: -80px;">
                <p><a class=sl href="">
                <?php echo $rowset[$j]['name']; ?></a></p></div><br />
            <?php endfor; ?>
            <hr size="1" noshade style="{border:1px dotted #A0A0A0}" />
        <?php endfor; ?>
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