<?php session_start();   
	include 'config/config.php';
		
	?>			
	<html>
	<head>
		<title>Apos</title>
		<link rel="shortcut icon" href="tt.ico">
		<link rel="stylesheet" href="css/topnav.css">
		<link rel="stylesheet" href="css/sidebar.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/form.css">
		<style media="print">
			  @page 
				{
					size:  auto;   /* auto is the initial value */
					margin: 10mm 0mm;  /* this affects the margin in the printer settings */
					max-height: auto;
				}

				html
				{
					background-color: #FFFFFF; 
					margin: 0px;  /* this affects the margin on the html before sending to printer */
				}
			   
				.x{
					/*border: solid 1px blue ;*/
					margin: 0mm 0mm 0mm 0mm; /* margin you want for the content */
					max-height: auto;
					//display:flex;
					position:absolute;
				}
				
				
				@media print{
					.x{
						position:absolute;
						width:100%;
					}
				   .noprint{
					   display:none;
				   }
				}
			</style>
			<style>
				.date{
					display:flex;
					justify-content:space-evenly;
					padding:0 20px;
					height:20px;
				}
			</style>
	</head>		
		<div class="topnav" id="myTopnav">
			  <a style="cursor:pointer" id="myMenu" onclick="openNav()" class="openbtn">&#9776; Open Menu</a> 
			   <a href="logout.php" style="float:right;"><img src="images/log_out.png" alt="LogOut" style="border-radius:5px; width:70px;"></a>
			  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
		</div>
		<script>
			function myFunction() {
			  var x = document.getElementById("myTopnav");
			  if (x.className === "topnav") {
				x.className += " responsive";
			  } else {
				x.className = "topnav";
			  }
			}
		</script>
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onClick="closenav()"><font color="#FF0000" size="5" style="margin-left:200px;">x</font></a>
			  <a href="home.php" class="active">Home</a>

			  <?php
				$rank = $_SESSION['mtu'];
				$grp = mysqli_query($conn,"SELECT GItems,GNames FROM user_rights WHERE User='$rank'");
				$rest = mysqli_fetch_assoc($grp);
				$gnames = explode(',',$rest['GNames']);
				$gitems = explode(',',$rest['GItems']);
				foreach(array_unique($gnames) AS $items){
					$grap = mysqli_query($conn,"SELECT Id,Title FROM menu_group WHERE Id='$items'");
					while($row = mysqli_fetch_assoc($grap)){
					?>
					<button class="dropdown-btn"><?php echo $row['Title'];?>
						<i class="triangle-down"></i>
					</button>
					
						<?php
					foreach(array_unique($gitems) AS $gitem){
					$all = mysqli_query($conn,"SELECT * FROM menu WHERE Title='$items' AND RefId='$gitem' ORDER BY Seqns");
					while($rows=mysqli_fetch_assoc($all)){
						?> 
						<div class="active_def">
							<a href="<?php echo $rows['Href'];?>"><?php echo $rows['Items'];?></a>
						 </div>
						<?php
					}
					}
				}}
			  ?>
		</div>
	</div>
	
<script>
				/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
				var dropdown = document.getElementsByClassName("dropdown-btn");
				var i;

				for (i = 0; i < dropdown.length; i++) {
				  dropdown[i].addEventListener("click", function() {
				  this.classList.toggle("active");
				  var dropdownContent = this.nextElementSibling;
				  if (dropdownContent.style.display === "block") {
				  dropdownContent.style.display = "none";
				  } else {
				  dropdownContent.style.display = "block";
				  }
				  });
				}
				</script>
				<script>
					function openNav() {
						document.getElementById("mySidenav").style.width = "250px";
					}

					window.addEventListener('click', function(e){   
					  if (!document.getElementById('mySidenav').contains(e.target) && !document.getElementById('myMenu').contains(e.target)){
						// Clicked in box
					   document.getElementById("mySidenav").style.width = "0px";  
					  } else{
					   
					 // document.getElementById("mySidenav").style.width = "0px";
					  }
					});

					</script>
					<script>
					function closenav() {
						document.getElementById("mySidenav").style.width = "0px";
					}
					</script>
					<script>     
					if ( window.history.replaceState ) {
					  window.history.replaceState( null, null, window.location.href );
					} 
				</script>
				<script>
				function checkTime () {
					var stime = document.getElementById("start").value;
					var etime = document.getElementById("end").value;
				  if(stime<etime){
				   return true
				  }
				  else{
				   document.getElementById("end").value="";
				   document.getElementById("note").style.display='Block';
				  }
				}
				</script>