<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Dashboard</h2>
						<!-- <p>You can order products from here</p> -->
					</div>
					<div class="col-md-12">
						<div class="row">
							<h1>Welcome</h1>
							<?php
								$email = $_SESSION['email'];
								$esql = "SELECT * FROM admin WHERE email = '$email'";
								$rsql = mysqli_query($connection, $esql);
								$r = mysqli_fetch_assoc($rsql);
							?>
							<h1><?php echo $r['name']; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>
