<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
doOrder();
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
        <td width="30%" align="center" valign="top">Shipping Address:</td>
        <td width="70%" align="left" valign="top"><textarea name="txtshipaddr" id="txtshipaddr" cols="45" rows="5"></textarea></td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><input type="submit" name="btnOrder" id="btnOrder" value="Submit" /></td>
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