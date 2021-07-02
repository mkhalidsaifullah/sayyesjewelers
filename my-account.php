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
						<h2>My Account</h2>
					</div>
					<div class="col-md-12">

			<h3>Recent Orders</h3>
			<br>
			<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Order</th>
						<th>Date</th>
						<th>Status</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				<?php
					$i=0; 
					$ordsql = "SELECT * FROM orders WHERE uid='$uid'";
					$ordres = mysqli_query($connection, $ordsql);
					while($ordr = mysqli_fetch_assoc($ordres)){
						$i++;
				?>
					<tr>
						<td>
							<?php echo $i; ?>
						</td>
						<td>
							<?php echo $ordr['timestamp']; ?>
						</td>
						<td>
							<?php echo $ordr['orderstatus']; ?>			
						</td>
						<td>
							Rs: <?php echo $ordr['totalprice']; ?>/-
						</td>
						<td>
							<a href="view-order.php?id=<?php echo $ordr['id']; ?>">View</a>
							<?php if($ordr['orderstatus'] == 'Order Placed'){?>
							| <a href="cancel-order.php?id=<?php echo $ordr['id']; ?>">Cancel</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>		
					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
