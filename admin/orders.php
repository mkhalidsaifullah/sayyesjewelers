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
						<th>Total Price</th>
						<th>Order Status</th>
						<th>Order Date</th>
						<th>View Order</th>
						<th>Process Order</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
					$i=0;
					$sql = "SELECT orders.id, orders.totalprice, orders.orderstatus, orders.timestamp, users.name FROM orders JOIN users WHERE orders.uid=users.id ORDER BY orders.id DESC";
					$res = mysqli_query($connection, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
						$i++;
				?>
					<tr>
						<th scope="row"><?php echo $i; ?></th>
						<td><?php echo $r['name']; ?></td>
						<td><?php echo $r['totalprice']; ?></td>
						<td><?php echo $r['orderstatus']; ?></td>
						<td><?php echo $r['timestamp']; ?></td>
						<td><a href="vieworder.php?id=<?php echo $r['id']; ?>">View Order</a></td>
						<td>
						<?php
							if(($r['orderstatus']) != 'Cancelled') {
								echo "<a href='orderprocess.php?id=".$r['id']."'>Process Order</a>";
							} else {
								echo 'Cancelled';
							}
						?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
