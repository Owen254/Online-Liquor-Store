<?php 
include './admin.php';
include './conn.php';

$query="SELECT * FROM Category";
$result=mysqli_query($con,$query);
$sqll="SELECT * FROM distributor";
$resultt=mysqli_query($con,$sqll);
$update=false;


$id="";
 $name="";
 $cat="";
 $dist="";
 $quantity="";
 $price="";
 $percentage="";
 $measure="";
 $photo="";



if (isset($_POST['add'])) {
 $name=$_POST['name'];
 $cat=$_POST['cat'];
 $dist=$_POST['dist'];
 $quantity=$_POST['quantity'];
 $price=$_POST['price'];
 $percentage=$_POST['percentage'];
 $measure=$_POST['measure'];

 $photo=$_FILES['image']['name'];
 $upload="uploads/".$photo;

 $queryy="INSERT INTO product(name,category,distributor,quantity,price,percentage,measurement,photo)VALUES(?,?,?,?,?,?,?,?)";
 $stmt=$con->prepare($queryy);
 $stmt->bind_param("sssiisss",$name,$cat,$dist,$quantity,$price,$percentage,$measure,$upload);
 $stmt->execute();
 move_uploaded_file($_FILES['image']['tmp_name'], $upload);
 $_SESSION['response']="Updated Successfully";
		$_SESSION['res_type']="primary";
		header('location:product.php');
}
if (isset($_GET['delete'])) {
		$id=$_GET['delete'];
		$sql="SELECT photo FROM product WHERE id=?";
		$stmt2=$con->prepare($sql);
		$stmt2->bind_param("i",$id);
		$stmt2->execute();
        $result2=$stmt2->get_result();
        $row=$result2->fetch_assoc();


        $imagepath=$row['photo'];
        unlink($imagepath);

		$query="DELETE FROm product WHERE id=?";
		$stmt=$con->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
	}
	if (isset($_GET['edit'])) {
		$id=$_GET['edit'];
        $query="SELECT * FROM product WHERE id=?";
         $stmt=$con->prepare($query);
         $stmt->bind_param("i",$id);
         $stmt->execute();
         $result=$stmt->get_result();
         $row=$result->fetch_assoc();

         $id=$row['id'];
         $name=$row['name'];
         $cat=$row['category'];
         $dist=$row['distributor'];
         $quantity=$row['quantity'];
         $price=$row['price'];
         $percentage=$row['percentage'];
         $measure=$row['measurement'];
         $photo=$row['photo'];

         $update=true;
	}
	if (isset($_POST['update'])) {
		$id=$_POST['id'];
		 $name=$_POST['name'];
         $cat=$_POST['cat'];
         $dist=$_POST['dist'];
         $quantity=$_POST['quantity'];
         $price=$_POST['price'];
         $percentage=$_POST['percentage'];
         $measure=$_POST['measure'];
         $oldimage=$_POST['oldimage'];

        if (isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")) {
        	 $newimage="uploads/".$_FILES['image']['name'];
        	 unlink($oldimage);
        	 move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
}     
          else {
          	$newimage=$oldimage;
          }
          
           

		$query="UPDATE product SET name=?,category=?,distributor=?,quantity=?,price=?,percentage=?,measurement=?,photo=? WHERE id=?";
		$stmt=$con->prepare($query);
		 $stmt->bind_param("sssiisssi",$name,$cat,$dist,$quantity,$price,$percentage,$measure,$newimage,$id);
		$stmt->execute();
		$_SESSION['response']="Updated Successfully";
		$_SESSION['res_type']="primary";
		header('location:product.php');
	}

