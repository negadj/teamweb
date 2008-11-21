<?php require dirname(__FILE__) . '/../FLEA/FLEA.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web系统安装页面</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="css/install-style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../FLEA/FLEA/Ajax/jquery.js"></script>

<script language="javascript" type="text/javascript">
function run_setup()
{
	// 发起 ajax 请求运行安装程序
	$.post("setup-database.php", {
		host: "<?php echo h($_GET['host']); ?>",
		login: "<?php echo h($_GET['login']); ?>",
		password: "<?php echo h($_GET['password']); ?>",
		database: "<?php echo h($_GET['database']); ?>"
	}, 
	function(response) {
		$("#log").html(response);
		if (response.indexOf("SUCCESSED.") != -1) {
			$("#btnNext").attr('disabled', false);
		}
	});
}

</script>
</head>
<body onload="run_setup();">

<div id="main">
  <table width="900" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="230" align="right" valign="top"><br />
        <br />
        <br />
        <br />
        <br />
        <ul class="step">
          <li>运行环境检查</li>
          <li>设置安装选项</li>
          <li class="step-current">完成安装</li>
        </ul></td>
      <td width="50" valign="top">&nbsp;</td>
      <td width="520" valign="top"><br />
        <br />
        <br />
        <h3 class="none">安装结果</h3>
        请检查下面显示的安装结果。如果结果不正确，请返回上一步重新设置安装选项并尝试再次安装。<br />
        <br />
        <textarea name="log" id="log" style="width: 100%; font-size: 12px;" rows="20" readonly="readonly">请稍等，正在执行安装.....</textarea>
        <br />
        <br />
        <input name="Back" type="button" class="button" id="btnBack" value="&lt;&lt; 修改安装选项" onclick="document.location.href='set-options.php';" />
        &nbsp;&nbsp;
        <input name="Next" type="button" class="button" id="btnNext" value="完成安装 &gt;&gt;" disabled="disabled" onclick="document.location.href='../index.php';" />
        <br />
        <br />
        <br />
        <br />
        <br />
      </td>
      <td width="100" valign="top">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="footer">
  <div id="footer-show"><a target="_blank">zhouyuhui.com</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    &copy; 2008 <a href="mailto:xuchangyuhui@sohu.com" target="_blank">zhouyuhui </a> </div>
</div>
</body>
</html>
