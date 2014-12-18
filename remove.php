<?php

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 

$cookie = $_COOKIE['cart_items_cookie'];
$cookie = stripslashes($cookie);
$saved_cart_items = json_decode($cookie, true);
 

$saved_cart_items = array_diff($saved_cart_items, array($id=>$name));
 

setcookie("cart_items_cookie", "", time()-3600);
 

$json = json_encode($saved_cart_items, true);
setcookie('cart_items_cookie', $json);
 

header('Location: cart.php?action=removed&id=' . $id . '&name=' . $name);
 
?>