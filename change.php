<?php include 'header.php'; ?>
<?php 
	if(isset($_POST['change'])){
		$username = $_POST['username'];
		$opass = $_POST['opass'];
		$npass = $_POST['npass'];
		$cpass = $_POST['cpass'];
		
		$Qry = mysqli_query($conn,"SELECT Username,Phone FROM operators WHERE Username='$username' AND Phone='$opass'");
		if(mysqli_num_rows($Qry)>0){
			$Qry1 = mysqli_query($conn,"UPDATE operators SET Password='$npass' WHERE Username = '$username'");
			if($Qry1){
				header("location:index.php");
			}else{
				echo "<script>alert('Check your Details');</script>'";
			}
		}
	}
?>
<head>
	<style>
		.change{
			width:50%;
			margin:auto;
		}
	</style>
</head>
<body>
	<div class="change">
		<form method="post">
			<label>Username</label>
			<input type="text" name="username" required autocomplete="off">
			<label>Old Password</label>
			<input type="password" name="opass" required>
			<label>New Password</label>
			<input type="password" name="npass" required>
			<label>Confirm Password</label>
			<input type="password" name="cpass" required>
			<label>&nbsp;</label><input type="submit" name="change" value="Change">
		</form>
	</div>
</body>
<?php include 'footer.php'; ?>