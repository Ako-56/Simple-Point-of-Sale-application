<div class="noprint">
	<?php include 'header.php'; ?>
</div>
<head>
</head>
<body>
	<div class="noprint">
		<div class="date">
			<button onClick="javascript:print()"  class="print" >Print</button>
		</div>
	</div>
	<table class="table" style="margin-top:20px;">
		<tr>
			<th>Code</th>
			<th>Item</th>
			<th align='right'>Sold</th>
			<th align='right'>Available</th>
		</tr>
		<?php 
			$Qry = mysqli_query($conn,"SELECT Code,(SELECT ItemName FROM products WHERE products.Code=stocks.Code)Item,SUM(Quantity * Pieces) AS Quantity,
				(SELECT SUM(Quantity) FROM sales WHERE sales.Code=stocks.Code)Sold,(SELECT SUM(Pieces) FROM returnin WHERE returnin.Code=stocks.Code)Returned
				FROM stocks GROUP BY Code");
			if(!$Qry){
				echo mysqli_error($conn);
			}
			if(mysqli_num_rows($Qry)>0){
				while($row = mysqli_fetch_assoc($Qry)){
					?>
					<tr>
						<td><?php echo $row['Code']; ?></td>
						<td><?php echo $row['Item']; ?></td>
						<td align='right'><?php echo $row['Sold']-$row['Returned']; ?></td>
						<td align='right'><?php echo $row['Quantity']-$row['Sold']+$row['Returned']; ?></td>
					</tr>
					<?php
				}
			}else{
				?>
				<tr><td colspan=4>No Data</td></tr>
				<?php
			}
		?>
	</table>
</body>
<div class="noprint">
	<?php include 'footer.php'; ?>
</div>