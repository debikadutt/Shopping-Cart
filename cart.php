<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
$cart = getCartItems();
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
    <?php if (count($cart) > 0) : ?>
    <form action="" method="post">
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr style="font-weight:bold;">
        <td align="center" valign="top">#</td>
        <td align="center" valign="top">Name</td>
        <td align="center" valign="top">Price</td>
        <td align="center" valign="top">Quantity</td>
        <td align="center" valign="top">Total</td>
      </tr>
      <?php $total = 0; ?>
      <?php foreach ($cart as $ck => $cv) : ?>
      <tr>
        <td align="center" valign="top"><?php print $ck + 1; ?><input type="hidden" name="id[<?php print $cv['id']; ?>]" value="<?php print $cv['id']; ?>"  /></td>
        <td align="center" valign="top"><?php print $cv['name']; ?></td>
        <td align="center" valign="top"><?php print $cv['price']; ?> INR</td>
        <td align="center" valign="top"><input type="text" name="qty[<?php print $cv['id']; ?>]" value="<?php print $cv['qty']; ?>" style="width:50px;" /></td>
        <td align="center" valign="top"><?php print $cv['price'] * $cv['qty']; ?> INR&nbsp;&nbsp;<a href="deletecart.php?pid=<?php print $cv['id']; ?>"><strong>X</strong></a></td>
      </tr>
      <?php $total = $total + ($cv['price'] * $cv['qty']); ?>
      <?php endforeach; ?>
      <tr>
      	<td align="right" valign="top" colspan="3"><input type="submit" name="btnUpdCart" value="Update" /></td>
        <td align="center" valign="top">Total :: </td>
        <td align="center" valign="top"><?php print $total; ?> INR</td>
      </tr>
      <tr>
      	<td align="center" valign="middle" colspan="5"><a href="order.php">Order</a></td>
      </tr>
    </table>
    </form>
    <?php else : ?>
    <h4>Your cart is empty now!!</h4>
    <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><?php include "footer.php"; ?></td>
  </tr>
</table>
</body>
</html>