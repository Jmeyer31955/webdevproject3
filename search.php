<?php
	$artistName = isset($_GET['searchArtist']) ? $_GET['searchArtist'] : "";
?>
<html>
<header>

</header>
<body>
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
	<div style="margin-left: 25%;">
		<h1>Music store of incomprehensible wonder</h1>
			<h2>The theoretical place for all things related to music and big words</h2>
	</div>
		<div style="margin-left: 80%;">
			<h4>Search by artist:</h4>
			<form action="search.php">
			<select name="searchArtist">
				<option value="Eminem">Eminem</option>
				<option value="Deadmau5">Deadmau5</option>
			</select>
			<input type="submit" action="submit"></input>
			</form>
			<?php
				if(isset($_POST['formSubmit'])){
					$varArtist = $_POST['searchArtist'];
					$errorMessage = "";
					
					if(!isset($_POST['searchArtist'])){
						$errorMessage .="<div>You didn't select an artist yet!</div>";
					}
				}
			?>
		</div>
		<div>
	<?php
		echo "<h3>All our available music for: {$artistName} </h3>";
		
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
	
	if($artist != $artistName){
		echo "<div style = 'margin: 10px; display: none;'>";
	} else {
	echo "<div style = 'margin: 10px;'>";
	}
	
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