<?php
	// Start Session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- enables appropriate screen size adjustments-->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"/>
    <title>Vapor-Tek</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="/bootstrap/css/custom1.css"   rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"><!-- stylesheet for social media icons -->
    <script type="text/javascript" src="../bootstrap/js/custom.js"></script>
	
	<!-- Custom Links * * * * * * * * * * * * * * * * * * * * -->
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/custom.css">
	<!-- link rel="stylesheet" type="text/css" href="css/custom1.css" -->
		
	</head>
  </head>
 <body>
	  <!--  jQuery function - if 'callback' checkbox ticked = display additional input for contact number -->
	<script>
	$(document).ready(function(){
			$('input[type="checkbox"]').click(function(){
				if($(this).attr("value")=="yes"){
					$("#add-on").toggle();
				}
			});
		});
	</script>

<!-- Header - Logo of Vapor-Tek * * * * * * * * * * * * * * * * * * * * -->
	<div class="container" id="company-logo">
		<div id="header1"> <!-- Vapor-Tek Logo -->
		<div class="container-fluid"> 
			<img id="brand-image"  src="../sources/logoBlue.png" alt="Website Logo" width="208" height="40" />
		</div>
		</div>
		<div id="header2"> <!-- Border 1 -->
		</div>
		<div id="header3"> <!-- Border 2 -->
		</div>		
	</div>


	<div id="main-container">

<!-- Navigation Stacked * * * * * * * * * * * * * * * * * * * * -->
		<div class="container">

			<!-- Static navbar -->
			<nav class="navbar navbar-default" id="on-scroll-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><i>The Anti-Corrosion Specialists</i></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class="active"><?php if(isset($_SESSION['username'])){
							echo "<a href='logout.php'>" . "Home</a>";}?></li>
								</ul>
							</li>
						<!-- Login details -->
						<ul class="nav navbar-nav navbar-right">
							<li><?php if(isset($_SESSION['username'])){
							echo "<a href='logout.php'>".$_SESSION['username']."(logout)</a>";}?></li>
							<a href="#"><img src="../sources/facebook.png" height="44" width="44" class="social-media-icons"></a>
							<a href="#"><img src="../sources/twitter.png" height="44" width="44" class="social-media-icons"></a>
							<a href="http://www.iso9001.com/"><img src="../sources/iso9001_3.png" height="44" width="44" class="social-media-icons"></a>
							<!--a href="#"><img src="sources/instagram.png" height="40" width="40" class="social-media-icons"></a-->
						</ul>
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
			
			<?php
				if(isset($_SESSION['username'])) // Check if the session variable username exists. It only exists if the user has been validated.
				{
					echo "Welcome ".$_SESSION['username']."<br/>";
					echo "You are now Logged in.<br/><br/>";
				}
				else
				{
					echo "You must be logged in.<br/>";
					echo "<a href='../index.html'>Login</a>";
				}
				
			?>
		
