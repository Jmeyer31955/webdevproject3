<?php
$cart=array();
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$album = isset($_GET['album']) ? $_GET['album'] : "";
	$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
	
	$quant[$id]=$quantity;
	
	$cookieQuant = $_COOKIE['cart_quant_cookie'];
	$cookieQuant = stripslashes($cookieQuant);
	$saved_quant = json_decode($cookieQuant, true);
	
	if(!$saved_quant){
		$saved_quant=array();
	}
	
	if(array_key_exists($id, $saved_quant)){
		header('Location: index.php?action=exists&id' . $id . '&name=' . $album . '&quantity=' . $quantity);
	}
	
	else{
		if(count($saved_quant)>0){
			foreach($saved_quant as $key=>$value){
				$quant[$key]=$value;
			}
		}
		
		$json = json_encode($quant, true);
		setcookie( 'cart_quant_cookie', $json);
		
		header('Location: cart.php?action=added&id=' . $id . '&name=' . $album . '&quantity='. $quantity);
	}		
?>