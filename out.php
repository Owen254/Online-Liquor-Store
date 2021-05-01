<?php 
include './conn.php';
session_start();
$name=$_SESSION['name'];
$phone=$_SESSION['phone'];
$product=$_SESSION['products'];
$grand_total=$_SESSION['grand_total'];
$address=$_SESSION['address'];
	$pmode=$_SESSION['payment'];
$data='';
	$data .='
	<div class="text-center">
	<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
	<h2 class="text-success">Your Order Has Been Placed Successfully!<h2>
<h4 class="bg-danger text-light rounded p-2 " style="width:516px; margin-left:525px;">Items Purchased : '.$product.'</h4>
<h4>Your Name : '.$name.' </h4>
	<h4>Your Phone No : '.$phone.' </h4>
	<h4>Your Delivery Address : '.$address.' </h4>
	<h4>Delivery Fee : Free </h4>
	<h4>Total Amount : ksh&nbsp;&nbsp'.number_format($grand_total).'/- </h4>
	<h4>Payment Mode : '.$pmode.' </h4>
	</div>';
	
	

	


 ?>
 <!DOCTYPE html>
<html oncontextmenu="return false">
<head>
	<title>Checkout</title>
   <link rel="icon"  href="liquoricon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    <img src="liquoricon.png" alt="logo" style="width:40px;">
  </a>
  <a class="navbar-brand" href="welcome.php">QUEST LIQUOR STORE</a>
  <!-- Links -->
  <ul class="navbar-nav ml-auto">
   <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">My Account</a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <p class="dropdown-item" style="text-align: center;"><b>Hi, <?=$_SESSION['uname'] ?></b></p>
   <a class="dropdown-item" href="logout.php" ><i class="fa fa-sign-out"></i>Logout</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="changepassword.php"><i class="fa fa-key"></i> Change password</a>
  </div>
    </li>

<li class="nav-item">
      <a class="nav-link active" href="cart.php"><i class="fa fa-shopping-cart" style="font-size:18px;"></i> <span id="cart-item" class="badge badge-danger" ></span></a>
    </li>
  </ul>
 </nav>
 <?php 
  echo $data;
  $remove="DELETE FROM cart";
	$run=mysqli_query($con,$remove);
  ?>
<script type="">
	  $(document).ready(function(){
         load_cart_item_number();

      function load_cart_item_number(){
        $.ajax({
           url:'config.php',
           method:'get',
           data: {cartItem:"cart_item"},
           success:function(response){
            $("#cart-item").html(response);
           }
        });
      }
    });

</script>
<script type="text/javascript">
  $(document).keydown(function(e){ 
    if(e.which === 123){ 
       return false; 
    } 
}); 
</script>
</body>
</html>