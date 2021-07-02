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


if(isset($_POST) & !empty($_POST)){
	$id = $_POST['orderid'];

	$ordupd = "UPDATE orders SET orderstatus='Cancelled' WHERE id=$id";
	if(mysqli_query($connection, $ordupd)){
		header('location: my-account.php');
	}
}


$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($connection, $sql);
$r = mysqli_fetch_assoc($res);
?>

	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
					<div class="page_header text-center">
						<h2>Shop - Cancel Order</h2>
						<p>Do you want to cancel Order?</p>
					</div>
<form method="post">
<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="billing-details">
						<h3 class="uppercase">Cancel Order</h3>

				<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Order</th>
						<th>Date</th>
						<th>Status</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>

				<?php
					if(isset($_GET['id']) & !empty($_GET['id'])){
						$oid = $_GET['id'];
					}else{
						header('location: my-account.php');
					}
					$i=0;
					$ordsql = "SELECT * FROM orders WHERE id='$oid'";
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
					</tr>
				<?php } ?>
				</tbody>
			</table>	

						<div class="space30"></div>


							<div class="clearfix space20"></div>

					<input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">		 
						<div class="space30"></div>
					<input type="submit" class="button btn-lg" value="Cancel Order">
					</div>
				</div>
				
			</div>
		
		</div>		
</form>		
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
