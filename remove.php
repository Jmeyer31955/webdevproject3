<?php

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
$idtwo = isset($_GET['idtwo']) ? $_GET['idtwo'] : "";
 

$cookie = $_COOKIE['cart_items_cookie'];
$cookie = stripslashes($cookie);
$saved_cart_items = json_decode($cookie, true);

$saved_cart_items = array_diff($saved_cart_items, array($id=>$name));
$debug = $saved_quant[1];


setcookie("cart_items_cookie", "", time()-3600);

setcookie($id, "", time()-3600);


$json = json_encode($saved_cart_items, true);
setcookie('cart_items_cookie', $json);


 

header('Location: cart.php?action=removed&id=' . $id . '&name=' . $name . '&quantity=' . $quantity . '&saved_quant=' . $debug);
 
?>