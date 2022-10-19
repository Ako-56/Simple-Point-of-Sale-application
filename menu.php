<?php include 'header.php'; ?>
<?php 
	$_SESSION['grp'] ='';
	$_SESSION['ied'] = '';
	$_SESSION['edit'] = '';$_SESSION['grop'] =''; $_SESSION['gitem'] = '';$_SESSION['href'] = '';$_SESSION['sqnc'] =''; 
	if(isset($_POST['save'])){
		$title = $_POST['title'];
		
		$Qry = mysqli_query($conn,"SELECT Title FROM menu_group WHERE Title='$title'");
		if(mysqli_num_rows($Qry)>0){
			echo "already exist"; 
		}else{
			$addd = mysqli_query($conn,"INSERT INTO menu_group(Title) VALUES ('$title') ");
			if(!$addd){
				echo "failed" .mysqli_error($conn);
			}
		}
	}
	
	if(isset($_POST['add'])){
		$group = $_POST['grop'];
		$gitem = $_POST['gitem'];
		$href = $_POST['href'];
		$order = $_POST['order'];
		
		$chek= mysqli_query($conn,"SELECT Items FROM menu WHERE Items='$gitem'");
		if(mysqli_num_rows($chek)>0){
			echo "Already Exist";
		}else{
			$Qrey = mysqli_query($conn,"INSERT INTO menu (Title,Items,Href,Seqns) VALUES ('$group','$gitem','$href','$order')");
			if(!$Qrey){
				echo "failed" .mysqli_error($conn);
			}
		}
	}
	
	if(isset($_POST['update'])){
		$group = $_POST['grop'];
		$gitem = $_POST['gitem'];
		$href = $_POST['href'];
		$order = $_POST['order'];
		$ids = $_POST['ids'];
		
			$Qrey = mysqli_query($conn,"UPDATE menu SET Title='$group',Items='$gitem',Href='$href',Seqns='$order' WHERE RefId = '$ids'");
			if(!$Qrey){
				echo "failed" .mysqli_error($conn);
			}
	}
	
	if(isset($_POST['editg'])){
		$code = $_POST['editg'];
		
		$Qva = mysqli_query($conn,"SELECT * FROM menu_group WHERE Id='$code'");
		$reslt = mysqli_fetch_assoc($Qva);
		$grp = $reslt['Title'];
		$ied = $reslt['Id'];
		$_SESSION['grp'] = $grp;
		$_SESSION['ied'] = $ied;
	}
	$grp = $_SESSION['grp'];
	$ied = $_SESSION['ied'];
	
	if(isset($_POST['updt'])){
		$title = $_POST['title'];
		$id = $_POST['id'];
		
		$Qry = mysqli_query($conn,"UPDATE menu_group SET Title='$title' WHERE Id='$id'");
			if(!$Qry){
				echo "failed" .mysqli_error($conn);
			}
		}
	
	if(isset($_POST['edit'])){
		$code = $_POST['edit'];
		
		$fnd = mysqli_query($conn,"SELECT * FROM menu WHERE RefId='$code'");
		$result = mysqli_fetch_assoc($fnd);
		$grop = $result['Title'];
		$gitem = $result['Items'];
		$href = $result['Href'];
		$order = $result['Seqns'];
		
		$_SESSION['edit'] = $code;
		$_SESSION['grop'] = $grop;
		$_SESSION['gitem'] = $gitem;
		$_SESSION['href'] = $href;
		$_SESSION['sqnc'] = $order;
		}
		$grop = $_SESSION['grop'];
		$gitem = $_SESSION['gitem'];
		$href = $_SESSION['href'];
		$order = $_SESSION['sqnc'];
		$Edt = $_SESSION['edit'];
