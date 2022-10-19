<?php
	//$ip = gethostbyname("www.sasm.sc.ke");
	//echo $ip;exit;
?>

<?php 
		include 'header.php'; 
	$counter = $_SESSION['counter'];
	$employee = $_SESSION['emp'];
	
	$Qry = mysqli_query($conn,"SELECT COUNT(DISTINCT TranNo) AS Num FROM sales");
	$all = mysqli_fetch_assoc($Qry);
	$trans = $all['Num']+1;
	
	if(isset($_POST['transct'])){
		$trans = $_POST['trans'];
		$cash = $_POST['cash'];
		
		$Qry1 = mysqli_query($conn,"INSERT INTO sales (TranNo,Code,Price,Quantity,Sdate,Counter,Employee,StockId)
				SELECT Tno,Code,(((SELECT Sprice FROM stocks WHERE stocks.Code=hive.Code AND Status='Current')/
				(SELECT Pieces FROM stocks WHERE stocks.Code=hive.Code AND Status='Current'))-
				(SELECT Amount FROM discounts WHERE discounts.Code=hive.Code AND Status='Current'))Price,
				COUNT(Code) AS Quantity,NOW(),'$counter','$employee',(SELECT StockId FROM stocks WHERE stocks.Code=hive.Code AND Status='Current')StockId
				FROM hive WHERE Tno='$trans' GROUP BY Code ");
		if(!$Qry1){
			echo "faled" .mysqli_error($conn);
		}else{
			$Qry2 = mysqli_query($conn,"DELETE FROM hive");
			if($Qry2){
				echo mysqli_error($conn);
			}
		}
	}
	
	if(isset($_POST['del_x'])){
		$code = $_POST['code'];
		
		$chec = mysqli_query($conn,"SELECT Quantity FROM hive WHERE Code='$code' AND Quantity>1");
		if(mysqli_num_rows($chec)>0){
			$del = mysqli_query($conn,"UPDATE hive SET Quantity=Quantity-1 WHERE Code='$code'");
			if(!$del){
				echo "faled" .mysqli_error($conn);
			}
		}else{
			$del = mysqli_query($conn,"DELETE FROM hive WHERE Code='$code'");
			if(!$del){
				echo "faled" .mysqli_error($conn);
			}
		}
		
	}
?>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
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
		}
		.result p:hover{
			background: #f2f2f2;
		}
	</style>
</head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
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
<script>
        $(document).ready(function(){
            $("#myBtn").click(function(){
                var code=$("#myInput").val();
				var trans=$("#trans").val();
                $.ajax({
                    url:'insert.php',
                    method:'POST',
                    data:{
                        code:code,
						trans:trans
                    },
                   success:function(data){
					   document.getElementById("myInput").value="";
                       //alert(data);
                   }
                });
            });
        });
    </script>
	<script>
		$(document).keyup(function(e) {    
			if (e.keyCode == 17) { 

			var myModal = new bootstrap.Modal(document.getElementById("myModal"));
			myModal.show();
			}
		});
	</script>
<body onload="closenav()">
	<table class="table" >
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th align='right'>Quantity</th>
			<th align='right'>Price</th>
			<th align="right">Total</th>
			<td></td>
		</tr>
		<tr>
			<?php 
				$tot = 0;
					$Qry = mysqli_query($conn,"SELECT Code,(SELECT ItemName FROM products WHERE products.Code=hive.Code)ItemName,
							(((SELECT Sprice FROM stocks WHERE stocks.Code=hive.Code AND Status='Current')/(SELECT Pieces FROM stocks 
							WHERE stocks.Code=hive.Code AND Status='Current'))-
							(SELECT Amount FROM discounts WHERE discounts.Code=hive.Code AND Status='Current'))Price,
							Quantity FROM hive GROUP BY Code");
					while($row=mysqli_fetch_assoc($Qry)){
						?>
						<form method="post">
						<input type="hidden" name="code" value="<?php echo $row['Code']; ?>">
							<tr>
								<td><?php echo $row['Code']; ?></td>
								<td><?php echo $row['ItemName']; ?></td>
								<td><?php echo $row['Quantity']; ?></td>
								<td align="right"><?php echo number_format($row['Price'],2); ?></td>
								<td align="right"><?php echo number_format($all=$row['Quantity']*$row['Price'],2); $tot +=$all; ?></td>
								<td><input type="image" src="images/remove.png" width="40px" height="30px" alt="Submit" name="del"></td>
							</tr>
						</form>
						<?php
					}
			?>
		</tr>
		<tr>
		<form method="post">
			<td colspan=4 align="left">
				Code.:<div class="search-box">
							<input type="text" autocomplete="off" placeholder="Search item..." name="code" id="myInput" onblur="this.focus()" autofocus />
						<div class="result" ></div>
					</div>
					<input type="hidden" value="<?php echo $trans; ?>" id="trans" name="trans" >
					<input type="submit" id="myBtn" style="display:none" name="s1">
					<script>
					var input = document.getElementById("myInput");
					input.addEventListener("keypress", function(event) {
					  if (event.key === "Enter") {
						event.preventDefault();
						document.getElementById("myBtn").click();
						document.getElementById("myBtnx").click();
					  }
					});
					</script>
			</td>
		</form>
			<td align="right"><b><?php echo number_format($tot,2); ?></b></td>
		</tr>
	</table>

		<script>
			function calculate(){
				//alert('jinga');
				var diff;
				var x = document.getElementById("amount").value;
				var y = document.getElementById("cash").value;
				 diff = y-x;
				 //return diff;
				document.getElementById("change").value=diff;
				if (diff >= 0) {
					//alert('jinga');
					document.getElementById("myBtnx").disabled = false;
				}
			}
		</script>
		<div id="myModal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Payment</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<form method="post">
						<input type="hidden" value="<?php echo $trans; ?>" name="trans" >
						<label>Amount</label>
						<input type="number" name="amount" id="amount" value="<?php echo number_format($tot,2); ?>" readonly>
						<label>Cash</label>
						<input type="number" name="cash" id="cash" onkeyup="calculate()" required autofocus>
						<label>Change</label>
						<input type="number" name="change" id="change" readonly>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Archive</button>
						<button type="submit" class="btn btn-primary" id="myBtnx" name="transct" disabled>Proceed</button></form>
					</div>
				</div>
			</div>
		</div>
</body>
<?php include 'footer.php'; ?>