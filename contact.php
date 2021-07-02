<?php 
	ob_start();
	session_start();
	require_once 'config/connect.php';

include 'inc/header.php'; 
include 'inc/nav.php'; 


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
						<h2>Contact Us</h2>
					</div>
					<form class="col-md-6 col-md-offset-3" method="POST" action="messageprocess.php">
						<div class="form-group">
							<label for="name">Name *</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
						</div>
						<div class="form-group">
							<label for="email">Email address *</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="contact">Contact Number *</label>
							<input type="number" class="form-control" name="contact" id="contact" placeholder="Contact number"
								min="0" required>
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<textarea class="form-control" name="message" id="message" rows="3"
								maxlength="200" required></textarea>
						</div>

						<button type="submit" class="btn btn-default" id="searchbtn">Send Message</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
