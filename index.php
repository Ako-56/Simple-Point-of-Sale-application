<?php 
include 'config/config.php';

	session_start();

error_reporting(0);

if (isset($_POST['submit'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$check = mysqli_query($conn,"SELECT Password FROM operators WHERE Username='$username'");
	$res = mysqli_fetch_assoc($check);
	$pass=$res['Password'];
	if ($pass==''){
		//echo "m"; exit;
		$sql= "SELECT * FROM operators WHERE Username='$username' and Phone='$password'";
		$result= mysqli_query($conn,$sql);
		if($result->num_rows > 0)
		{	
			$row = mysqli_fetch_assoc($result);
			if ($password==$row['Phone']) 
			{
				$_SESSION['username'] = $row['Username'];
				$_SESSION['mtu']= $row['Ops'];
				?><script> document.getElementById("profilename").innerHTML="logout";</script><?php
				header("Location: change.php");
			} 
			else 
			{
				echo "<script>alert('Woops! Password is Wrong.')</script>";
			}
		}else{
			echo "<script>alert('Username you entered is not registered.');</script>";
		}
	}else{
		$sql= "SELECT * FROM operators WHERE Username='$username' and Password='$password'";
			$result= mysqli_query($conn,$sql);
			if($result->num_rows > 0)
			{	
				$row = mysqli_fetch_assoc($result);
				if ($password==$row['Password']) 
				{
					$_SESSION['username'] = $row['Name'];
					$_SESSION['mtu']= $row['Ops'];
					$_SESSION['counter']= $row['Counter'];
					$_SESSION['emp']= $row['Num'];
					?><script> document.getElementById("profilename").innerHTML="logout";</script><?php
					 //$_SESSION["login_time_stamp"] = time(); 
					header("Location: home.php");
				} 
				else 
				{
					echo "<script>alert('Woops! Password is Wrong.')</script>";
				}
			}else{
				echo "<script>alert('Username entered is not registered.');</script>";
				echo  mysqli_error($conn);
			}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="login.css">

	<title>Login Form</title>
</head>
<script>     
	if ( window.history.replaceState ) {
	  window.history.replaceState( null, null, window.location.href );
	} 
</script>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>" required autocomplete="off">
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<input type="submit" name="submit" class="btn" value="Login">
			</div>
			<!--<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>-->
		</form>
	</div>
</body>
</html>