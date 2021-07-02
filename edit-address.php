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
	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];

	$usql = "UPDATE users SET name='$name', address='$address', contact='$contact' WHERE id=$uid";
	$ures = mysqli_query($connection, $usql);
	if($ures){
		header('location: index.php');
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
			<h2>Update Account Information</h2>
			<p>Change Address or Contact Information </p>
		</div>
	<form method="post">
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="billing-details">
						<h3 class="uppercase">Update My Account Information</h3>

						<div class="space30"></div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
									  <label>Name</label>
										<input name="name" type="text" required="required" class="form-control" value="<?php echo $r['name']; ?>">
									</div>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Address</label>
										<textarea name="address" required class="form-control" value=""><?php echo $r['address']; ?></textarea>
									</div>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Contact</label>
										<input name="contact" type="number" required="required" class="form-control" value="<?php echo $r['contact']; ?>">
									</div>
								</div>
							</div>
							<div class="space30"></div>
					<input type="submit" class="button btn-lg" value="Update Address">
					</div>
				</div>
				
			</div>
		
		</div>		
	</form>		
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
