<?php
	$cart=array();
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
	$name = isset($_GET['name']) ? $_GET['name'] : "";
	$quantityOrig = isset($_GET['quantityOrig']) ? $_GET['quantityOrig'] : "";
	$idTwo = $id;
	
	$quant = $_COOKIE['cart_quant_cookie'];
	$quant = stripslashes($quanti);
	$saved_quant = json_decode($quanti, true);
	
	$saved_quant = array_diff($saved_quant, array($id=>$quantityOrig));
	
	setcookie("cart_quant_cookie", "", time()-3600);
	
	$json = json_encode($saved_quant, true);
	
	setcookie('cart_quant_cookie', $json);
	
	header('Location: revise.php?action=removed&id=' . $idTwo . '&name=' . $name . '&quantity=' . $quantity);
?>