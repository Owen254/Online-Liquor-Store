<?php 
include './conn.php';
include './admin.php';

 ?>
 <!DOCTYPE html>
 <html oncontextmenu="return false">
 <head>
 	<title></title>
 	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			<h3 class="text-center text-dark mt-2">Dashboard</h3>
			<hr>
			</div>
		</div>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registered Users</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php 
                             $sql="SELECT id FROM register_login";
                            $stmt=$con->prepare($sql);
                            $stmt->execute();
                            mysqli_stmt_bind_result($stmt, $id);
                            mysqli_stmt_store_result($stmt);
                           
                            $count=mysqli_stmt_num_rows($stmt);
                             echo $count;

                             ?>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Distributors</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php 
                             $sqll="SELECT id FROM distributor";
                            $stmt=$con->prepare($sqll);
                            $stmt->execute();
                            mysqli_stmt_bind_result($stmt, $id);
                            mysqli_stmt_store_result($stmt);
                           
                            $count=mysqli_stmt_num_rows($stmt);
                             echo $count;

                             ?>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php 
                             $sqllll="SELECT id FROM orders";
                            $stmt=$con->prepare($sqllll);
                            $stmt->execute();
                            mysqli_stmt_bind_result($stmt, $id);
                            mysqli_stmt_store_result($stmt);
                           
                            $count=mysqli_stmt_num_rows($stmt);
                             echo $count;

                             ?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders Not Delivered</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php 
							$delivery_status="Pending";
                             $sqllll="SELECT id FROM orders WHERE delivery_status='$delivery_status' ";
                            $stmt=$con->prepare($sqllll);
                            $stmt->execute();
                            mysqli_stmt_bind_result($stmt, $id);
                            mysqli_stmt_store_result($stmt);
                           
                            $count=mysqli_stmt_num_rows($stmt);
                             echo $count;

                             ?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php 
							$delivery="Delivered";
							
							$grand_total=0;
							
                             $select="SELECT SUM(amount) AS sum FROM orders WHERE delivery_status='$delivery'";
                             $run=mysqli_query($con,$select);
                             while ($row=mysqli_fetch_assoc($run)) {
                             	$grand_total=number_format($row['sum']);
                             	echo "Ksh&nbsp;"."".$grand_total."/=";
                             }
                             
							?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	
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