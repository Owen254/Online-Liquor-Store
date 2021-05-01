<?php 
include './conn.php';
include './admin.php';

$query="SELECT * FROM orders";
           $result=mysqli_query($con,$query);


 ?>
 <!DOCTYPE html>
 <html oncontextmenu="return false">
 <head>
 	<title></title>
 	 <link rel="icon"  href="liquoricon.png">
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
			<h3 class="text-center text-dark mt-2">Generating Reports</h3>
			<hr>
			</div>
		</div>
<div class="row">
	<div class="col-lg-12">
		Select Invoice:
		<form action="generate.php" method="GET">
       <select name="InvoiceNo">
       	<?php while($row=$result->fetch_assoc()){ ?>
					
                     <option><?=$row['invoice_no']; ?></option>
                      <?php } ?>
       </select>
           <input type="submit" name="generate" class="btn btn-info" value="PDF">
       </form>
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