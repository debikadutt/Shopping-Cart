<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
$fearured = getFeaturedProducts();
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
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top" width="50%">
		<a href="categorydetails.php?cid=<?php print $fearured[0]['cid']; ?>"><?php print $fearured[0]['cname']; ?></a><br />
        <a href="productdetails.php?pid=<?php print $fearured[0]['id']; ?>"><?php print $fearured[0]['name']; ?></a><br />
        <?php print $fearured[0]['price']; ?> INR
       </td>
        <td align="center" valign="top">
        <a href="categorydetails.php?cid=<?php print $fearured[1]['cid']; ?>"><?php print $fearured[1]['cname']; ?></a><br />
        <a href="productdetails.php?pid=<?php print $fearured[1]['id']; ?>"><?php print $fearured[1]['name']; ?></a><br />
        <?php print $fearured[1]['price']; ?> INR
        </td>
      </tr>
      <tr>
        <td align="center" valign="top">
        <a href="categorydetails.php?cid=<?php print $fearured[2]['cid']; ?>"><?php print $fearured[2]['cname']; ?></a><br />
        <a href="productdetails.php?pid=<?php print $fearured[2]['id']; ?>"><?php print $fearured[2]['name']; ?></a><br />
        <?php print $fearured[2]['price']; ?> INR
        </td>
        <td align="center" valign="top">
        <a href="categorydetails.php?cid=<?php print $fearured[3]['cid']; ?>"><?php print $fearured[3]['cname']; ?></a><br />
        <a href="productdetails.php?pid=<?php print $fearured[3]['id']; ?>"><?php print $fearured[3]['name']; ?></a><br />
        <?php print $fearured[3]['price']; ?> INR
        </td>
      </tr>
    </table>
   </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>