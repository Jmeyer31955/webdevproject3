<html>
<head>
<meta name="robots" content="noindex">
</head>
</html>
<?php

	$host = "localhost";
	$name = "musicstore";
	$username = "storeuser";
	$password = "123";
	
	$one = "1";
	$two = "2";
	$three = "3";
	$four = "";
	$five = "";
	$six = "";
	$ship = isset($_GET['shipping']) ? $_GET['shipping'] : "";
	
	if(!isset($_GET['shipping'])){
						$ship = "0.00";
					}
	
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

$quant = $_COOKIE['cart_quant_cookie'];
$quant = stripslashes($quant);
$saved_quant = json_decode($quant, true);

if(count($saved_cart_items)>0){
	$ids = "";
	$quantIds = "";
	$quantQ = "";
	foreach($saved_cart_items as $id=>$name){
		$ids = $ids . $id . ",";

		}

	foreach($saved_quant as $id=>$name){
		$quantIds = $id;
		$quantQ = $name;
		
			if($quantIds == $one){
				$four = $quantQ;
			} elseif($quantIds == $two){
				$five = $quantQ; } elseif($quantIds == $three){
				$six = $quantQ;	} else {
				echo "<div>Fatal Error: Missing ID number, contact webmaster meyer31955@gotoltc.edu</div>";
				}
			}
	$ids = rtrim($ids, ',');
	$quantIds = rtrim($quantIds, ',');
	$quantQ = rtrim($quantQ, ',');
	
	echo"<a href='index.php'>Back to main page</a>";
    echo "<table>";
 

        echo "<tr>";
            echo "<th>Album Name</th>";
            echo "<th>Price</th>";
			echo "<th>Quantity</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        $query = "SELECT id, album, price FROM musicstore.musiclist WHERE id IN ({$ids}) ORDER BY id";
        $stmt = $con->prepare( $query );
        $stmt->execute();
 
        $total_price=0;
		$total_price_ship=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
			
			if($id == $one){
				$quantity = $four;
			} elseif($id == $two){
				$quantity = $five; } elseif($id == $three){
				$quantity = $six;	} else {
				echo "<div>FATAL ERROR: Missing ID number, contact webmaster meyer31955@gotoltc.edu</div>";
				}
 
            echo "<tr>";
				echo "<div style='display:none;'>{$quantity}</div>";
                echo "<td><div class='id' style='display:none;'>" . $row['id'] . "</div>" . "<div class='album'>" . $row['album'] . "</div></td>";
                echo "<td>&#36;{$price}</td>";
				echo "<td><input type= 'text' style='width: 50px;' value={$quantity}></input></td>";
                echo"<td>";
					echo "<button class='quantity'>";
						echo "Change Quantity";
					echo "</button>";
				echo"</td>";
				echo "<td>";
                    echo "<a href='remove.php?id={$id}&name={$album}&quantity={$quantity}&idtwo={$id}'>";
                        echo "Remove from cart";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
            $total_price+=$price*$quantity;
			$total_price_ship+=$total_price+$ship;
        }
 
        echo "<tr>";
                echo "<td><b>Total price(without shipping):</b></td>";
                echo "<td>&#36;{$total_price}</td>";
		echo"</tr>";
		echo"<tr><td>-------------------------------------</td></tr>";
		echo"<tr><td><b>Shipping price: </b></td><td>&#36;{$ship}</td></tr>";
		echo"<tr><td><b>Total price(shipping included):</b></td><td>&#36;{$total_price_ship}</td></tr>";
                echo "<tr>";
				echo"<td><h4>Select a shipping method: </h4>";
				echo"<form action='cart.php'>";
				echo"	<select name='shipping'>";
				echo"		<option value='0.00'>None Chosen($0.00)</option>";
				echo"		<option value='5.00'>Ground($5.00)</option>";
				echo"		<option value='15.00'>Overnight Air($15.00)</option>";
				echo"		<option value='9001.99'>Teleportation($9001.99)</option>";
				echo"	</select>";
				echo"	<input type='submit' action='submit'></input>";
				echo"</form>";

				if(isset($_POST['formSubmit'])){
					$shipping = $_POST['shipping'];
					$errorMessage = "";
					
					echo "<div> You chose: {$shipping} </div>";
					if(!isset($_POST['shipping'])){
						$errorMessage .="<div>You didn't select a method of shipping yet!</div>";
					}
				}
                echo "</td>";
            echo "</tr>";
 
    echo "</table>";
}
 
else{
    echo "<div>";
		echo"<a href='index.php'>Back to main page</a>";
		echo"<br><br>";
        echo "<strong>No albums found</strong> in your cart!";
    echo "</div>";
}
?>
<html>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>		
$(document).ready(function(){
	$('.cart').click(function(){
		var id = $(this).closest('tr').find('.id').text();
		var album = $(this).closest('tr').find('.album').text();
		var quantity = $(this).closest('tr').find('input').val();
		window.location.href = "addalbum.php?id=" + id + "&album=" + album + "&quantity=" + quantity;
	});
	
	$('.quantity').click(function(){
		var id = $(this).closest('tr').find('.id').text();
		var album = $(this).closest('tr').find('.album').text();
		var quantity = $(this).closest('tr').find('input').val();
		var quantityOrig = $(this).closest('div').find('.quantity').text();
		window.location.href = "newquant.php?id=" + id + "&album=" + album + "&quantity=" + quantity + "&quantityOrig=" + quantityOrig + "&idtwo=" + id;
	});
});
</script>
</body>
</html>