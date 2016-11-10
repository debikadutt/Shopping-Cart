<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
doLogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XYZ Shopping Portal</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "header.php"; ?></td>
  </tr>
  <tr>
    <td width="20%" align="left" valign="top"><?php print buildCatNav($cats); ?></td>
    <td width="80%" align="left" valign="top">
    <form action="" method="post">
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="37%" align="left" valign="middle" style="padding:0 0 0 10px;">Username</td>
          <td width="63%" align="left" valign="middle"><input type="text" name="txtusername" id="txtusername" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle" style="padding:0 0 0 10px;">Password</td>
          <td align="left" valign="middle"><input type="password" name="txtpassword" id="txtpassword" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
          <td align="left" valign="middle"><input type="submit" name="btnLogin" id="btnLogin" value="Login" /></td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>