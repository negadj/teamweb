<?php defined('APP_DIR') or die ('Direct Access to this location is not allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo RESPONSE_CHARSET; ?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript">
    function toggleBlock(id){
        var menudiv = document.getElementById(id);
    	var state = menudiv.style.display;
    	
    	if(state == "none")
    	{
        	menudiv.style.display = "block";
        	document.getElementById(id + '_toggle').className = 'win_block';
    	}
    	else if(state == "block" || state == "")
    	{
        	menudiv.style.display = "none";
        	document.getElementById(id + '_toggle').className = 'win_none';
    	}
    }
</SCRIPT>
</head>
<body>
<div id="sidebar">
  <!-- BEGIN sidebar -->
<?php
$defaultAction = FLEA::getAppInf('defaultAction');
$id = 0;
foreach ($catalog as $cat) {
	$menu = $cat[1];
	$out = '';
	foreach ($menu as $item) {
		$controllerName = $item[1];
		$actionName = isset($item[2]) ? $item[2] : $defaultAction;
		if (!$dispatcher->check($controllerName, $actionName)) { continue; }
		$out .= "<li><a href=\"" . url($controllerName, $actionName, isset($item[3]) ? $item[3] : null) . "\" target=\"mainFrame\">" . $item[0] . "</a></li>\n";
	}

	if ($out == '') { continue; }
	$updown = "<a href=\"javascript:void(0);\" id=\"menudiv_{$id}_toggle\" class=\"win_block\" onclick=\"toggleBlock('menudiv_{$id}')\" ></a>";
	$out =  "<h3>" . $updown . "&nbsp;{$cat[0]}</h3><div id=\"menudiv_{$id}\" ><ul>" . $out . "</ul></div>";
	//$out = "<h3><img src=\"images/cat-expanded.gif\" border=\"0\" />&nbsp;{$cat[0]}</h3>"
	//        . $updown . "<div><ul>" . $out . "</ul></div>";
	echo $out;
	$id++;
}
?>
<!-- END sidebar -->
</div>
</body>
</html>
