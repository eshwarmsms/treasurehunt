<html>
<head>    
    <title>Treasure Hunt</title>
    <link rel="stylesheet" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        session_start(); //starts the session
        if($_SESSION['user']){ //checks if user is logged in
        }
        else{
            header("location:index.php"); // redirects if user is not logged in
        }
        $user = $_SESSION['user']; //assigns user value
            
        mysql_connect("in-cdbr-azure-south-c.cloudapp.net", "bf142daa6c0a1f","97095cdc", "treasurehunt") or die(mysql_error()); //Connect to server
        mysql_select_db("treasurehunt") or die("Cannot connect to database"); //Connect to database

        $query = mysql_query("SELECT * from users WHERE email='$user'"); //Query the users table if there are matching rows equal to $username
        $exists = mysql_num_rows($query); //Checks if username exists
        if($exists > 0) //IF there are no returning rows or no existing username
        {
            while($row = mysql_fetch_assoc($query)) //display all rows from query
            {
                $table_current = $row['current'];
            }
            if($table_current < 31){
                header("location:hunt.php");
            }
        }
        else
        {
            header("location:hunt.php");
        }

    ?>
    <div id="frame">
        <a href="/leaderboard.php">LEADERBOARD</a>
        <a href="/logout.php">LOGOUT</a>
        <h1>CONGRATULATIONS, <strong><?php echo($user) ?></strong></h1>
        <form>
            <img src="images/congrats.jpeg" alt="congrats">
        </form>
    </div>
</body>
</html>
