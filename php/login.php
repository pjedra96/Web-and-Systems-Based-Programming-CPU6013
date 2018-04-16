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
    <link href="../bootstrap/css/custom1.css"   rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"><!-- stylesheet for social media icons -->
    <script type="text/javascript" src="../bootstrap/js/custom.js"></script>
    <!-- Javascript to redirect user to home page 5 seconds after form is submitted -->
    <script type="text/javascript">
           /* function Redirect() {
               window.location="../index.html";
            }
            setTimeout('Redirect()', 4000); */
    </script>

  </head>
  <body>
  <?php
		/* login form script to go here ============================================================================================================= */
		echo "<h3 align=center><i>Login form link running</i></h3>";
	
		$username = $_POST['userId'];
		$password = $_POST['userPw'];
		
		// Setting up a connection with a db server - variables with details of the server & mysqli object
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
		
		// Gets information of registered users and finds user match
		$result = mysqli_query($mysqli, "Select * from users where username='$username' AND password='$password'");
		
		// Check of $query holds one record, if it does then the user's details have been found and the user is already a registered member.
		$row_count = mysqli_num_rows($result);		
		if ($row_count==1 && $row_count < 2)
		{
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header ("Location: secure.php"); // Send the user to the secure webpage
		}
		else{
			header("Refresh: 5; URL=../index.html"); // For incorrect login attempts
			echo "Login Failed. Please enter correct login details<br />";
			echo "Redirecting back to Home Page...";
		}
?>	
 </body>
</html>