<?php

	$cookieName = "1";
	$cookieNameTwo = "2";
	$cookieNameThree = "3";

?>
<html>
<header>

</header>
<body>
	<div style="margin-left: 35%;">
		<div style: "float: left;">
			<a href="cart.php">
                        <?php
                        // count products in cart
                        $cookie = $_COOKIE['cart_items_cookie'];
                        $cookie = stripslashes($cookie);
                        $saved_cart_items = json_decode($cookie, true);
                        $cart_count=count($saved_cart_items);
                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
            </a>
		</div>
		<h1>Music store of Invisibility</h1>
			<h2>The theoretical place for all things music</h2>
	</div>
		<div style="margin-left: 80%;">
			SEARCH BOX GO HERE
		</div>
		<div>
		<h3>All our available music: </h3>
		<?php
		
		$con = mysqli_connect("localhost","storeuser","123","musicstore");

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT * FROM musicstore.musiclist ORDER BY id");


while($row = mysqli_fetch_array($result)) {
	$listId = $row['id'];
	$artist = $row['artist'];
	$album = $row['album'];
	$format = $row['format'];
	$price = $row['price'];
	
	echo "<div style = 'margin: 10px'>";
	echo "<form  action= ''>
				<input type = 'hidden' name = 'listId' value = '$listId'>
					<input type = 'hidden' name = 'artist' value = '$artist'>
						<input type = 'hidden' name = 'album' value = '$album'>
							<input type = 'hidden' name = 'format' value = '$format'>
								<input type = 'hidden' name = 'price' value = '$price'>
									</form>";
	echo " Artist: " . "<b>" . $row['artist'] . "</b>";
	echo " " . "Title: " . "(" . $row['album'] . ")";
	echo " " . "Format: " . "(" . "<i>" . $row['format'] . "</i>" . ")";
	echo " " . "Price: " . " $" . $row['price'];
	echo"<p>";
		echo"<a href='addalbum.php?id={$listId}&album={$album}' class=''>";
			echo "Add this album to your cart";
		echo "</a>";
	echo"</p>";
	echo "<br>";
	echo "</div>";
}

				mysqli_close($con);
				
		?>
		</div>	
</body>
</html>