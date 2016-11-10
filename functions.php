<?php
function pr($array=array())
{
	print "<pre>";
	print_r($array);
	print "</pre>";
}

function redirect($url)
{
	print "<script>window.location='".$url."';</script>";
}

function getCategories()
{
	$return = array();
	$rs = mysql_query("select id,name from category where parent_id = 0");
	while ($data = mysql_fetch_object($rs))
	{
		$return[$data->id]['id'] = $data->id;
		$return[$data->id]['name'] = $data->name;
		$return[$data->id]['child'] = getChildCategory($data->id);
	}
	
	return $return;
}

function getChildCategory($id=0)
{
	$return = array();
	$rs = mysql_query("select id,name from category where parent_id = ".$id);
	while ($data = mysql_fetch_object($rs))
	{
		$return[$data->id]['id'] = $data->id;
		$return[$data->id]['name'] = $data->name;
		$return[$data->id]['child'] = getChildCategory($data->id);
	}
	
	return $return;
}

function getFeaturedProducts()
{
	$return = array();
	$rs = mysql_query("SELECT p.id, p.name, p.price,c.id as cid,c.name as cname FROM product p,category c WHERE p.category_id = c.id LIMIT 4");
	$i = 0;
	while ($data = mysql_fetch_object($rs))
	{
		$return[$i]['id'] = $data->id;
		$return[$i]['name'] = $data->name;
		$return[$i]['price'] = $data->price;
		$return[$i]['cid'] = $data->cid;
		$return[$i]['cname'] = $data->cname;
		$i++;
	}
	return $return;
}

function getAllProducts()
{
	$return = array();
	$rs = mysql_query("SELECT p.id, p.name, p.price,c.id as cid,c.name as cname FROM product p,category c WHERE p.category_id = c.id");
	$i = 0;
	while ($data = mysql_fetch_object($rs))
	{
		$return[$i]['id'] = $data->id;
		$return[$i]['name'] = $data->name;
		$return[$i]['price'] = $data->price;
		$return[$i]['cid'] = $data->cid;
		$return[$i]['cname'] = $data->cname;
		$i++;
	}
	return $return;
}

function buildCatNav($cats = array())
{
	$catnav = '<ul>';
	$catnav .= '<li><a href="index.php">Home</a></li>';
	$catnav .= '<li><a href="productlist.php">Products</a></li>';
	if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 2)
	{
		$catnav .= '<li><a href="account.php">Account</a></li>';
		$catnav .= '<li><a href="logout.php">Logout</a></li>';
	}
	elseif(isset($_SESSION['user_id']) && $_SESSION['user_id'] == 2)
	{
		$catnav .= '<li><a href="adminaccount.php">Account</a></li>';
		$catnav .= '<li><a href="logout.php">Logout</a></li>';
	}
	else
	{
		$catnav .= '<li><a href="login.php">Login</a></li>';
		$catnav .= '<li><a href="register.php">Register</a></li>';
	}
	foreach ($cats as $cat)
	{
		$catnav .= '<li><a href="categorydetails.php?cid='.$cat['id'].'">'.$cat['name'].'</a>';
		if (count($cat['child']) > 0)
		{
			$catnav .= '<ul>';
			foreach ($cat['child'] as $chl1)
			{
				$catnav .= '<li><a href="categorydetails.php?cid='.$chl1['id'].'">'.$chl1['name'].'</a>';
				$catnav .= '</li>';
			}
			$catnav .= '</ul>';
		}
		$catnav .= '</li>';
	}
	$catnav .= '<ul>';
	return $catnav;
}

function getIndiCatDetail()
{
	$id = isset($_GET['cid']) && is_numeric($_GET['cid']) ? $_GET['cid'] : 0;
	if ($id <= 0)
		redirect("index.php");
	$return = array();
	$rs = mysql_query("select c.id,c.name,c.description from category c where c.id = ".$id);
	$data = mysql_fetch_object($rs);
	$return['id'] = $data->id;
	$return['name'] = $data->name;
	$return['description'] = $data->description;
	return $return;
}

