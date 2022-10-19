<?php include 'header.php'; ?>
<?php
			function emptySession() {
				$prod='';  $_SESSION['prod']='';
				$amount=''; $_SESSION['amount']='';
				$offer=''; $_SESSION['offer']='';
				$status=''; $_SESSION['status']='';
				$id=''; $_SESSION['id']='';
			}
			emptySession();
	if(isset($_POST['save'])){
		$prod = $_POST['prod'];
		$amount = $_POST['amount'];
		$offer = $_POST['offer'];
		$status = $_POST['status'];
		$id = $_POST['id'];
		
		$Qry3 = mysqli_query($conn,"SELECT Id FROM discounts WHERE Id='$id'");
		if(mysqli_num_rows($Qry3)>0){
			$Qry4= mysqli_query($conn,"UPDATE discounts SET Code='$prod',Amount='$amount',Offer='$offer',Status='$status' WHERE Id='$id'");
			if(!$Qry4){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry5 = mysqli_query($conn,"INSERT INTO discounts(Code,Amount,Offer,Status) VALUES ('$prod','$amount','$offer','$status')");
			if(!$Qry5){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}
	}
	
	if(isset($_POST['edit'])){
		$id = $_POST['edit'];
		
		$Qry6 = mysqli_query($conn,"SELECT * FROM discounts WHERE Id='$id'");
		$rows = mysqli_fetch_assoc($Qry6);
		$prod = $rows['Code'];
		$amount = $rows['Amount'];
		$offer = $rows['Offer'];
		$status = $rows['Status'];
		$id = $rows['Id'];
		
		$_SESSION['prod']= $prod;
		$_SESSION['amount']=$amount;
		$_SESSION['offer']=$offer;
		$_SESSION['status']=$status;
		$_SESSION['id']=$id;
	}
		$prod= $_SESSION['prod'];
		$amount=$_SESSION['amount'];
		$offer=$_SESSION['offer'];
		$status=$_SESSION['status'];
		$id=$_SESSION['id'];
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
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<label>Item</label>
				<select name="prod" required>
					<option value="">Select Product</option>
					<?php 
					$Qry1 = mysqli_query($conn,"SELECT * FROM products");
					while($row = mysqli_fetch_assoc($Qry1)){
						?>
						<option value="<?php echo $row['Code']?>" <?php if($prod==$row['Code']){?>selected<?php } ?>><?php echo $row['ItemName']; ?></option>
						<?php
					}
					?>
				</select>
				<label>Discount Amount</label>
				<input type="number" value="<?php echo $amount; ?>" name="amount" required autocomplete="off">
				<label>Offer Name</label>
				<input type="text" name="offer" value="<?php echo $offer; ?>"required autocomplete="off">
				<label>Status</label>
				<select name="status" required>
					<option value="">Select Status</option>
					<?php 
					$stat = array('Current','Not Current');
					foreach($stat AS $stats){
						?>
						<option value="<?php echo $stats?>" <?php if($status==$stats){?>selected<?php } ?>><?php echo $stats; ?></option>
						<?php
					}
					?>
				</select>
				<label>&nbsp;</label><input type="submit" name="save" value="Save">
			</form>
		</div>
		<div>
			<table class="table">
				<tr>
					<th>Item</th>
					<th>Offer</th>
					<th>Discount Amount</th>
					<th>Status</th>
					<th></th>
				</tr>
				<?php 
					$Qry2 = mysqli_query($conn,"SELECT Offer,Amount,Status,Id,(SELECT ItemName FROM products WHERE products.Code=discounts.Code)Item FROM discounts ");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Item']; ?></td>
									<td><?php echo $row['Offer']; ?></td>
									<td><?php echo $row['Amount']; ?></td>
									<td><?php echo $row['Status']; ?></td>
									<td><input type="checkbox" value="<?php echo $row['Id']; ?>" name="edit" onclick="submit()"></td>
								</tr>
							</form>
							<?php
						}
					}else{
						?>
						<tr><td colspan="5">No Data</td></tr>
						<?php
					}
				?>
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php'; ?>