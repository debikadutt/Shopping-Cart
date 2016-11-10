<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
$productslist = getAllProducts();
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
    <?php foreach ($productslist as $products) : ?>
  <tr>
    <td align="center" valign="middle">
    <a href="categorydetails.php?cid=<?php print $products['cid']; ?>"><?php print $products['cname']; ?></a><br />
        <a href="productdetails.php?pid=<?php print $products['id']; ?>"><?php print $products['name']; ?></a><br />
        <a href="cart.php?pid=<?php print $products['id']; ?>">Add to Cart</a>
        <?php print $products['price']; ?> INR
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>