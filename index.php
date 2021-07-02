<?php 
session_start();
require_once 'config/connect.php';
include_once 'inc/header.php';
include_once 'inc/nav.php';
?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container row">
				<div class="col-md-12" id="jewellerybanner">
					<div id="carousel-jewellery" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-jewellery" data-slide-to="0"
								class="active"></li>
							<li data-target="#carousel-jewellery" data-slide-to="1"></li>
							<li data-target="#carousel-jewellery" data-slide-to="2"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="images/single.jpg" alt="...">
								<div class="carousel-caption">
									<!-- description -->

								</div>
							</div>

							<div class="item">
								<img src="images/single1.jpg" alt="...">
								<div class="carousel-caption">
									<!-- description -->

								</div>
							</div>

							<div class="item">
								<img src="images/single3.jpg" alt="...">
								<div class="carousel-caption">
									<!-- description -->

								</div>
							</div>

	                        <div class="item">
								<img src="images/single3.jpg" alt="...">
								<div class="carousel-caption">
									<!-- description -->

								</div>
							</div>
							
						</div>

						<!-- Controls -->
						<!-- <a class="left carousel-control" href="#carousel-jewellery" role="button"
							data-slide="prev">
							<span class="fa fa-angle-double-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-jewellery" role="button"
							data-slide="next">
							<span class="fa fa-angle-double-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a> -->
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
					<h2>SAY YES! JEWELERS</h2>
                    <p>You can order products from here</p>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div id="shop-mason" class="shop-mason-4col">							
							<?php 
								$sql = "SELECT * FROM products";
								if(isset($_GET['id']) & !empty($_GET['id'])){
									$id = $_GET['id'];
									$sql .= " WHERE catid=$id";
								}
								elseif(isset($_GET['search']) & !empty($_GET['search'])){
									$search = $_GET['search'];
									$sql .= " WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
								}
								

								$res = mysqli_query($connection, $sql);
								while($r = mysqli_fetch_assoc($res)){
							?>
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="admin/<?php echo $r['thumb']; ?>" class="img-responsive" width="250px" alt="">
											<div class="product-overlay">
												<span>
												<a href="single.php?id=<?php echo $r['id']; ?>" class="fa fa-link"></a>
												<a href="addtocart.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
										</div>
										<h2 class="product-title"><a href="single.php?id=<?php echo $r['id']; ?>"><?php echo $r['name']; ?></a></h2>
										<div class="product-price">Rs: <?php echo $r['price']; ?>.00/-<span></span></div>
									</div>
								</div>
							<?php } ?>

								
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'inc/footer.php' ?>
