<?php include 'header.php';
include 'autoz.php'; ?>
<?php
		function emptySession() {
			$_SESSION['name']='';
			$_SESSION['code']='';
			$_SESSION['location']='';
		}
		emptySession();
		
	if(isset($_POST['add'])){
		$counter = $_POST['counter'];
		$code = $_POST['code'];
		$location = $_POST['location'];
		
		$table = 'counters';
		$cols = ['Name','Location'];
		//$columns = implode(',',$cols);
		//echo $columns; exit;
		$vals = ['\''.$counter.'\'','\''.$location.'\''];
		//$values = implode(',',$vals);
		//echo $values; exit;
		
		$chek = mysqli_query($conn,"SELECT Code FROM counters WHERE Code='$code'");
		if(mysqli_num_rows($chek)>0){
			$Qry4 = mysqli_query($conn,"UPDATE counters SET Name='$counter',Location='$location' WHERE Code='$code'");
			if(!$Qry4){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry1 =Insert_Query($conn,$table,$columns,$values);
			if(!$Qry1){
				echo $Qry1 .mysqli_error($conn);
			}else{
				emptySession();
			}
		}
		
	}
	
	if(isset($_POST['edit'])){
		$code=$_POST['edit'];
		
		$Qry3 = mysqli_query($conn,"SELECT Code,Location,Name FROM counters WHERE Code = '$code'");
		$row = mysqli_fetch_assoc($Qry3);
		$counters = $row['Name'];
		$code = $row['Code'];
		$location = $row['Location'];
		
		$_SESSION['name']=$counters;
		$_SESSION['location']=$location;
		$_SESSION['code']=$code ;
	}
		$counters= $_SESSION['name'];
		$location = $_SESSION['location'];
		$code = $_SESSION['code'];
	
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
				width:80%;
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
				<input type="hidden" value="<?php echo $code ?>" name="code">
				<label>Counter Name.:</label>
				<input type="text" name="counter" value="<?php echo $counters ?>" autocomplete="off" required>
				<label>Counter Location.:</label>
				<input type="text" name="location" value="<?php echo $location ?>" autocomplete="off" required>
				<label>&nbsp;</label><input type="submit" value="Save" name="add" >
			</form>
		</div>
		<div>
			<table class="table">
				<tr>
					<th align="left">Name</th>
					<th align="left">Location</th>
					<th></th>
				</tr>
				<?php 
					$Qry2= mysqli_query($conn,"SELECT Code,Name,Location FROM counters");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Name']; ?></td>
									<td><?php echo $row['Location']; ?></td>
									<td><input type="checkbox" name="edit" value="<?php echo $row['Code'];?>" onclick="submit()"></td>
								</tr>
							</form>
						<?php	
						}
					}else{
						?>
						<tr><td colspan="3"></td></tr>
						<?php
					}
				?>
				
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php' ?>