?>
 <!DOCTYPE html>
 <html oncontextmenu="return false">
 <head>
 	<title></title>
     <link rel="icon"  href="liquoricon.png">
 		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </head>
 <body>
 <div class="container fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<h3 class="text-center text-dark mt-2">PRODUCTS</h3>
			<hr>
			</div>
		</div>
	<div class="row">
	<div class="col-md-4">
		<h3 class="text-center text-info">Add Products</h3>
		<form action="#" method="POST" enctype="multipart/form-data">
		         <input type="hidden" name="id" value="<?=$id; ?>">
			<div class="form-group">
			<input type="text" name="name" value="<?=$name; ?>" class="form-control" placeholder="Enter Product Name" required>
			</div>
			<div class="form-group">
			<select class="form-control" value="<?=$cat; ?>" name="cat">
				<option value="" selected disabled>Select Category</option>
				<?php while($row=$result->fetch_assoc()){ ?>

                     <option><?=$row['category']; ?></option>
                      <?php } ?>
			</select>
		</div>
		<div class="form-group">
			<select class="form-control" value="<?=$dist; ?>" name="dist">
                   <option value="" selected disabled>Select Distributor</option>
				<?php while($row=$resultt->fetch_assoc()){ ?>
					
                     <option><?=$row['distributor']; ?></option>
                      <?php } ?>
			</select>
		</div>
			<div class="form-group">
			<input type="text" name="quantity" value="<?=$quantity; ?>" class="form-control" placeholder="Enter Quantity" required>
			</div>
			<div class="form-group">
			<input type="text" name="price" value="<?=$price; ?>" class="form-control" placeholder="Enter Price" required>
			</div>
			<div class="form-group">
			<input type="text" name="percentage" value="<?=$percentage; ?>" class="form-control" placeholder="Enter Alcochol Percentage" required>
			</div>
            <div class="form-group">
			<input type="text" name="measure" value="<?=$measure; ?>"  class="form-control" placeholder="Enter Alcochol Measurement" required>
		</div>
			 <div class="form-group">
			 	<input type="hidden" name="oldimage" value="<?= $photo; ?>">
			<input type="file" name="image"  class="custom-file"> 
			<img src="<?= $photo; ?>" width="50" class="img-thumbnail">
			</div>
			 <div class="form-group">
			 		<?php if($update==true){ ?>
					<input type="submit" name="update" class="btn btn-success btn-block" value="Update Changes">
				<?php } else{ ?>
			<input type="submit" name="add" class="btn btn-primary btn-block" value="Add Product">
			<?php } ?>
		</div>
		</form>
            </div>
            <div class="col-md-8">
        <?php 
        $query="SELECT * FROM product";
        $stmt=$con->prepare($query);
        $stmt->execute();
        $result=$stmt->get_result();
?>

<h3 class="text-center text-info">Products present in the database</h3>
		 <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
         <th>Image</th>
        <th> Name</th>
        <th>Category</th>
        <th>Distributor</th>
        <th>Quantity</th>
         <th>Price</th>
        <th>Percentage</th>
           <th>Measure</th>
        <th>Action</th>
         </tr>
    </thead>
    <tbody>
    	<?php while($row=$result->fetch_assoc()){ ?>
      <tr>
        <td width="80"><?=$row['id']; ?></td>
        <td><img src="<?= $row['photo']; ?>" width="35"></td>
         <td width="100"><?=$row['name']; ?></td>
          <td width="100"><?=$row['category']; ?></td>
        <td width="100"><?=$row['distributor']; ?></td>
        <td width="200"><?=$row['quantity']; ?></td>
        <td width="200"><?=$row['price']; ?></td>
        <td width="200"><?=$row['percentage']; ?></td>
         <td width="200"><?=$row['measurement']; ?></td>
        <td width="220">
        	<a href="product.php?delete=<?=$row['id']; ?>" class="badge badge-danger p-1">Delete</a> |
        	<a href="product.php?edit=<?=$row['id']; ?>" class="badge badge-success p-1">Edit</a>
        </td>
       </tr>
       <?php } ?>
     </tbody>
       </table>

	</div>
		
   </div> 
   <script type="text/javascript">
  $(document).keydown(function(e){ 
    if(e.which === 123){ 
       return false; 
    } 
}); 
</script>
 </body>
 </html>