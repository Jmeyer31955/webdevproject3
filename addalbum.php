<?php
	$cart=array();
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$album = isset($_GET['album']) ? $_GET['album'] : "";
	$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
	
	$cart[$id]=$album;
	$quant[$id]=$quantity;
	
	$cookie = $_COOKIE['cart_items_cookie'];
	$cookie = stripslashes($cookie);
	$saved_cart_items = json_decode($cookie, true);
	
	$cookieQuant = $_COOKIE['cart_quant_cookie'];
	$cookieQuant = stripslashes($cookieQuant);
	$saved_quant = json_decode($cookieQuant, true);
	
	if(!$saved_cart_items){
		$saved_cart_items=array();
	}
	
	if(array_key_exists($id, $saved_cart_items)){
		header('Location: index.php?action=exists&id' . $id . '&name=' . $album . '&quantity=' . $quantity);
	}
	
	else{
		if(count($saved_cart_items)>0){
			foreach($saved_cart_items as $key=>$value){
				$cart[$key]=$value;
			}
		}
		
		$json = json_encode($cart, true);
		setcookie( 'cart_items_cookie', $json);
		
		header('Location: index.php?action=added&id=' . $id . '&name=' . $album . '&quantity='. $quantity);
	}		
	
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
		
		header('Location: index.php?action=added&id=' . $id . '&name=' . $album . '&quantity='. $quantity);
	}		
?>