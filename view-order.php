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
if(!empty($_SESSION['cart']) && array_key_exists('cart',$_SESSION)) {
	$cart = $_SESSION['cart']; 
	}else{
	$cart = array();
}
?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Order Detail</h2>
					</div>
					<div class="col-md-12">

			<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th></th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>

				<?php

					if(isset($_GET['id']) & !empty($_GET['id'])){
						$oid = $_GET['id'];
					}else{
						header('location: my-account.php');
					}
					$ordsql = "SELECT * FROM orders WHERE uid='$uid' AND id='$oid'";
					$ordres = mysqli_query($connection, $ordsql);
					$ordr = mysqli_fetch_assoc($ordres);

					$orditmsql = "SELECT * FROM orderitems INNER JOIN products ON orderitems.orderid='$oid' AND orderitems.pid=products.id";
					$orditmres = mysqli_query($connection, $orditmsql);
					while($orditmr = mysqli_fetch_assoc($orditmres)){
				?>
					<tr>
						<td>
							<a href="single.php?id=<?php echo $orditmr['pid']; ?>"><?php echo $orditmr['name']; ?></a>
						</td>
						<td>
							<?php echo $orditmr['pquantity']; ?>
						</td>
						<td>
							Rs: <?php echo $orditmr['productprice']; ?>/-
						</td>
						<td>
							
						</td>
						<td>
							Rs: <?php echo $orditmr['productprice']*$orditmr['pquantity']; ?>/-
						</td>
					</tr>
				<?php } ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Total
						</td>
						<td>
							<?php echo $ordr['totalprice']; ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Status
						</td>
						<td>
							<?php echo $ordr['orderstatus']; ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Placed On
						</td>
						<td>
							<?php echo $ordr['timestamp']; ?>
						</td>
					</tr>
				</tbody>
			</table>		

					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
