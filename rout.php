<div class="noprint">
	<?php include 'header.php'; ?>
</div>
<?php
		function emptySession() {
			$prod =''; $_SESSION['prod']='';
			$sdate='';$_SESSION['sdate']='';
			$reason =''; $_SESSION['reason']='';
			$pieces =''; $_SESSION['pieces']='';
			$id =''; $_SESSION['id']='';
		}
		emptySession();
		$_SESSION['d1']=date('d/m/Y');
		$_SESSION['d2']=date('d/m/Y');
		
	if(isset($_POST['save'])){
		$prod = $_POST['prod'];
		$sdate = $_POST['sdate'];
		$reason = $_POST['reason'];
		$pieces = $_POST['pieces'];
		$id = $_POST['id'];		
		
		$Qry4 = mysqli_query($conn,"SELECT Id FROM returnout WHERE Id='$id'");
		if(mysqli_num_rows($Qry4)>0){
			$Qry5 = mysqli_query($conn,"UPDATE returnout SET Code='$prod',Pieces='$pieces',Reason='$reason',Sdate='$sdate' WHERE Id='$id'");
			if(!$Qry5){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry6 = mysqli_query($conn,"INSERT INTO returnout (Code,Pieces,Reason,Sdate) VALUES('$prod','$pieces','$reason','$sdate')");
			if(!$Qry6){
				echo "$failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}
	}
	
	if(isset($_POST['edit'])){
		$id = $_POST['edit'];
		
		$Qry3 = mysqli_query($conn,"SELECT * FROM returnout WHERE Id='$id'");
		$row = mysqli_fetch_assoc($Qry3);
		$prod = $row['Code'];
		$sdate = $row['Sdate'];
		$reason = $row['Reason'];
		$pieces = $row['Pieces'];
		$id = $row['Id'];
		
		$_SESSION['prod'] = $prod;
		$_SESSION['sdate'] = $sdate;
		$_SESSION['reason'] = $reason;
		$_SESSION['pieces'] = $pieces;
		$_SESSION['id'] = $id;
		}
		$prod = $_SESSION['prod'];
		$sdate=$_SESSION['sdate'];
		$reason = $_SESSION['reason'];
		$pieces = $_SESSION['pieces'];
		$id = $_SESSION['id'];
		
		if(isset($_POST['search'])){
			$d1 = $_POST['start'];
			$d2 = $_POST['ends'];
			
			$_SESSION['d1'] = $d1;
			$_SESSION['d2'] = $d2;
			
		}
		$d1 = $_SESSION['d1'];
		$d2 = $_SESSION['d2'];
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
		<div class="noprint">
			<form method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" >
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
				<label>Stock Date</label>
				<select name="sdate" required>
					<option value="">Select Date</option>
					<?php 
					$Qry1 = mysqli_query($conn,"SELECT * FROM stocks");
					while($row = mysqli_fetch_assoc($Qry1)){
						?>
						<option value="<?php echo $row['Sdate']?>" <?php if($sdate==$row['Sdate']){?>selected<?php } ?>><?php echo $row['Sdate']; ?></option>
						<?php
					}
					?>
				</select>
				<label>Reason</label>
				<textarea name="reason" required><?php echo $reason; ?>
				</textarea>
				<label>Pieces</label>
				<input type="text" name="pieces" value="<?php echo $pieces; ?>" required autocomplete="off">
				<label>&nbsp;</label><input type="submit" name="save" value="save">
			</form>
		</div>
		<div class="x">
			<div class="noprint">
				<form method="post">
					<div class="date">
						From.:<input type="date" name="start" value="<? $d1; ?>" required id="start" onchange="checkTime()"> To.:
						<input type="date" name="ends" value="<? echo $d2; ?>" required id="end" onchange="checkTime()">&nbsp;
						<button type="submit" name="search" >Search</button>
						<button onClick="javascript:print()"  class="print">Print</button>
					</div>
				</form>
			</div>
			<table class="table">
			<caption style="background:gray; color:#fff;"><b>RETURNED OUT ITEMS FOR THE PERIOD:&nbsp;<?php echo $d1 ?>&nbsp;TO:&nbsp; <?php echo $d2 ?></b></caption>
				<tr>
					<th>Item</th>
					<th>Pieces</th>
					<th>Reason</th>
					<th class="noprint"></th>
				</tr>
				<?php
					 $Qry2 = mysqli_query($conn,"SELECT Id,Pieces,Reason,(SELECT ItemName FROM products WHERE products.Code=returnout.Code)Item FROM returnout
					 WHERE Sdate>='$d1' AND Sdate<='$d2'");
					 if(!$Qry2){
						echo mysqli_error($conn);
					}
					 if(mysqli_num_rows($Qry2)>0){
						 while($row = mysqli_fetch_assoc($Qry2)){
							 ?>
							 <form method="post">
								<tr>
									<td><?php echo $row['Item']; ?></td>
									<td><?php echo $row['Pieces']; ?></td>
									<td><?php echo $row['Reason']; ?></td>
									<td class="noprint"><input type="checkbox" value="<?php echo $row['Id']; ?>" name="edit" onclick="submit()"></td>
								</tr>
							 </form>
							 <?php
						 }
					 }else{
						 ?>
						 <tr>
						 <td colspan=4 align="center">No Returns Today</td>
						 </tr>
						 <?php
					 }
				?>
			</table>
		</div>
	</div>
</body>
<div class="noprint">
	<?php include 'footer.php'; ?>
</div>