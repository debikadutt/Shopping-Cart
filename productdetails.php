<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
$proddetail = getIndiProdDetail();
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
    <td width="80%" align="left" valign="top" style="padding-left:10px;">
    <h2><?php print $proddetail['name']; ?></h2>
    <p>
    <?php print $proddetail['description']; ?><br />
    <?php print $proddetail['price']; ?> INR<br />
    <a href="cart.php?pid=<?php print $proddetail['id']; ?>">Add to Cart</a>
    </p>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>