<!--======================================================================================= -->
<!-- start of content -->
		<!-- Search Engine Bar for logged in users to search for contact details -->
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div id="custom-search-input">
							<form action="" method="POST">
							<div class="input-group col-md-12">
									<input type="text" name="name" class="form-control input-lg" placeholder="Search by the name" />
									<span class="input-group-btn">
										<button class="btn btn-info btn-lg" name="btnSubmit" type="submit">
											<i class="glyphicon glyphicon-search"></i>
										</button>
									</span>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<br/>
			<form action="" method="POST">
				<div>
					<button class="btn btn-info btn-lg" name="btnAll" type="submit">Display All Data</button>
				</div>
			</form>
		
		<!-- PHP for the search bar to see of certain contacts are in the database -->
		<?php
			if(isset($_POST['btnSubmit'])) {
			// if(isset($_GET['Go'])){}
			 if(isset($_POST['name'])){
				if(preg_match("/^[A-Za-z]+$/", $_POST['name'])){
					$name= $_POST['name'];
				// Connect to the database
				$dbserver = "160.153.16.19";
				$dbusername = "redhouse2k16";
				$dbuserpassword = "redhouse123";
				$dbname = "vaportek_db";
				$mysqli = mysqli_connect($dbserver,$dbusername,$dbuserpassword,$dbname) or die("Couldn't connect to the dbserver.". mysqli_error());
				
				// Connection for using xampp database for testing the database
				// $dbserver = "localhost";
				// $dbusername = "root";
				// $dbuserpassword = "";
				// $dbname = "vaportek_db";
				// $mysqli = mysqli_connect($dbserver,$dbusername,$dbuserpassword,$dbname) or die("Couldn't connect to the dbserver.". mysqli_error());
		
				// Query the database table
				$sqli= "SELECT * FROM contact WHERE name LIKE '%{$name}%'";
				
				// Run the query against the mysqli query function
				$result= mysqli_query($mysqli, $sqli);
				
				echo "<br /><h3 style='text-align:center'>Seach Results</h3><br />";
				echo "<table width='1200'>";
				echo "<tr>";
				echo "<th>Contact_ID</th>";
				echo "<th>Date</th>";
				echo "<th>Name</th>";
				echo "<th>Email</th>";
				echo "<th>Message</th>";
				echo "<th>IP</th>";
				echo "<th>Latitude</th>";
				echo "<th>Longitude</th>";
				echo "<th>Call_Back</th>";
				echo "<th>Contact_Number</th>";
				echo "</tr>";
				
				// Create while loop and loop through result set
				while($row= mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$contact_id= $row['contact_id'];
					$date= $row['date'];
					$name= $row['name'];
					$email= $row['email'];
					$message= $row['message'];
					$ip= $row['ip'];
					$latitude= $row['latitude'];
					$longitude= $row['longitude'];
					$call_back= $row['call_back'];
					$contact_number= $row['contact_number'];
					
									// Display the result of the array
				
				echo "<tr>";
				echo "<td>" . $contact_id . "</td>";
				echo "<td>" . $date . "</td>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $email . "</td>";
				echo "<td>" . $message . "</td>";
				echo "<td>" . $ip . "</td>";
				echo "<td>" . $latitude . "</td>";
				echo "<td>" . $longitude . "</td>";
				echo "<td>" . $call_back . "</td>";
				echo "<td>" . $contact_number . "</td>";
				echo "</tr>";
		
				}
						echo "</table>";
			 }
			}
			else {
				echo "<p>Please enter a search query</p>";
			}
		}
		?>
		
		<!-- PHP for Search All Button that produces all the info from the contacts database -->
	<?php
			if(isset($_POST['btnAll'])) {
			// if(isset($_GET['Go'])){}
		// Connect to the database
		$dbserver = "160.153.16.19";
		$dbusername = "redhouse2k16";
		$dbuserpassword = "redhouse123";
		$dbname = "vaportek_db";
		$mysqli = mysqli_connect($dbserver,$dbusername,$dbuserpassword,$dbname) or die("Couldn't connect to the dbserver.". mysqli_error());
		
		// Connect to the database using xampp
		// $dbserver = "localhost";
		// $dbusername = "root";
		// $dbuserpassword = "";
		// $dbname = "vaportek_db";
		// $mysqli = mysqli_connect($dbserver,$dbusername,$dbuserpassword,$dbname) or die("Couldn't connect to the dbserver.". mysqli_error());
				
     $sqlistatement = "SELECT * FROM contact"; 
       $sqli_result = mysqli_query($mysqli, $sqlistatement) or die("<<STEP 4 IS DEAD!>> Couldn't execute the SQL SELECT statement");
     //  Process the information retrieved from the database and display to the user's browser in table format
	echo "<table>";
	echo "<br /><h3 style='text-align:center'>Seach Results</h3><br />";
				echo "<table width='1200'>";
				echo "<tr>";
				echo "<th>Contact_ID</th>";
				echo "<th>Date</th>";
				echo "<th>Name</th>";
				echo "<th>Email</th>";
				echo "<th>Message</th>";
				echo "<th>IP</th>";
				echo "<th>Latitude</th>";
				echo "<th>Longitude</th>";
				echo "<th>Call_Back</th>";
				echo "<th>Contact_Number</th>";
				echo "</tr>";
       while ($row = mysqli_fetch_array($sqli_result)) 
	   { 
         $contact_id = $row[0]; 
		 $date = $row[1];
         		$name = $row[2]; 
        			 $email = $row[3]; 
        				 $message = $row[4]; 
						 $ip = $row[5]; 
		 			$latitude = $row[6]; 
		 		$longtitude = $row[7]; 
	     		$callback = $row[8]; 
		 $contact_number = $row[9]; 

	echo"<tr>";

		echo "<td> $contact_id </td><td> $date </td><td> $name </td><td> $email </td><td> $message </td><td> $ip </td><td> $latitude </td><td> $longtitude </td><td> $callback </td><td> $contact_number </td>\n";

		echo "</tr>";

	   }


    // Free up any memory holding the database records
     mysqli_free_result($sqli_result);
				}
		echo "</table>"

		?>
		<br /><br />
