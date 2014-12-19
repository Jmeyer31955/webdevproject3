<html>
<head>
<meta name="robots" content="noindex">
</head>
<body>
<div style: "float: left;">
			<a href="cart.php">
                        <?php
                        $cookie = $_COOKIE['cart_items_cookie'];
                        $cookie = stripslashes($cookie);
                        $saved_cart_items = json_decode($cookie, true);
                        $cart_count=count($saved_cart_items);
                        ?>
                        Items in cart:  <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
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
					
					echo "<div> You chose: {$varArtist} </div>";
					if(!isset($_POST['searchArtist'])){
						$errorMessage .="<div>You didn't select an artist yet!</div>";
					}
				}
			?>
		</div>
		<div>
		<h3>All our available music for all artists: </h3>
		<?php
		
		$con = mysqli_connect("localhost","storeuser","123","musicstore");

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT * FROM musicstore.musiclist ORDER BY id");

echo "<table>";
echo "<tbody>";
echo "<tr>";
	echo"<th> Artist </th>";
	echo"<th> Album Name</th>";
	echo"<th> Format </th>";
	echo"<th> Price </th>";
	echo"<th> Quantity </th>";
	echo"<th> Add to cart </th>";
echo "</tr>";
while($row = mysqli_fetch_array($result)) {
	$listId = $row['id'];
	$artist = $row['artist'];
	$album = $row['album'];
	$format = $row['format'];
	$price = $row['price'];
	
	echo "<tr style = 'margin: 10px'>";
	echo "<td>" . $row['artist'] . "</td>";
	echo "<td><div class='id' style='display:none;'>" . $row['id'] . "</div>" . "<div class='album'>" . $row['album'] . "</div></td>";
	echo "<td>" . $row['format'] . "</td>";
	echo "<td>" . " $" . $row['price'] . "</td>";
	echo "<td><input type ='text' name='quantity' value='1' style='width: 50px;'></input></td>";
	echo"<td>";
		echo"<button class='cart'>";
			echo "Add to cart";
		echo "</button>";
	echo"</td>";
	echo "<br>";
	echo "</tr>";
}

				mysqli_close($con);
echo "</tbody>";
echo "</table>";
		?>
		</div>
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
		window.location.href = "quantity.php?id=" + id + "&album=" + album + "&quantity=" + quantity;
	});
});
</script>
</body>
</html>