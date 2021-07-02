<?php 
session_start();
require_once 'config/connect.php';
include 'inc/header.php'; 
include 'inc/nav.php'; 
if(isset($_SESSION['cart']))
$cart = $_SESSION['cart'];
?>

	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Shop Cart</h2>
					</div>
					<div class="col-md-12">

<table class="cart-table table table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
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
							<a class="remove" href="delcart.php?id=<?php echo $key; ?>"><i class="fa fa-times"></i></a>
						</td>
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
					<tr>
						<td colspan="6" class="actions">
							<div class="col-md-6">
							<!--	<div class="coupon">
									<label>Coupon:</label><br>
									<input placeholder="Coupon code" type="text"> <button type="submit">Apply</button>
								</div> -->
							</div>
							<div class="col-md-6">
								<div class="cart-btn">
									<a href="checkout.php" class="button btn-md" >Checkout</a>
									<!--<input type="submit" name="checkout" class="button btn-lg" value="Checkout">-->
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>		

			<div class="cart_totals">
				<div class="col-md-6 push-md-6 no-padding">
					<h4 class="heading">Cart Totals</h4>
					<table class="table table-bordered col-md-6">
						<tbody>
							<tr>
								<th>Order Total</th>
								<td><strong><span class="amount">Rs: <?php echo $total; ?>.00/-</span></strong> </td>
							</tr>
						</tbody>
					</table>
					<p><strong style="color: #FF0004">Payment mood: Cash on delivery.</strong></p>
				</div>
			</div>			
							
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>
