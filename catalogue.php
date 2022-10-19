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
			<th align="left">Code</th>
			<th align="left">Name</th>
			<th align="right">Buying Price</th>
			<th align="right">Selling Price</th>
			<th align="right">Pieces in pack</th>
			<th>% Sale</th>
		</tr>
		<?php
			$Qry1 = mysqli_query($conn,"SELECT Code,ItemName,(SELECT Pieces FROM stocks WHERE stocks.Code=products.Code AND Status='Current')Pieces,
			(SELECT Bprice FROM stocks WHERE stocks.Code=products.Code AND Status='Current')Bprice,
			(SELECT Sprice FROM stocks WHERE stocks.Code=products.Code AND Status='Current')Sprice FROM products");
			if(mysqli_num_rows($Qry1)>0){
				while($row = mysqli_fetch_assoc($Qry1)){
					?>
					<tr>
						<td><?php echo $row['Code']; ?></td>
						<td><?php echo $row['ItemName']; ?></td>
						<td align="right"><?php echo number_format($row['Bprice'],2); ?></td>
						<td align="right"><?php echo number_format($row['Sprice'],2); ?></td>
						<td align="right"><?php echo $row['Pieces']; ?></td>
						<td></td>
					</tr>
					<?php
				}
			}else{
				?>
				<tr>
				<td colspan="5" align="center">No items</td>
				</tr>
				<?php
			}
		?>
	</table>
</body>
<div class="noprint">
	<?php include 'footer.php'; ?>
</div>