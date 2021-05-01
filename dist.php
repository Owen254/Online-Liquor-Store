<?php 
include './admin.php';
include './conn.php';
$update=false;

 $id="";
 $distributor="";
 $person="";
 $number="";
 $address="";

if (isset($_POST['add'])) {
      $distributor=$_POST['distributor'];
       $person=$_POST['person'];
        $number=$_POST['number'];
         $address=$_POST['address'];
      $query="INSERT INTO distributor(distributor,contact_person,contact_number,address) VALUES(?,?,?,?)";
      $stmt=$con->prepare($query);
      $stmt->bind_param("ssss",$distributor,$person,$number,$address);
      $stmt->execute();

       header('location:dist.php');
       $_SESSION['response']="Successfully inserted to the database";
       $_SESSION['res_type']="success";
}
if (isset($_GET['delete'])) {
		$id=$_GET['delete'];
		$query="DELETE FROm distributor WHERE id=?";
		$stmt=$con->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
	}
 if (isset($_GET['edit'])) {
		$id=$_GET['edit'];
        $query="SELECT * FROM distributor WHERE id=?";
         $stmt=$con->prepare($query);
         $stmt->bind_param("i",$id);
         $stmt->execute();
         $result=$stmt->get_result();
         $row=$result->fetch_assoc();

         $id=$row['id'];
         $distributor=$row['distributor'];
         $person=$row['contact_person'];
         $number=$row['contact_number'];
         $address=$row['address'];
         
         $update=true;
	}
	if (isset($_POST['update'])) {
		$id=$_POST['id'];
		$distributor=$_POST['distributor'];
        $person=$_POST['person'];
        $number=$_POST['number'];
        $address=$_POST['address'];

		$query="UPDATE distributor SET distributor=?,contact_person=?,contact_number=?,address=? WHERE id=?";
		$stmt=$con->prepare($query);
		$stmt->bind_param("ssssi",$distributor,$person,$number,$address,$id);
		$stmt->execute();
		
		header('location:dist.php');
	}
?>

<!DOCTYPE html>
<html oncontextmenu="return false">
  <head>
	<title></title>
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
			<h3 class="text-center text-dark mt-2">DISTRIBUTORS</h3>
			<hr>
			</div>
		</div>
	

<div class="row">
	<div class="col-md-4">
		<h3 class="text-center text-info">Add Distributor</h3>
		<form action="#" method="POST">
		         <input type="hidden" name="id" value="<?=$id; ?>">
			<div class="form-group">
			<input type="text" name="distributor" value="<?=$distributor; ?>" class="form-control" placeholder="Enter Distributor" required>
			</div>
			<div class="form-group">
			<input type="text" name="person" value="<?=$person; ?>" class="form-control" placeholder="Enter Contact Person" required>
			</div>
			<div class="form-group">
			<input type="text" name="number" value="<?=$number; ?>" class="form-control" placeholder="Enter Contact number" required>
			</div>
			<div class="form-group">
			<input type="text" name="address" value="<?=$address; ?>" class="form-control" placeholder="Enter Address" required>
			</div>
			<div class="form-group">
				<?php if($update==true){ ?>
					<input type="submit" name="update" class="btn btn-success btn-block" value="Update Changes">
				<?php } else{ ?>
				<input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
		          <?php } ?>
			</div>
		</form>
	</div>
	<div class="col-md-8">
        <?php 
        $query="SELECT * FROM distributor";
        $stmt=$con->prepare($query);
        $stmt->execute();
        $result=$stmt->get_result();
?>

<h3 class="text-center text-info">Records present in the database</h3>
		 <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Distributor</th>
        <th>Contact Person</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Action</th>
         </tr>
    </thead>
    <tbody>
    	<?php while($row=$result->fetch_assoc()){ ?>
      <tr>
        <td width="80"><?=$row['id']; ?></td>
        <td width="100"><?=$row['distributor']; ?></td>
        <td width="200"><?=$row['contact_person']; ?></td>
        <td width="200"><?=$row['contact_number']; ?></td>
        <td width="200"><?=$row['address']; ?></td>
        <td width="205">
        	<a href="dist.php?delete=<?=$row['id']; ?>" class="badge badge-danger p-2">Delete</a> |
        	<a href="dist.php?edit=<?=$row['id']; ?>" class="badge badge-success p-2">Edit</a>
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