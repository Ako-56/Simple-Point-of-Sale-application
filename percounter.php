<div class="noprint">
	<?php include 'header.php'; ?>
</div>
<?php
	$_SESSION['name']='';
	$code =''; $_SESSION['code']='';
	 $_SESSION['d1']=date('Y-m-d');
	 $_SESSION['d2']=date('Y-m-d');
	 
	if(isset($_POST['counter'])){
		$counter = $_POST['counter'];
		
		$Qry1 = mysqli_query($conn,"SELECT * FROM counters WHERE Code='$counter'");
		$row = mysqli_fetch_assoc($Qry1);
		$code = $row['Code'];
		$name = $row['Name'];
		
		$_SESSION['code'] = $code;
		$_SESSION['name'] = $name;
		
	}
	$name = $_SESSION['name'];
	$code = $_SESSION['code'];
	
		if(isset($_POST['search'])){
			$d1 = $_POST['start'];
			$d2 = $_POST['ends'];
			$code = $_POST['code'];
			$name = $_POST['name'];
			
			$_SESSION['d1'] = $d1;
			$_SESSION['code'] = $code;
			$_SESSION['name'] = $name;
			$_SESSION['d2'] = $d2;
			
		}
		$d1 = $_SESSION['d1'];
		$codex = $_SESSION['code'];
		$d2 = $_SESSION['d2'];
		$namex = $_SESSION['name'];
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
<body>
	<div class="cont">
		<div class="noprint">
			<table class="table">
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th></th>
				</tr>
				<?php
					$Qry = mysqli_query($conn,"SELECT * FROM counters ");
					while($row=mysqli_fetch_assoc($Qry)){
						?>
						<form method="post">
							<tr <?php if($code==$row['Code']){?>bgcolor="#f2d9e6"<?php } ?>>
								<td><?php echo $row['Code']; ?></td>
								<td><?php echo $row['Name']; ?></td>
								<td><input type="checkbox" value="<?php echo $row['Code']; ?>" name="counter" onclick="submit()" 
								<?php if($code==$row['Code']){?>checked<?php } ?>></td>
							</tr>
						</form>
						<?php
					}
				?>
			</table>
		</div>
		<div class="x">
			<div class="noprint">
				<form method="post">
					<div class="date">
					<input type="hidden" name="code" value="<?php echo $code; ?>">
					<input type="hidden" name="name" value="<?php echo $name; ?>">
						From.:<input type="date" name="start" required id="start" onchange="checkTime()"> To.:
						<input type="date" name="ends" required id="end" onchange="checkTime()">&nbsp;
						<button type="submit" name="search">Search</button>
						<button onClick="javascript:print()"  class="print">Print</button>
					</div>
				</form>
			</div>
			<table class="table">
				<tr>
					<th colspan=5>Sales for <?php echo $code."--".$name; ?> For the Period <?php echo $d1;?> To <?php echo $d2;?></th>
				</tr>
				<tr>
					<th>Date</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>
				</tr>
				<?php 
					$total =0;
					$Qry = mysqli_query($conn,"SELECT Sdate,Quantity,Price,(Quantity*Price) AS Total,(SELECT ItemName FROM products WHERE products.Code=sales.Code)Code FROM sales 
					WHERE Counter ='$codex' AND Sdate>='$d1' AND Sdate<='$d2' ORDER BY Sdate ");
					if(!$Qry){
						echo mysqli_error($conn);
					}
					while($rows = mysqli_fetch_assoc($Qry)){
						?>
						<tr>
							<td><?php echo $rows['Sdate']; ?></td>
							<td><?php echo $rows['Code']; ?></td>
							<td><?php echo $rows['Quantity']; ?></td>
							<td><?php echo $rows['Price']; ?></td>
							<td><?php echo $rows['Total']; $total += $rows['Total']?></td>
						</tr>
						<?php
					}
				?>
				<tr>
					<td colspan=4><b>Total</b></td>
					<td><b><?php echo $total; ?></b></td>
				</tr>
			</table>
		</div>
	</div>
</body>
<div class="noprint">
	<?php include 'footer.php'; ?>
</div>