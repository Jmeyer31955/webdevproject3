<?php
	$cart=array();
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$album = isset($_GET['album']) ? $_GET['album'] : "";
	
	$cart[$id]=$album;
	
	$cookie = $_COOKIE['cart_items_cookie'];
	$cookie = stripslashes($cookie);
	$saved_cart_items = json_decode($cookie, true);
	
	if(!$saved_cart_items){
		$saved_cart_items=array();
	}
	
	if(array_key_exists($id, $saved_cart_items)){
		header('Location: index.php?action=exists&id' . $id . '&name=' . $album);
	}
	
	else{
		if(count($saved_cart_items)>0){
			foreach($saved_cart_items as $key=>$value){
				$cart[$key]=$value;
			}
		}
		
		$json = json_encode($cart, true);
		setcookie( 'cart_items_cookie', $json);
		
		header('Location: index.php?action=added&id=' . $id . '&name=' . $album);
	}
?>