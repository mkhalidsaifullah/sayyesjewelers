<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}

	if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
	}else{
		header('location: products.php');
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
			$sql = "UPDATE products SET name='$prodname', description='$description', catid='$category', price='$price', thumb='$location$name' WHERE id = $id";
			$res = mysqli_query($connection, $sql);
			if($res){
				move_uploaded_file($tmp_name, $location.$name);
				$smsg = "Prouduct Updated Successfully";
				header('location: products.php');
			} else {
				$fmsg = "Failed to update Product";
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
			<?php 	
				$sql = "SELECT * FROM products WHERE id=$id";
				$res = mysqli_query($connection, $sql); 
				$r = mysqli_fetch_assoc($res); 
			?>
			<form method="post" enctype="multipart/form-data">
			  <div class="form-group">
			  <input type="hidden" name="filepath" value="<?php echo $r['thumb']; ?>">
			    <label for="Productname">Product Name</label>
			    <input name="productname" type="text" required class="form-control" id="Productname" placeholder="Product Name" value="<?php echo $r['name']; ?>">
			  </div>
			  <div class="form-group">
			    <label for="productdescription">Product Description</label>
			    <textarea name="productdescription" rows="3" required class="form-control"><?php echo $r['description']; ?></textarea>
			  </div>

			  <div class="form-group">
			    <label for="productcategory">Product Category</label>
			    <select name="productcategory" required class="form-control" id="productcategory">
			    <?php 	
					$catsql = "SELECT * FROM category";
					$catres = mysqli_query($connection, $catsql); 
					while ($catr = mysqli_fetch_assoc($catres)) {
				?>
					<option value="<?php echo $catr['id']; ?>" <?php if( $catr['id'] == $r['catid']){ echo "selected"; } ?>><?php echo $catr['name']; ?></option>
				<?php } ?>
				</select>
			  </div>
			  

			  <div class="form-group">
			    <label for="productprice">Product Price</label>
			    <input name="productprice" type="text" required class="form-control" id="productprice" placeholder="Product Price" value="<?php echo $r['price']; ?>">
			  </div>
			  <div class="form-group">
			    <label for="productimage">Product Image</label>
			    <br>
			    	<img src="<?php echo $r['thumb'] ?>" widht="100px" height="100px">
			    <br>
			    <input name="productimage" type="file" required="required" id="productimage">
			    <p class="help-block">Only jpg/png are allowed.</p>
			    
			  </div>
			  
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
