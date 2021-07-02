<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}

	if(isset($_POST) & !empty($_POST)){
		$prodname = $_POST['productname'];
		$description = $_POST['productdescription'];
		$category = $_POST['productcategory'];
		$price = $_POST['productprice'];

		$name = $_FILES['productimage']['name'];
		$size = $_FILES['productimage']['size'];
		$tmp_name = $_FILES['productimage']['tmp_name'];

		$max_size = 10000000;

		if($size <= $max_size){
			$location = "uploads/";
			$sql = "INSERT INTO products (name, description, catid, price, thumb) VALUES ('$prodname', '$description', '$category', '$price', '$location$name')";
			$res = mysqli_query($connection, $sql);
			if($res){
				move_uploaded_file($tmp_name, $location.$name);
				$smsg = "Prouduct Added Successfully";
				header('location: products.php');
			} else {
				$fmsg = "Failed to Create Product";
			}
		}
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
	
<section id="content">
	<div class="content-blog">
		<div class="container">
		<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<form method="post" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="Productname">Product Name</label>
			    <input name="productname" type="text" required class="form-control" id="Productname" placeholder="Product Name">
			  </div>
			  <div class="form-group">
			    <label for="productdescription">Product Description</label>
			    <textarea name="productdescription" rows="3" required class="form-control"></textarea>
			  </div>

			  <div class="form-group">
			    <label for="productcategory">Product Category</label>
			    <select class="form-control" id="productcategory" name="productcategory">
				  <option value="">---SELECT CATEGORY---</option>
				  <?php 	
					$sql = "SELECT * FROM category";
					$res = mysqli_query($connection, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
				?>
					<option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
				<?php } ?>
				</select>
			  </div>
			  

			  <div class="form-group">
			    <label for="productprice">Product Price</label>
			    <input name="productprice" type="text" required class="form-control" id="productprice" placeholder="Product Price">
			  </div>
			  <div class="form-group">
			    <label for="productimage">Product Image</label>
			    <input name="productimage" type="file" required id="productimage">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
