<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); 
      $ui =& FLEA::initWebControls();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<!-- <title><?php echo FLEA::getAppInf('appTitle'); ?><?php echo h(_T('ui_w_title')); ?></title> -->
<title><?php echo h(_T('ui_g_title')); ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
    function fnOnLanguageChanged(lang) {
    	var url = '<?php echo $this->_url('changeLang'); ?>&lang=' + lang;
    	parent.document.location.href = url;
    }
</script>
</head>
<body>
<center>
<div>
    <img src="images/ironman.jpg" /></div>
<div id=home_header class="home_header">
    <div>
        <a href="<?php echo url('ZobHome', 'index'); ?>"><?php echo h(_T('ui_g_home')); ?></a>
        <a href="<?php echo url('ZobHome', 'team'); ?>"><?php echo h(_T('ui_g_team')); ?></a>
        <a href="<?php echo url('ZobHome', 'projects'); ?>"><?php echo h(_T('ui_g_projects')); ?></a>
        <a href="<?php echo url('ZobHome', 'members'); ?>"><?php echo h(_T('ui_g_members')); ?></a></div>
    <div style="{float: right; padding-top: 5px; padding-right: 5px; }">
        <?php   $ui->control('dropdownlist', 'language', array(
            	'items' => FLEA::getAppInf('languages'),
            	'selected' => FLEA::getAppInf('defaultLanguage'),
            	'onchange' => 'fnOnLanguageChanged(this.value);')); ?></div>
</div>