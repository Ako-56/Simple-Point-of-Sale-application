<?php include 'header.php'; 
	$counter = $_SESSION['counter'];
	$employee = $_SESSION['emp'];
	$today = date('Y-m-d');
?>
<head>
	<style>
		.cont {
			  display: grid;
			  grid-template-columns:40% 40%;
			  grid-gap: 5px;
			  padding: 1px;
			  justify-content:center;
			  margin:auto;
			}

			.cont > div {
			  padding: 2px 0;
			  font-size: 20px;
			}
	</style>
</head>
<script>
	function printData(){
		   var divToPrint=document.getElementById("printTable");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   newWin.close();
		}
</script>
<script>
	function printData2(){
		   var divToPrint=document.getElementById("printTable2");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   newWin.close();
		}
</script>
<body>
	<div class="cont">
		<div>
		<button onclick="printData()">Print</button>
			<table border="1" style="border-collapse:collapse; width:100%;" class="table" id="printTable">
				<tr>
					<th>Code</th>
					<th>Item</th>
					<th>Expired</th>					
				</tr>
				<?php
					$Sqlx = mysqli_query($conn,"SELECT Code,(SELECT ItemName FROM products WHERE products.Code=stocks.Code)Item,((Quantity*Pieces)-
							(SELECT SUM(Quantity) FROM sales WHERE sales.Code=stocks.Code AND sales.Sdate>=stocks.Sdate))Remaining,
							Sdate FROM stocks WHERE Status='Current' AND (SELECT (DATEDIFF(Edate,Sdate)-DATEDIFF('$today',Sdate)) AS DateDiff)<=0");
					if(mysqli_num_rows($Sqlx)>0){
						while($rows=mysqli_fetch_assoc($Sqlx)){
							?>
							<tr>
								<td><?php echo $rows['Code']; ?></td>
								<td><?php echo $rows['Item']; ?></td>
								<td><?php echo $rows['Remaining']; ?></td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan=3 align="center">No Expiries</td>
						</tr>
						<?php
					}
				?>
			</table>
		</div>
		<div>
			<button onclick="printData2()">Print</button>
			<table border="1" style="border-collapse:collapse; width:100%;" class="table" id="printTable2">
				<tr>
					<th>Code</th>
					<th>Item</th>				
				</tr>
			<?php
				$Sql = mysqli_query($conn,"SELECT Code,(SELECT ItemName FROM products WHERE products.Code=stocks.Code)Item FROM stocks WHERE
				((SELECT SUM(Quantity * Pieces)+(SELECT IFNULL(SUM(Pieces),0) FROM returnin WHERE returnin.Code=stocks.Code))
				-(SELECT SUM(Quantity) FROM sales WHERE sales.Code=stocks.Code))<=10 GROUP BY Code");
				if(mysqli_num_rows($Sql)>0){
					while($row=mysqli_fetch_assoc($Sql)){
					?>
					<tr>
						<td><?php echo $row['Code']; ?> </td>
						<td><?php echo $row['Item']; ?> </td>
					</tr>
					<?php
					}
				}else{
					?>
					<tr><td colspan="2" align="center">Items Still InStock</td></tr> 
					<?php
				}
				?>
				</table>
		</div>
	</div>
</body>
<?php include 'footer.php'; ?>