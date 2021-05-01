<?php

include './conn.php';
session_start();
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
	header("Location: login.php?error=Incorrect username or password");
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
      $result="Successfully Registered Login Now";
    }
    else{
      $result="Failed to Register!!";
    }

  }
  else{
    $result="Password did not match";
  }
}
$_SESSION['message']='';

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
    $_SESSION['message']="Wrong Password";
  }
}

?>
<!DOCTYPE html>
<html>

<head oncontextmenu="return false">
  <script type="text/javascript">
    window.history.forward();

  </script>
  <title>QUEST LIQUOR STORE SYSTEM</title>
  <link rel="icon"  href="liquoricon.png">
  <link rel="stylesheet" type="text/css" href="login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
 

</head>
<body>

  
<div class="topnav">


  <label class="label">QUEST LIQUOR STORE</label>
  <!-- Button to open the modal login form -->
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" ><i class="fa fa-fw fa-user"></i> ADMIN</button>
  </div>
  <!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none' "class="close" title="Close Form">&times;</span>
  <!-- Modal Content -->
  <form class="modal-content animate" action="#" method="POST">
    
    <div class="imgcontainer">
       <img src="admin.webp"  class="admin">
      </div>
      <div class="container">
        <?php if (isset($_GET['error'])) {?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
       <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
       <button type="submit"  name="sub" class="log">Login</button>
   </div>
   <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
     
</div>
</form>
</div>


 <div class="hero">
      <div class="form-box">
        <div class="button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="login()">Login</button>
<button type="button" class="toggle-btn" onclick="register()">Register</button>
</div>
       <form action="#" method="POST" id="login" class="input-group">
      <h1>Sign in</h1>
       <input type="text" name="uname" placeholder="Enter Username" required>
      <input type="password" name="pass" placeholder="Enter Password" required><br>
      <a href="#">Forgot your password?</a>
      <button type="submit" name="login" class="submit-btn">Login</button>
    </form>

      <form action="#" method="POST" id="register" class="input-group">
      <h1>Sign Up</h1>
      <input type="text" name="u" placeholder="Enter Username" required><br>
       <input type="text" name="e" placeholder="Enter Email" required><br>
      <input type="password" name="p" placeholder="Enter Password" required><br>
       <input type="password" name="repass" placeholder="Confirm Password" required><br>
      <button type="submit" name="register" class="submit-btn">Register</button>
    </form>


      </div>
       </div>
    <script>
      var x= document.getElementById("login");
        var y= document.getElementById("register");
          var z=document.getElementById("btn");

function register() {
  x.style.left="-400px";
  y.style.left="50px";
  z.style.left="110px";
}
function login() {
  x.style.left="50px";
  y.style.left="450px";
  z.style.left="0";
}
</script>
    <div style="font-size: 30px;text-align: center;color:#255;text-shadow: 1px 1px #000"><?=$result; ?></div>

  </body>
</html>
