<script type="text/javascript">
  $(document).keydown(function(e){ 
    if(e.which === 123){ 
       return false; 
    } 
}); 
</script><?php 
include './admin.php';
include './conn.php';

if (isset($_GET['confirm'])) {
      $id=$_GET['confirm'];
      $newdel="Delivered";
      $query="UPDATE orders SET delivery_status=? WHERE id=?";
      $stmt=$con->prepare($query);
        $stmt->bind_param("si",$newdel,$id);
        $stmt->execute();
  }
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
<div class="container">
  <div class="row justify-content-center">
    
      
 
      <div class="table-responsive mt-2">

      	<div>
    <?php 
        $query="SELECT * FROM orders";
        $stmt=$con->prepare($query);
        $stmt->execute();
        $result=$stmt->get_result();
?>

     <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Products</th>
        <th>Amount</th>
        <th>Invoice_no</th>
        <th>Date Ordered</th>
        <th>Payment Mode</th>
        <th>Delivery Status</th>
        <th>Action</th>
        


        </tr>
    </thead>
    <tbody>
      <?php while($row=$result->fetch_assoc()){ ?>
      <tr>
        <td width><?=$row['name']; ?></td>
        <td width="100"><?=$row['phone']; ?></td>
        <td width="200"><?=$row['address']; ?></td>
        <td width="300"><?=$row['products']; ?></td>
         <td width="200"><?=$row['amount']; ?></td>
        <td width="200" bgcolor="yellow"><?=$row['invoice_no']; ?></td>
         <td width="200"><?=$row['order_date']; ?></td>
          <td width="200"><?=$row['pmode']; ?></td>
          <td  width="200"><?=$row['delivery_status']; ?></td>
        <td width="205"><a href="orders.php?confirm=<?=$row['id']; ?>" class="btn btn-info <?=($row['delivery_status']=="Pending")?"":"disabled"; ?>">Confirm</a></td>
       </tr>
       <?php } ?>
     </tbody>
       </table>

  

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