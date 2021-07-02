<?php
	ob_start();
	session_start();
	require_once 'config/connect.php';
	if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}
include 'inc/header.php'; 
include 'inc/nav.php'; 

$uid = $_SESSION['customerid'];
$cart = $_SESSION['cart'];


if(isset($_POST) & !empty($_POST)){
	if(isset($_POST['agree'])){

		$total = 0;
		foreach ($cart as $key => $value) {

			$ordsql = "SELECT * FROM products WHERE id=$key";
			$ordres = mysqli_query($connection, $ordsql);
			$ordr = mysqli_fetch_assoc($ordres);

			$total = $total + ($ordr['price']*$value['quantity']);
		}

		$iosql = "INSERT INTO orders (uid, totalprice, orderstatus) VALUES ('$uid', '$total', 'Order Placed')";
		$iores = mysqli_query($connection, $iosql);
		if($iores){
			$orderid = mysqli_insert_id($connection);
			foreach ($cart as $key => $value) {
				$ordsql = "SELECT * FROM products WHERE id=$key";
				$ordres = mysqli_query($connection, $ordsql);
				$ordr = mysqli_fetch_assoc($ordres);

				$pid = $ordr['id'];
				$productprice = $ordr['price'];
				$quantity = $value['quantity'];


				$orditmsql = "INSERT INTO orderitems (pid, orderid, productprice, pquantity) VALUES ('$pid', '$orderid', '$productprice', '$quantity')";
				$orditmres = mysqli_query($connection, $orditmsql);
			}
		}
		unset($_SESSION['cart']);
		header("location: my-account.php");
	}
} 

?>

	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
					<div class="page_header text-center">
						<h2>Checkout</h2>
						<p>Confirm Order</p>
					</div>
<form method="post">
	<section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

<table class="cart-table table table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
					//print_r($cart);
				$total = 0;
					foreach ($cart as $key => $value) {
						//echo $key . " : " . $value['quantity'] ."<br>";
						$cartsql = "SELECT * FROM products WHERE id=$key";
						$cartres = mysqli_query($connection, $cartsql);
						$cartr = mysqli_fetch_assoc($cartres);

					
				 ?>
					<tr>
						<td>
							<a href="#"><img src="admin/<?php echo $cartr['thumb']; ?>" alt="" height="90" width="90"></a>					
						</td>
						<td>
							<a href="single.php?id=<?php echo $cartr['id']; ?>"><?php echo $cartr['name']; ?></a>					
						</td>
						<td>
							<span class="amount">Rs:<?php echo $cartr['price']; ?>.00/-</span>					
						</td>
						<td>
							<div class="quantity"><?php echo $value['quantity']; ?></div>
						</td>
						<td>
							<span class="amount">Rs:<?php echo ($cartr['price']*$value['quantity']); ?>.00/-</span>					
						</td>
					</tr>
				<?php 
					$total = $total + ($cartr['price']*$value['quantity']);
				} ?>
				</tbody>
			</table>		
					
				<div class="space30"></div>
			<div class="ma-address">
						<h3>Shipping Details</h3>
						<p>The following addresses will be used for order delivery.</p>

			<div class="row">
				<div class="col-md-6">
					<?php
						$csql = "SELECT * FROM users WHERE id=$uid";
						$cres = mysqli_query($connection, $csql);
					
						if(mysqli_num_rows($cres) == 1){
							$cr = mysqli_fetch_assoc($cres);
							echo "<p>Name: <strong>".$cr['name'] ."</strong></p>";
							echo "<p>Address: ".$cr['address'] ."</p>";
							echo "<p>Contact: ".$cr['contact'] ."</p>";
							echo "<p>Email: ".$cr['email'] ."</p>";
						}
					?>
				</div>

				<div class="col-md-6">

				</div>
			</div>
		</div>				
				
				<input type="submit" name="agree" class="button btn-lg" value="Confirm Order">		

				  </div>
				</div>
			</div>
		</div>
	</section>
</form>		
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
