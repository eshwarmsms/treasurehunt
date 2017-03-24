<?php
    
	mysql_connect("in-cdbr-azure-south-c.cloudapp.net", "bf142daa6c0a1f","97095cdc", "treasurehunt") or die(mysql_error()); //Connect to server
	mysql_select_db("treasurehunt") or die("Cannot connect to database"); //Connect to database
	    
	echo("hello");
    // if($_SERVER["REQUEST_METHOD"] == "POST"){
		// if (!empty($_POST['checklogin'])) {
			session_start();
			$username = "eshwarmsms@gmail.com";
			$password = "eshwar";
			//mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
			//mysql_select_db("first_db") or die("Cannot connect to database"); //Connect to database
			$query = mysql_query("SELECT * from users WHERE email='$username'"); //Query the users table if there are matching rows equal to $username
			$exists = mysql_num_rows($query); //Checks if username exists
			$table_users = "";
			$table_password = "";
			if($exists > 0) //IF there are no returning rows or no existing username
			{
				while($row = mysql_fetch_assoc($query)) //display all rows from query
				{
					$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
					$table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
					echo("$table_users table_password <br>");
				}
				if(($username == $table_users) && ($password == $table_password)) // checks if there are any matching fields
				{
					if($password == $table_password)
					{
						echo("successful login");
						$_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
						header("location: form.php"); // redirects the user to the authenticated home page
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
		// }
	// }
?>