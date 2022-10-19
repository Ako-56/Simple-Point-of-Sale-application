<div class="noprint">
	<?php include 'header.php'; ?>
</div>
<?php
		$employee = $_SESSION['emp'];
		
		function emptySession() {
			$prod =''; $_SESSION['prod']='';
			$tno='';$_SESSION['tno']='';
			$reason =''; $_SESSION['reason']='';
			$condition =''; $_SESSION['condition']='';
			$pieces =''; $_SESSION['pieces']='';
			$id =''; $_SESSION['id']='';
		}
		emptySession();
		
		$_SESSION['d1']=date('d/m/Y');
		$_SESSION['d2']=date('d/m/Y');
		
	if(isset($_POST['save'])){
		$prod = $_POST['prod'];
		$tno = $_POST['tno'];
		$reason = $_POST['reason'];
		$condition = $_POST['condition'];
		$pieces = $_POST['pieces'];
		$id = $_POST['id'];		
		
		$Qry4 = mysqli_query($conn,"SELECT Id FROM returnin WHERE Id='$id'");
		if(mysqli_num_rows($Qry4)>0){
			$Qry5 = mysqli_query($conn,"UPDATE returnin SET Code='$prod',Pieces='$pieces',Reason='$reason',Conditions='$condition',TranNo='$tno' WHERE Id='$id'");
			if(!$Qry5){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry6 = mysqli_query($conn,"INSERT INTO returnin (Code,Pieces,Reason,TranNo,Conditions,AuthorizedBy,Sdate) 
			VALUES('$prod','$pieces','$reason','$tno','$condition','$employee',NOW())");
			if(!$Qry6){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}
	}
	
	if(isset($_POST['edit'])){
		$id = $_POST['edit'];
		
		$Qry3 = mysqli_query($conn,"SELECT * FROM returnin WHERE Id='$id'");
		$row = mysqli_fetch_assoc($Qry3);
		$prod = $row['Code'];
		$tno = $row['TranNo'];
		$reason = $row['Reason'];
		$condition = $row['Conditions'];
		$pieces = $row['Pieces'];
		$id = $row['Id'];
		
		$_SESSION['prod'] = $prod;
		$_SESSION['tno'] = $tno;
		$_SESSION['reason'] = $reason;
		$_SESSION['condition'] = $condition;
		$_SESSION['pieces'] = $pieces;
		$_SESSION['id'] = $id;
	}
		$prod = $_SESSION['prod'];
		$tno=$_SESSION['tno'];
		$reason = $_SESSION['reason'];
		$condition = $_SESSION['condition'];
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
			
		.search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
		}
		.search-box input[type="text"]{
			height: 32px;
			padding: 5px 10px;
			border: 1px solid #CCCCCC;
			font-size: 14px;
		}
		.result{
			position: absolute;        
			z-index: 999;
			top: 100%;
			left: 0;
		}
		.search-box input[type="text"], .result{
			width: 100%;
			box-sizing: border-box;
		}
		/* Formatting result items */
		.result p{
			margin: 0;
			padding: 7px 10px;
			border: 1px solid #CCCCCC;
			border-top: none;
			cursor: pointer;
			background: #f2f2f2;
		}
		.result p:hover{
			background: #f2f2f2;
		}
	
	</style>
</head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<body onload="closenav()">
	<div class="cont">
		<div class="noprint">
			<form method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" >
				<label>Transaction No.:</label>
				<div class="search-box">
							<input type="text" autocomplete="off" placeholder="Search item..." name="tno" id="myInput" required />
						<div class="result" ></div>
					</div>
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
				<label>Reason</label>
				<textarea name="reason" required><?php echo $reason; ?>
				</textarea>
				<label>Pieces</label>
				<input type="text" name="pieces" value="<?php echo $pieces; ?>" required autocomplete="off">
				<label>Condition</label>
				<select name="condition" required>
					<option value="">Select Status</option>
					<?php 
					$conditn = array('Faulty','Not Faulty');
					foreach($conditn AS $conts){
						?>
						<option value="<?php echo $conts?>" <?php if($condition==$conts){?>selected<?php } ?>><?php echo $conts; ?></option>
						<?php
					}
					?>
				</select>				
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
			<caption style="background:gray; color:#fff;"><b>RETURNED IN ITEMS FOR THE PERIOD:&nbsp;<?php echo $d1 ?>&nbsp;TO:&nbsp; <?php echo $d2 ?></b></caption>
				<tr>
					<th>Item</th>
					<th>Pieces</th>
					<th>Reason</th>
					<th></th>
				</tr>
				<?php
					 $Qry2 = mysqli_query($conn,"SELECT Id,Pieces,Reason,(SELECT ItemName FROM products WHERE products.Code=returnin.Code)Item FROM returnin
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
									<td><input type="checkbox" value="<?php echo $row['Id']; ?>" name="edit" onclick="submit()"></td>
								</tr>
							 </form>
							 <?php
						 }
					 }else{
						 ?>
						 <tr>
						 <td colspan=4 align="center">No Returned Items</td>
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