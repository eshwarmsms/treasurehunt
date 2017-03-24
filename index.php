<!DOCTYPE HTML>
<html>
<head>
	<style>
		input[type=submit] , [type=reset]{
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 16px 32px;
			text-decoration: none;
			margin: 4px 2px;
			cursor: pointer;
		}
		#frame{
			
			margin-right: auto;
			margin-left: auto;
			text-align:center;
			max-width:800px;
			padding:80px;
			box-shadow: 0 8px 6px -6px black;
			background-color: wheat;
		}
		body{
			background-color: #B6C5D0;
			
		}
		img{
			max-width:50%;
			max-height:50%;

		}

		h1 {background-color:black; color:white; text-align:center;}
		#footer {background-color:black; color:white; clear:both; text-align:center; padding:5px;
		}
		form{
			background-color:#484E53;font-family:cooper;font-size: 20px; float:center;border:2px solid green;box-shadow: 0 8px 6px -6px black;
		}
	</style>

	<title>Treasure Hunt</title>
</head>
<body>
<?php
    
	mysql_connect("in-cdbr-azure-south-c.cloudapp.net", "bf142daa6c0a1f","97095cdc", "treasurehunt") or die(mysql_error()); //Connect to server
	mysql_select_db("treasurehunt") or die("Cannot connect to database"); //Connect to database
    if($_SERVER["REQUEST_METHOD"] == "POST"){
		if (!empty($_POST['login'])) {
			session_start();
			$username = $_POST["logusername"];
			$password = $_POST["logpassword"];
			$query = mysql_query("SELECT * from users WHERE email='$username'"); //Query the users table if there are matching rows equal to $username
			$exists = mysql_num_rows($query); //Checks if username exists
			$table_users = "";
			$table_password = "";
			if($exists > 0) //IF there are no returning rows or no existing username
			{
				while($row = mysql_fetch_assoc($query)) //display all rows from query
				{
					$table_users = $row['email']; // the first username row is passed on to $table_users, and so on until the query is finished
					$table_password = $row['pass']; // the first password row is passed on to $table_users, and so on until the query is finished
					// echo("$table_users $table_password <br>");
				}
				if(($username == $table_users) && ($password == $table_password)) // checks if there are any matching fields
				{
					if($password == $table_password)
					{
						echo("successful login");
						$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
						header("location: hunt.php"); // redirects the user to the authenticated home page
					}
						
				}
				else
				{
					Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
					//Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
				}
			}
			else
			{
				Print '<script>alert("Incorrect Username!");</script>'; //Prompts the user
				//Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
			}
		}
	}
?>

	<div id="frame">
		<h1>WELCOME TO TREASURE HUNT</h1>
		<form method="post" action="index.php" name="ContactForm">
			<p>Email: <input type="text" size="65" name="logusername"></p>
			<p>Password: <input type="password" size="65" name="logpassword"></p>
			<p><input type="submit" value="Login" name="login">
			<input type="reset" value="Reset" name="reset"></p>
		</form>
	</div>
</body>
</html>