?>
<head>
	<title>Menu</title>
	<style>
		form {
			  width: 100%;
			  
			}
			label,
			input{
			  display: inline-block;
			}

			label {
			  width: 40%;
			  text-align: right;
			}

			label+input {
			  width: 40%;
			  margin: 1% 10% 0 2%;
			}

			input+input {
			  float: right;
			}
			textarea,select{
			  border-radius: 4px;
			  box-sizing: border-box;
			  width:40%;
			   margin: 1% 10% 0 2%;
			}
			.bio {
			  display: grid;
			  grid-template-columns: 40% 55%;
			  justify-content:center;
			  grid-gap: 5px;
			  padding: 1px;
			}

			.bio > div {
			  padding: 2px 0;
			  font-size: 20px;
			}
		.ghed{
			background-color:#00cc99;
			color:white; 
			text-align:center;
			padding:auto 10px;
			font-weight:bold;
		}
		.fixTableHead_1 {
			  overflow-y: auto;
			  height: 450px;
			}
			.fixTableHead_1 thead th {
			  position: sticky;
			  top: 0;
			}
	</style>
</head>
	<script>     
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			} 
		</script>
<body onload="closenav()">
	<div class="bio">
		<div>
			<div class="ghed" style="background-color:#999900; font-size:15px;"><br></div>
			<form method="post">
				<input type="hidden" value="<?php echo $ied; ?>" name="id" >
				<label>Group Title</label>
				<input type="text" value="<?php echo $grp; ?>" name="title" required autocomplete="off">
				<label>&nbsp;</label><?php if($grp == ''){ ?><input type="submit" value="Save" name="save" style="width:100px;background-color:green;color:white;border-radius:4px;">
					<?php }else{?><input type="submit" value="Update" name="updt" style="width:100px;background-color:green;color:white;border-radius:4px;"><?php } ?>
			</form>
			<div class="ghed" style="background-color:#999900; font-size:15px;"><br></div>
			<form method="post">
				<input type="hidden" value="<?php echo $Edt; ?>" name="ids" >
				<label>Menu Group</label>
				<select name="grop" required>
					<option value=''>SELECT GROUP</option>
					<?php 
						$qry = mysqli_query($conn,"SELECT Id,Title FROM menu_group");
						while($rows=mysqli_fetch_assoc($qry)){
							?>
						<option value="<?php echo $rows['Id']; ?>"<?php if($rows['Id']==$grop){?>selected<?php } ?>><?php echo $rows['Title']; ?></option>
						<?php
						}
					?>
				</select>
				<label>Group Item</label>
				<input type="text" value="<?php echo $gitem; ?>" name="gitem" required autocomplete="off">
				<label>Href</label>
				<input type="text" value="<?php echo $href; ?>" name="href" required autocomplete="off">
				<label>Order</label>
				<input type="number" value="<?php echo $order; ?>" name="order" required autocomplete="off">
				<label>&nbsp;</label><?php if($Edt == ''){ ?><input type="submit" value="Add" name="add" style="width:100px;background-color:green;color:white;border-radius:4px;">
					<?php }else{?><input type="submit" value="Update" name="update" style="width:100px;background-color:green;color:white;border-radius:4px;"><?php } ?>
			</form>
		</div>
		<div>
			<div class="fixTableHead_1">
				<table width="100%">
					<?php
						$grp = mysqli_query($conn,"SELECT * FROM menu_group");
						while($row = mysqli_fetch_assoc($grp)){
							?>
							<form method="post">
								<tr>
									<th align="left"><?php echo $row['Title'];?></th>
									<th align="right"><input type="radio" value="<?php echo $row['Id']; ?>" name="editg" onclick="submit()"
													<?php if($ied == $row['Id']){ ?>checked="checked" <?php } ?>>Edit</th>
								</tr>
							</form>
								<?php
							$all = mysqli_query($conn,"SELECT * FROM menu WHERE Title={$row['Id']} ORDER BY Seqns");
							while($rows=mysqli_fetch_assoc($all)){
								?> 
								<form method="post">
									<tr class="active_def" style="color:black;">
										<td><?php echo $rows['Items'];?></td>
										<td><input type="radio" value="<?php echo $rows['RefId']; ?>" name="edit" onclick="submit()"
													<?php if($Edt == $rows['RefId']){ ?>checked="checked" <?php } ?>>Edit</td>
									 </tr>
								</form>
								<?php
							}
						}
					  ?>
				</table>
			</div>
		</div>
	</div>
</body>