<?php 

include './conn.php';
session_start();

 $meso='';
 $link='';
$noti='';
$result='';
if (isset($_POST["sub"])) {
  $uname=$_POST["username"];
  $pass=md5($_POST["password"]);

$sql=mysqli_query($con,"SELECT * FROM adminlogin where user='$uname' && pass='$pass'");
$rowcount=mysqli_num_rows($sql);
if ($rowcount==1) {
  $_SESSION["user"]=$uname;
        header("Location: admin.php");
}
else{
  header("Location: index.php?error=Incorrect username or password");
  exit();
  
}

}
if (isset($_POST['register'])) {
  if ($_POST['p']==$_POST['repass']) {
    
    $username=$_POST['u'];
    $email=$_POST['e'];
    $password=md5($_POST['p']);
    

    $sql="INSERT INTO register_login(username,email,password)VALUES('$username','$email','$password')";
    if (mysqli_query($con,$sql)) {
      
        header("Location: index.php?message=<div class='alert alert-success'>Successfully Registered Login Now</div>");
           
    }

    else{
      header("Location: index.php?message=<div class='alert alert-danger'>Failed To Register!!</div>");
    }

  }
  else{
    header("Location: index.php?message=<div class='alert alert-danger'>Password did not match</div>");
    }

  }


if (isset($_POST['login'])) {
  $username=$_POST['uname'];
  $pass=md5($_POST['pass']);
 
  $sql="SELECT * FROM register_login WHERE username='$username' AND password='$pass'";
  $status=mysqli_query($con,$sql);
  if(mysqli_num_rows($status)){
    $_SESSION['uname']=$username;
    header("Location:welcome.php");
  }
  else{
   header("Location: index.php?message=<div class='alert alert-danger data-dismissable'>Wrong Username or Password</div>");
    }

  }
 



 ?>
<!DOCTYPE html>
<html oncontextmenu="return false">
<head>
  <title>QUEST LIQUOR STORE</title>
 <link rel="icon"  href="liquoricon.png">
  <link rel="stylesheet" type="text/css" href="index.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>

body {background-image: url(ground.jpg);
            background-size: cover;
            background-repeat: no-repeat;

}
.error{
  background: #F2DEDE;
  color: #A94442;
}
.log{
 background-color: #4CAF50;
  width: 100px;
  color: white;

}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;

}

.admin {
  width: 20%;
  border-radius: 50%;
 

}

.container {
  padding: 16px;
}



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}
.loginbutt{
  float: right;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
.jina{
  font-size: 40px;
   color: #f2f2f2;
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
#forgot-box{
  display: none;
}
#reset-box{
  display: none;
}
</style>

</head>
<body>
  <label class="jina" style="margin-left: 10px;">QUEST LIQUOR STORE</label>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-right:10px " class="loginbutt"><i class="fa fa-fw fa-user"></i>ADMIN</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none' "class="close" title="Close Form">&times;</span>
  <form class="modal-content animate" action="#" method="POST">
    <div class="imgcontainer">
       <img src="admin.webp"  class="admin">
      </div>
            <div style="text-align: center;">
         <?php if (isset($_GET['error'])) {?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
      </div>
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="sub" name="sub" class="logg">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      
    </div>
  </form>
</div>
<!--
            <div class="modal-footer">
                <div style="padding:10px"></div>
            </div>
-->
        
    <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
<div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading" id="heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Login</a>
              </div>
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Register</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div style="text-align: center;"><?php if (isset($_GET['message'])) {?>
          <p class="error"><?php echo $_GET['message']; ?></p>
        <?php } ?></div>
                
                <form id="login-form" action="#" method="POST" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="uname" tabindex="1" class="form-control" placeholder="Username" >
                  </div>
                  <div class="form-group">
                    <input type="password" name="pass" tabindex="2" class="form-control" placeholder="Password">
                    <a href="forgot.php" id="forgot-btn">Forgot password?</a>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login" id="log" tabindex="4" class="form-control btn btn-login" value="Log In">
                      </div>
                    </div>
                  </div>
                 
                </form>
                
                <form id="register-form" action="#" method="POST"  style="display: none;">
                  <div class="form-group">
                    <input type="text" name="u" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="e"  tabindex="1" class="form-control" placeholder="Email Address" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="p"   class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <input type="password" name="repass" placeholder="Confirm Password" required>
                   </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register" id="reg" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
                </form>

               <!-- forgot password-->
                 <div class="row">
              <div class="col-lg-12 " id="forgot-box">
                <h2 class="text-center mt-2" id="head">Forget Password</h2>
               <form id="forgot-form" action="#" method="POST" style="display: block;">
                  <?php echo $meso; ?>
                  <div class="form-group">
                   <small class="text-muted">
                    To Recover your password, Please enter the email address you registered for this account.
                    </small>
                  </div>
                  <div class="form-group">
                    <input type="email" name="femail" tabindex="1" class="form-control" placeholder="Enter your E-mail" required>
                  </div>
                 
                    <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="forgot"  tabindex="4" class="form-control btn btn-danger" value="Verify Email">
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group text-center">
                   <?php echo $link; ?>
                 </div>
                 <div class="form-group">
                   <a href="" id="back-btn">Back</a>
                 </div>
                 
                </form>
 
               <!-- Reset password-->

                
                 <div class="row">
                  <div class="col-lg-12 " id="reset-box">
                <h2 class="text-center mt-2">Reset Password</h2>
               <form id="reset-form" action="#" method="POST" style="display: block;">
                   <?php echo $noti; ?>
                  <div class="form-group">
                   <small class="text-muted">
                    To Reset your password, Please enter a new Password.
                    </small>
                  </div>
                      <div class="form-group">
                     <input type="password" name="newpass" placeholder="Enter New Password" required>
                   </div>
                   <div class="form-group">
                     <input type="password" name="conpass" placeholder="Retype New Password" required>
                   </div>
                    <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="reset"  tabindex="4" class="form-control btn btn-success" value="Reset Password">
                      </div>
                    </div>
                  </div>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function() {

    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  });
    </script>
 <script type="text/javascript">
   
   
   $('#change-btn').click(function(e) {
        $('#head').hide();
        $('#forgot-form').hide();
     $("#reset-box").show();
      $(this).addClass('active');  
       e.preventDefault();
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