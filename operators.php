<?php include 'header.php'; ?>
<?php
			function emptySession() {
				$num ='';$_SESSION['num']='';
				$counter ='';$_SESSION['counter']='';
				$name ='';$_SESSION['name']='';
				$idno ='';$_SESSION['idno']='';
				$pin ='';$_SESSION['pin']='';
				$phone ='';$_SESSION['phone']='';
				$username ='';$_SESSION['username']='';
				$password ='';$_SESSION['password']='';
				$address ='';$_SESSION['address']='';
			}
			emptySession();
				
	 if(isset($_POST['save'])){
		$num = $_POST['num'];
		$name = $_POST['name'];
		$idno = $_POST['idno'];
		$pin = $_POST['pin'];
		$phone = $_POST['phone'];
		$username = $_POST['username'];
		$address = $_POST['address'];
		$counter = $_POST['counter'];
		
		$chek = mysqli_query($conn,"SELECT Num FROM operators WHERE Num = '$num'");
		if(mysqli_num_rows($chek)>0){
			$Qry3 = mysqli_query($conn,"UPDATE operators SET Name='$name',IdNo='$idno',Pin='$pin',Phone='$phone',Address='$address',Counter='$counter',
			Username='$username' WHERE Num='$num'");
			if(!$Qry3){
				echo "failed" .mysqli_query($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry4 = mysqli_query($conn,"INSERT INTO operators (Name,IdNo,Pin,Phone,Address,Counter,Username) VALUES ('$name','$idno','$pin','$phone','$address','$counter','$username')");
			if(!$Qry4){
				echo "failed" .mysqli_query($conn);
			}else{
				emptySession();
			}
		}
	 }
	 
	 if(isset($_POST['edit'])){
		 $num = $_POST['edit'];
		 
		 $Qry5 = mysqli_query($conn,"SELECT * FROM operators WHERE Num='$num'");
		 $rows = mysqli_fetch_assoc($Qry5);
		 
		 $num = $rows['Num'];
		 $counter = $rows['Counter'];
		 $name = $rows['Name'];
		 $idno = $rows['IdNo'];
		 $pin = $rows['Pin'];
		 $username = $rows['Username'];
		 $phone = $rows['Phone'];
		 $address = $rows['Address'];
		 
		 $_SESSION['num']=$num;
		 $_SESSION['counter']=$counter;
		 $_SESSION['name']=$name;
		 $_SESSION['idno']=$idno;
		 $_SESSION['pin']=$pin;
		 $_SESSION['username']=$username;
		 $_SESSION['phone']=$phone;
		 $_SESSION['address']=$address;
	 }
		$num =$_SESSION['num'];
		$counter =$_SESSION['counter'];
		$name =$_SESSION['name'];
		$idno =$_SESSION['idno'];
		$pin =$_SESSION['pin'];
		$username =$_SESSION['username'];
		$phone =$_SESSION['phone'];
		$address =$_SESSION['address'];
?>
<head>
	<style>
		.cont {
			  display: grid;
			  grid-template-columns:40% 50%;
			  grid-gap: 5px;
			  padding: 1px;
			  justify-content:center;
			  margin:auto;
			}

			.cont > div {
			  padding: 2px 0;
			  font-size: 20px;
			}
			.table{
				border-collapse:collapse;
				width:90%;
				margin:auto;
			}
			th,
			td {
			  border: 1px solid #529432;
			}
			th {
			  background: gray;
			}
	</style>
</head>
<body onload="closenav()">
	<div class="cont">
		<div>
			<form method="post">
				<input type="hidden" name="num" value="<?php echo $num; ?>">
				<label>Name.</label>
				<input type="text" name="name" value="<?php echo $name; ?>" required autocomplete="off">
				<label>ID No.</label>
				<input type="number" name="idno" value="<?php echo $idno; ?>" required autocomplete="off">
				<label>KRA Pin</label>
				<input type="text" name="pin" value="<?php echo $pin; ?>" required autocomplete="off">
				<label>Phone</label>
				<input type="number" name="phone" value="<?php echo $phone; ?>" required autocomplete="off">
				<label>Address</label>
				<input type="text" name="address" value="<?php echo $address; ?>" required autocomplete="off">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" required autocomplete="off">
				<label>Sell Point</label>
				<select name="counter" required>
					<option value="">Select Counter</option>
					<?php 
					$Qry1 = mysqli_query($conn,"SELECT * FROM counters");
					while($row = mysqli_fetch_assoc($Qry1)){
						?>
						<option value="<?php echo $row['Code']?>" <?php if($counter==$row['Code']){?>selected<?php } ?>><?php echo $row['Name']; ?></option>
						<?php
					}
					?>
				</select>
				<label>&nbsp;</label><input type="submit" value="Save" name="save" >
			</form>
		</div>
		<div>
			<table class="table">
				<tr>
					<th>Name</th>
					<th>Id No.</th>
					<th>Phone</th>
					<th>Sell Point</th>
					<th></th>
				</tr>
				<?php
					$Qry2 = mysqli_query($conn,"SELECT Num,Name,IdNo,Phone,(SELECT Name FROM counters WHERE counters.Code=operators.Counter)Counter FROM operators");
					if(mysqli_num_rows($Qry2)>0){
						while($row= mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Name']; ?></td>
									<td><?php echo $row['IdNo']; ?></td>
									<td><?php echo $row['Phone']; ?></td>
									<td><?php echo $row['Counter']; ?></td>
									<td><input type="checkbox" value="<?php echo $row['Num']; ?>" name="edit" onclick="submit()"></td>
								</tr>
							</form>
							<?php
						}
					}else{
						?>
						<tr><td colspan="4">No Data</td></tr>
						<?php
					}
				?>
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php'; ?>