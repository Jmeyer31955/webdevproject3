<?php

	$host = "localhost";
	$name = "musicstore";
	$username = "storeuser";
	$password = "123";
	
	try {
		$con = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
	}
	
	catch(PDOException $exception){
		echo "Connection error: " . $exception->getMessage();
	}
	
$page_title="Cart";

$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset ($_GET['name']) ? $_GET['name'] : "";

if($action=='removed'){
	echo "<div>";
	echo "<strong>{$name}</strong> was removed from your cart!";
	echo "</div>";
}

$cookie = $_COOKIE['cart_items_cookie'];
$cookie = stripslashes($cookie);
$saved_cart_items = json_decode($cookie, true);

if(count($saved_cart_items)>0){
	$ids = "";
	foreach($saved_cart_items as $id=>$name){
		$ids = $ids . $id . ",";
	}

	$ids = rtrim($ids, ',');
	
    echo "<table>";
 

        echo "<tr>";
            echo "<th>Album Name</th>";
            echo "<th>Price</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        $query = "SELECT id, album, price FROM musicstore.musiclist WHERE id IN ({$ids}) ORDER BY id";
        $stmt = $con->prepare( $query );
        $stmt->execute();
 
        $total_price=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
 
            echo "<tr>";
                echo "<td>{$album}</td>";
                echo "<td>&#36;{$price}</td>";
                echo "<td>";
                    echo "<a href='remove.php?id={$id}&name={$album}'>";
                        echo "Remove from cart";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
            $total_price+=$price;
        }
 
        echo "<tr>";
                echo "<td><b>Total</b></td>";
                echo "<td>&#36;{$total_price}</td>";
                echo "<td>";
                    echo "<a href='#'>";
                        echo "Confirm and Pay";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
    echo "</table>";
}
 
else{
    echo "<div>";
        echo "<strong>No albums found</strong> in your cart!";
    echo "</div>";
}

?>