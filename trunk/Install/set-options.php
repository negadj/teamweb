<?php require dirname(__FILE__) . '/../FLEA/FLEA.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web系统安装页面</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="css/install-style.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
function fnOnSubmit(form) {
    if (form.database.value == '') {
        alert('必须输入数据库名称');
        form.database.focus();
        return false;
    }

    return true;
}
</script>
</head>
<body>
<div id="main">
  <table width="900" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="230" align="right" valign="top">
	    <br />
        <br />
        <br />
        <br />
        <br />
        <ul class="step">
          <li>运行环境检查</li>
          <li class="step-current">设置安装选项</li>
          <li>完成安装</li>
        </ul></td>
      <td width="50" valign="top">&nbsp;</td>
      <td width="520" valign="top"><br />
        <br />
        <br />
        <h3 class="none">设置安装选项</h3>
        安装 JobFriends 运行所需的数据库。如果不使用数据库，则平台无法运行。<br />
        <br />
        <span class="error">注意：如果已经安装过数据库，则再次安装会覆盖掉现有的数据。</span><br />
        <br />
        <form action="complete-install.php" method="get" name="form1" id="form1" onsubmit="return fnOnSubmit(this);">
          数据库类型：
          <select name="driver">
            <option value="mysql" selected="selected">MySQL</option>
          </select>
          <br />
          数据库主机：
          <input name="host" type="text" class="inputbox" id="host" value="localhost" />
          <br />
          数据库用户：
          <input name="login" type="text" class="inputbox" id="login" value="root" />
          <br />
          数据库密码：
          <input name="password" type="text" class="inputbox" id="password" />
          <br />
          数据库名称：
          <input name="database" type="text" class="inputbox" id="database" value="web" />
          <br />
          <br />
          <input name="Next" type="submit" id="Next" value="开始安装 &gt;&gt;" class="button" />
          <br />
          <br />
          <br />
          <br />
          <br />
        </form></td>
      <td width="100" valign="top">&nbsp;</td>
    </tr>
  </table>
</div>
<div id="footer">
  <div id="footer-show"><a target="_blank">zhouyuhui.com</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    &copy; 2005-2008 <a href="mailto:xuchangyuhui@sohu.com" target="_blank">zhouyuhui </a> </div>
</div>
</body>
</html>
