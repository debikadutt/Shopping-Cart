<?php
require("connection.php");
require("functions.php");

$cats = getCategories();
$orders = getMyOrders();
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
          <td width="40%" align="left" valign="middle" style="padding:0 0 0 5px;">Order Reference Number :: </td>
          <td width="40%" align="left" valign="middle"><input type="text" name="txtorderid" id="txtorderid" /></td>
          <td width="20%" align="center" valign="middle"><input type="submit" name="btnSearch" id="btnSearch" value="Submit" /></td>
        </tr>
      </table>
    </form>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <?php foreach($orders as $key => $value) : ?>
        <?php $ords = explode(":",$key); ?>
            <tr>
                <td align="center" valign="middle" style="font-weight:bold;">Order Reference Number :: <?php print $ords[0]; ?> || Order Status :: <?php $ords[1] == 0 ? print "Order In Progress" : print "Shipped"; ?></td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="1" cellspacing="0" cellpadding="0">
					<?php foreach($value as $k => $val) : ?>
                        <tr>
                            <td width="40%" align="left" valign="middle" style="padding:0 0 0 5px;">Product Name :: <?php print $val['pname']; ?></td>
                            <td width="20%" align="left" valign="middle" style="padding:0 0 0 5px;">Price :: <?php print $val['pprice']; ?></td>
                            <td width="20%" align="left" valign="middle" style="padding:0 0 0 5px;">Quantity :: <?php print $val['pqty']; ?></td>
                            <td width="20%" align="left" valign="middle" style="padding:0 0 0 5px;">Total :: <?php print $val['pqty']*$val['pprice']; ?></td>
                        </tr>
					<?php endforeach; ?>
                    </table>
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