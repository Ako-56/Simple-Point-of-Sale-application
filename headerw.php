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
	</head>		
		<div class="topnav" id="myTopnav">
			  <a style="cursor:pointer" id="myMenu" onclick="openNav()" class="openbtn">&#9776; Open Menu</a> 
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
			  <a href="index.php" class="active">Home</a>
				
			  <button class="dropdown-btn">Settings		
			  <i class="triangle-down"></i>
			  </button>
			  <div class="active_def">
				<a href="menu.php">Add Menu Groups</a>
				<a href="assign.php">Assign Rights</a>
			  </div>
			  
			  <button class="dropdown-btn">Employee Settings		
				  <i class="triangle-down"></i>
			  </button>
			  <div class="active_def">
				<a href="counter.php">Add Counter</a>
				<a href="operators.php">Add Operator</a>
			  </div>
			  
			<button class="dropdown-btn">Stock Settings				
			  <i class="triangle-down"></i>
			</button>
			<div class="active_def">
				<a href="categories.php">Item Categories</a>
				<a href="discount.php">Discounts & Offers</a>
				<a href="suppliers.php">Add Suppliers</a>
				<a href="items.php">Add Sale Items</a>
				<a href="stocktake.php">Add Stock</a>
				<a href="stocktrail.php">Stock Trail/Reorder Report</a>
				<a href="rout.php">Return Outwards</a>
				<a href="retnin.php">Return Inwards</a>
				<a href="catalogue.php">Products Catalogue</a>
			</div>
			<button class="dropdown-btn">Sales				
			  <i class="triangle-down"></i>
			</button>
			<div class="active_def">
				<a href="sale.php">Make Sales</a>
			</div>

			<button class="dropdown-btn" style="background-color:#000000" >Reports				
			  <i class="triangle-down"></i>
			</button>
			<div class="active_def">
				<a href="peritem.php">Sales Per Item Report</a>
				<a href="profit.php">Profit & Loss</a>
				<a>&nbsp;</a>
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
					