function getIndiProdDetail()
{
	$id = isset($_GET['pid']) && is_numeric($_GET['pid']) ? $_GET['pid'] : 0;
	if ($id <= 0)
		redirect("index.php");
	$return = array();
	$rs = mysql_query("SELECT p.id, p.name,p.description,p.price,c.id as cid,c.name as cname FROM product p,category c WHERE p.category_id = c.id AND p.id = ".$id);
	$data = mysql_fetch_object($rs);
	$return['id'] = $data->id;
	$return['name'] = $data->name;
	$return['description'] = $data->description;
	$return['price'] = $data->price;
	$return['cid'] = $data->cid;
	$return['cname'] = $data->cname;
	return $return;
}

function getCartItems()
{
	$cart = array();
	if (isset($_POST['btnUpdCart']))
	{
		foreach ($_SESSION['cart'] as $k => $v)
		{
			if ($_POST['qty'][$v['id']] != $v['qty'])
			{
				$_SESSION['cart'][$k]['qty'] = $_POST['qty'][$v['id']];
			}
		}
	}
	if (isset($_GET['pid']) && is_numeric($_GET['pid']))
	{
		updateCart();
		redirect("cart.php");
	}
	$cart = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : array();
	return $cart;
}

function updateCart()
{
	if (!isset($_SESSION['cart']))
	{
		$rs = mysql_query("select p.id,p.name,p.price from product p where p.id = ".$_GET['pid']);
		if (mysql_num_rows($rs) > 0)
		{
			$_SESSION['cart'] = array();
			$data = mysql_fetch_object($rs);
			$_SESSION['cart'][] = array('id' => $data->id,'name' => $data->name,'price' => $data->price,'qty' => '1');
		}
	}
	else
	{
		if (is_array($_SESSION['cart']))
		{
			$flag = 0;
			foreach ($_SESSION['cart'] as $cid => $cart)
			{
				if ($_GET['pid'] == $cart['id'])
				{
					$_SESSION['cart'][$cid]['qty'] = $cart['qty'] + 1;
					$flag = 1;
				}
			}
			
			if ($flag == 0)
			{
				$rs = mysql_query("select p.id,p.name,p.price from product p where p.id = ".$_GET['pid']);
				if (mysql_num_rows($rs) > 0)
				{
					$data = mysql_fetch_object($rs);
					$_SESSION['cart'][] = array('id' => $data->id,'name' => $data->name,'price' => $data->price,'qty' => '1');
				}
			}
		}
	}
}

function deleteCartItem()
{
	$id = isset($_GET['pid']) && is_numeric($_GET['pid']) ? $_GET['pid'] : 0;
	if ($id > 0)
	{
		$carts = $_SESSION['cart'];
		$ncart = array();
		foreach ($_SESSION['cart'] as $cart)
		{
			if ($_GET['pid'] != $cart['id'])
			{
				$ncart[] = $cart;
			}
		}
		$_SESSION['cart'] = $ncart;
	}
	redirect("cart.php");
}

function doOrder()
{
	if (!isset($_SESSION['user_id']))
	{
		$_SESSION['red_url'] = "order.php";
		redirect("login.php");
	}
	
	if (isset($_POST['btnOrder']))
	{
		if (!empty($_POST['txtshipaddr']))
		{
			$ref = "ORD";
			$ref .= rand(1111111,9999999);
			if (mysql_query("insert into orders set user_id = ".$_SESSION['user_id']." ,oreference = '".$ref."',shipaddr = '".$_POST['txtshipaddr']."'"))
			{
				$oid = mysql_insert_id();
				foreach ($_SESSION['cart'] as $cart)
				{
					mysql_query("insert into cart set order_id = ".$oid.",product_id = ".$cart['id'].",pname = '".$cart['name']."',pprice = '".$cart['price']."',pqty = ".$cart['qty']);
				}
				redirect("account.php");
			}
			else
			{
				die(mysql_error());
			}
		}
		else
		{
			print "<script>alert('Enter Shipping Address!');</script>";
		}
	}
}

