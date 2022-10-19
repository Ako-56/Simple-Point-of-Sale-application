<?php include 'header.php'; ?>
<?php
		$today = date('Y-m-d');
		$counter = $_SESSION['counter'];
		$employee = $_SESSION['emp'];
		//$_SESSION['Sdate']=date('dd/mm/yyyy');$_SESSION['Edate']=date('dd/mm/yyyy');
		//echo $sdate;exit;
		
		function emptySession() {
			$prod =''; $_SESSION['Code']='';
			$bprice =''; $_SESSION['Bprice']='';
			$sprice =''; $_SESSION['Sprice']='';
			$sdate =''; $_SESSION['Sdate']='';
			$edate =''; $_SESSION['Edate']='';
			$supp =''; $_SESSION['Supplier']='';
			$quantity =''; $_SESSION['Quantity']='';
			$pieces =''; $_SESSION['pieces']='';
			$status =''; $_SESSION['status']='';
			$stockid =''; $_SESSION['StockId']='';
		}
		emptySession();
		
	if(isset($_POST['save'])){
		$prod = $_POST['prod'];
		$bprice = $_POST['bprice'];
		$sprice = $_POST['sprice'];
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		$supp = $_POST['supp'];
		$quantity = $_POST['quantity'];
		$pieces = $_POST['pieces'];
		$status = $_POST['status'];
		$stockid = $_POST['stockid'];
		
		$Qry3 = mysqli_query($conn,"SELECT * FROM stocks WHERE StockId='$stockid'");
		if(mysqli_num_rows($Qry3)>0){
			$Qry4 = mysqli_query($conn,"UPDATE stocks SET Code='$prod',Quantity='$quantity',Sdate='$sdate',Bprice='$bprice',Sprice='$sprice',Pieces='$pieces',Status='$status',
			Edate='$edate' WHERE StockId='$stockid'");
			if(!$Qry4){
				echo "failed".mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry5 = mysqli_query($conn,"INSERT INTO stocks(Code,Quantity,Sdate,Bprice,Sprice,Supplier,Pieces,Status,StockedBy,Edate) 
			VALUES ('$prod','$quantity','$sdate','$bprice','$sprice','$supp','$pieces','$status','$employee','$edate')");
			if(!$Qry5){
				echo "failed".mysqli_error($conn);
			}else{
				emptySession();
			}
		}
	}
	
	if(isset($_POST['edit'])){
		$stockid = $_POST['edit'];
		
		$Qry6 = mysqli_query($conn,"SELECT * FROM stocks WHERE StockId='$stockid'");
		$row = mysqli_fetch_assoc($Qry6);
		$prod = $row['Code'];
		$bprice = $row['Bprice'];
		$sprice = $row['Sprice'];
		$sdate = $row['Sdate'];
		$edate = $row['Edate'];
		$supp = $row['Supplier'];
		$pieces = $row['Pieces'];
		$quantity = $row['Quantity'];
		$status = $row['Status'];
		$stockid = $row['StockId'];
		
		$_SESSION['Code']=$prod;
		$_SESSION['Bprice']=$bprice;
		$_SESSION['Sprice']=$sprice;
		$_SESSION['Sdate']=$sdate;
		$_SESSION['Edate']=$edate;
		$_SESSION['Supplier']=$supp;
		$_SESSION['Quantity']=$quantity;
		$_SESSION['pieces']=$pieces;
		$_SESSION['status']=$status;
		$_SESSION['StockId']=$stockid;
	}
		$prod = $_SESSION['Code'];
		$bprice = $_SESSION['Bprice'];
		$sprice = $_SESSION['Sprice'];
		$sdate = $_SESSION['Sdate'];
		$edate = $_SESSION['Edate'];
		$supp = $_SESSION['Supplier'];
		$quantity = $_SESSION['Quantity'];
		$pieces = $_SESSION['pieces'];
		$status = $_SESSION['status'];
		$stockid = $_SESSION['StockId'];
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
			table{
				border-collapse:collapse;
				width:90%;
			}
	</style>
</head>
<body onload="closenav()">
	<div class="cont">
		<div>
			<form method="post">
				<input type="hidden" name="stockid" value="<?php echo $stockid ?>">
				<label>Product</label>
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
				<label>Buy Price</label>
				<input type="number" name="bprice" value="<?php echo $bprice ?>" required autocomplete="off">
				<label>Sell Price</label>
				<input type="number" name="sprice" value="<?php echo $sprice ?>" required autocomplete="off">
				<label>Stock Date</label>
				<input type="date" name="sdate" value="<?php echo $sdate ?>" required >
				<label>Expiry Date</label>
				<input type="date" name="edate" value="<?php echo $edate ?>" required >
				<label>Quantity</label>
				<input type="text" name="quantity" value="<?php echo $quantity ?>" required autocomplete="off">
				<label>Pieces in Pack</label>
				<input type="number" name="pieces" value="<?php echo $pieces ?>" required autocomplete="off">
				<label>Supplier</label>
				<select name="supp" required>
					<option value="">Select Supplier</option>
					<?php 
					$Qry1 = mysqli_query($conn,"SELECT * FROM suppliers");
					while($row = mysqli_fetch_assoc($Qry1)){
						?>
						<option value="<?php echo $row['Code']?>" <?php if($supp==$row['Code']){?>selected<?php } ?>><?php echo $row['Name']; ?></option>
						<?php
					}
					?>
				</select>
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
			<table>
				<tr>
					<th>Code</th>
					<th>Item</th>
					<th>Available</th>
					<th>Stock Date</th>
					<th>Buy Price</th>
					<th>Sell Price</th>
					<th></th>
				</tr>
				<?php
					$Qry2 = mysqli_query($conn,"SELECT StockId,Code,(SELECT ItemName FROM products WHERE products.Code=stocks.Code)Item,Quantity,Sdate,Bprice,Sprice
					FROM stocks WHERE (SELECT DATEDIFF('$today',Sdate) AS DateDiff)<=30");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Code']; ?></td>
									<td><?php echo $row['Item']; ?></td>
									<td><?php echo $row['Quantity']; ?></td>
									<td><?php echo $row['Sdate']; ?></td>
									<td><?php echo $row['Bprice']; ?></td>
									<td><?php echo $row['Sprice']; ?></td>
									<td><input type="checkbox" value="<?php echo $row['StockId']; ?>" name="edit" onclick="submit()"></td>
								</tr>
							</form>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan = 7 align="center">No Recent Stocks</td>
						</tr>
						<?php
					}
				?>
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php'; ?>
