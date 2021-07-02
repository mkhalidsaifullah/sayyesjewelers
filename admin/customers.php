<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
	
<section id="content">
	<div class="content-blog">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Customer Name</th>
						<th>Customer Mobile</th>
						<th>Customer Email</th>
						<th>Customer Address</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
					$i=0;
					$sql = "SELECT * FROM users";
					$res = mysqli_query($connection, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
						$i++;
				?>
					<tr>
						<th scope="row"><?php echo $i; ?></th>
						<td><?php echo $r['name']; ?></td>
						<td><?php echo $r['contact']; ?></td>
						<td><?php echo $r['email']; ?></td>
						<td><?php echo $r['address']; ?></td>
				<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