<!-- =============================================================================================================================================== -->
<!-- end of first content  -->    
<!-- Footer Details * * * * * * * * * * * * * * * * * * * * -->
	<div class="container">
		<footer>
			<p>
				<strong>CONTACT DETAILS:</strong>
				<br><br>
				<i>
					<strong>Address:</strong> Vapor-Tek Limited, Fairclough Street, Bolton, Lancashire, BL3 2AF, United Kingdom <br>
					<strong>Telephone:</strong> +44 (0)1204 521795 <br>
					<strong>Email:</strong> enquiries@vapor-tek.co.uk
				</i>
			</p>
			<p> &copy; 2016 Vapor-Tek: Created by Redhouse Associates (University of Bolton)</p>
		</footer> <!-- End Footer -->
	</div>
   <!-- contact modal ===================================================================================================================================================== -->

   <div class="modal fade" id="contact" role="dialog">

   		<div class="modal-dialog">

        	<div class="modal-content">

            		<form class="form-horizontal" action="contact.php" method="POST" onsubmit="return check()">

            			<div class="modal-header">

                			<h4>Contact</h4>

               			</div>

						<div class="modal-body">                      
                			
							<div class="form-group">
                            	
								<label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                	<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name here..." />
								</div>
								
							</div>                       
							<div class="form-group">
							
                            	<label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                	<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address..." />
								</div>
								
							</div>                       
							<div class="form-group">
							
                            	<label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-10">
                                	<textarea name="message" id="message" class="form-control" rows="4" maxlength="100" placeholder="Your message.." ></textarea>
								</div>
								
							</div>
							<div class="form-group">
							
								<label for="message" class="col-sm-2 control-label">Request callback</label>
                                <div class="col-sm-2">
								<input type="checkbox" name="callback" id="callback" value="yes" class="form-control"/>
								</div>
								
								<div id="add-on" style="display:none;">
									<br /><br /><br />
									<label for="message" class="col-sm-2 control-label"></label>
									<div class="col-sm-10">
										<input type="text" name="number" id="number" class="form-control" placeholder="Please enter a contact number..." />
									</div>
								</div>
								
							</div>
							
						</div>

                     <div class="modal-footer">

            			<a class="btn btn-primary" data-dismiss="modal">Close</a>

                        <button type="submit" class="btn btn-primary">Send</button>

                     </div>

                  </form>

              </div>

         </div>

	</div>
    <!-- login modal ===================================================================================================================================================== -->



 <div class="modal fade" id="login" role="dialog">

   		<div class="modal-dialog">

        	<div class="modal-content">

            		<form class="form-horizontal" action="login.php" method="POST" onsubmit="return check1()">

            			<div class="modal-header">

                			<h4>Admin Login</h4>

						</div>
              			
               			<div class="modal-body">                      
                			<div class="form-group">
                            	<label for="name" class="col-sm-2 control-label">User ID</label>
                                <div class="col-sm-10">
                                	<input type="text" class="form-control" name="userId" id="userId"  placeholder="User ID" maxlength="40"  />
                				</div>

            				</div>                       
						</div>
                         <div class="form-group">

                            	<label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">

                                	<input type="password" class="form-control" name="userPw" id="userPw"  placeholder="Your password" >

                			</div>

            			</div>                       

                     <div class="modal-footer">

            			<a class="btn btn-primary" data-dismiss="modal">Close</a>

                        <button type="submit" class="btn btn-primary">Login</button>

                     </div>

                  </form>

              </div>

         </div>

  </div>     

	<!-- /LoginForm -->

	

	<!-- Get the modal -->

	<script>

	var modal = document.getElementById('login');

	

	<!-- When the user clicks anywhere outside the modal, close it -->

	window.onclick = function(event) {

		if (event.target == modal) {

			modal.style.display = "none";

		}

	}

	</script>


<!-- JAVASCRIPT / JQUERY * * * * * * * * * * * * * * * * * * * * -->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="../javascript/custom.js"></script> <!-- Custom JavaScript -->
</body>
</html>