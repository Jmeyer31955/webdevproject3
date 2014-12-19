<?php
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
	$name = isset($_GET['name']) ? $_GET['name'] : "";
	$quantityOrig = isset($_GET['quantityOrig']) ? $_GET['quantityOrig'] : "";
	$idTwo = $id;
	

	
	setcookie($id, $quantity);
	
	header('Location: cart.php?action=added&id=' . $id);
?>