function doLogin()
{
	if (isset($_POST['btnLogin']))
	{
		if (!empty($_POST['txtusername']) && !empty($_POST['txtpassword']))
		{
			$rs = mysql_query("select * from users where username = '".$_POST['txtusername']."'");
			if ($rs && mysql_num_rows($rs) > 0)
			{
				$user = mysql_fetch_object($rs);
				if ($user->password == $_POST['txtpassword'])
				{
					$_SESSION['user_id'] = $user->id;
					$rurl = "account.php";
					if (isset($_SESSION['red_url']))
					{
						$rurl = $_SESSION['red_url'];
						unset($_SESSION['red_url']);
					}
					if ($user->username == 'admin')
					{
						$rurl = "adminaccount.php";
					}
					redirect($rurl);
				}
				else
				{
					print "<script>alert('Invalid password!');</script>";
				}
			}
			else
			{
				print "<script>alert('Invalid username/password!');</script>";
			}
		}
		else
		{
			print "<script>alert('Invalid username/password!');</script>";
		}
	}
}

function getMyOrders()
{
	$sub_qry = "";
	if (!isset($_SESSION['user_id']))
	{
		$_SESSION['red_url'] = "account.php";
		redirect("login.php");
	}
	else
	{
		$return = array();
		if(isset($_POST['txtorderid']) && !empty($_POST['txtorderid']))
		{
			$sub_qry = " and oreference = '".$_POST['txtorderid']."'";
		}
		$rs = mysql_query("select id,oreference,ostst from orders where user_id = ".$_SESSION['user_id']." ".$sub_qry);
		while ($data = mysql_fetch_object($rs))
		{
			$return[$data->oreference.":".$data->ostst] = array();
			$irs = mysql_query("select * from cart where order_id = ".$data->id);
			while ($idata = mysql_fetch_assoc($irs))
			{
				$return[$data->oreference.":".$data->ostst][] = $idata;
			}
		}
		return $return;
	}
}

function getMyOrdersAdmin()
{
	$sub_qry = "";
	if (!isset($_SESSION['user_id']))
	{
		$_SESSION['red_url'] = "account.php";
		redirect("login.php");
	}
	else
	{
		$return = array();
		if(isset($_POST['txtorderid']) && !empty($_POST['txtorderid']))
		{
			$sub_qry = " and oreference = '".$_POST['txtorderid']."'";
		}
		$rs = mysql_query("select id,oreference,ostst from orders where 1".$sub_qry);
		while ($data = mysql_fetch_object($rs))
		{
			$return[$data->oreference.":".$data->ostst] = array();
			$irs = mysql_query("select * from cart where order_id = ".$data->id);
			while ($idata = mysql_fetch_assoc($irs))
			{
				$return[$data->oreference.":".$data->ostst][] = $idata;
			}
		}
		return $return;
	}
}

function adminaccount()
{
	if(isset($_GET['opr']) && $_GET['opr'] == 'y' && isset($_GET['oid']))
	{
		mysql_query("UPDATE orders SET ostst=1 WHERE oreference='".$_GET['oid']."'");
		redirect("adminaccount.php");
	}
}
function register()
{
	if (isset($_POST['btnRegister']))
	{
		if (!empty($_POST['txtusername']) && !empty($_POST['txtpassword']) && !empty($_POST['txtconpassword']))
		{
			if($_POST['txtpassword'] == $_POST['txtconpassword'])
			{
				mysql_query("INSERT INTO users(username, password) VALUES ('".$_POST['txtusername']."','".$_POST['txtpassword']."')");
				redirect("index.php");
			}
			else
			{
				print "<script>alert('Invalid password!');</script>";
			}
		}
		else
		{
			print "<script>alert('Invalid username/password!');</script>";
		}
	}
}

function logout()
{
	if (isset($_SESSION['user_id']))
	{
		unset($_SESSION['user_id']);
	}
	redirect("index.php");
}

?>