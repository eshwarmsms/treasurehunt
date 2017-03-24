<html>
<head>    
    <title>Treasure Hunt</title>
    <style>
    
        @media (width: 500px){
            form{
                font-size: 15px; 
            }
            #frame{
                
			    padding:20px;
            }
        }
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

		h1 {
            background-color:black; 
            color:white; 
            text-align:center;}
		#footer {
            background-color:black; 
            color:white; clear:both; 
            text-align:center; 
            padding:5px;
		}
		form{
            /*color: white;*/
			background-color:#484E53;
            min-height: 60px;
            font-family:cooper;
            float:center;
            border:2px solid green;
            box-shadow: 0 8px 6px -6px black;
		}
        #logout{
            right: 10px;
        }
    </style>
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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['hunt'])){
        $query = mysql_query("SELECT * from answer, users WHERE users.email='$user' and users.current = answer.question"); //Query the users table if there are matching rows equal to $username
        $exists = mysql_num_rows($query); //Checks if username exists
        if($exists > 0) //IF there are no returning rows or no existing username
        {
            while($row = mysql_fetch_assoc($query)) //display all rows from query
            {
                $table_answer = $row['answer']; 
            }
            if($table_answer == $_POST["answer"]){
                $query = mysql_query("UPDATE users set current = current + 1, users.timestamp=CURRENT_TIMESTAMP where  users.email='$user'"); //Query the users table if there are matching rows equal to $username
            }
            
        }
        else
        {
            Print '<script>alert("Somethings Wrong, contact admin");</script>'; //Prompts the user
            //Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
        }
    }
}

$query = mysql_query("SELECT * from answer, users WHERE users.email='$user' and users.current = answer.question"); //Query the users table if there are matching rows equal to $username
$exists = mysql_num_rows($query); //Checks if username exists
if($exists > 0) //IF there are no returning rows or no existing username
{
    while($row = mysql_fetch_assoc($query)) //display all rows from query
    {
        $table_question = $row['question']; // the first username row is passed on to $table_users, and so on until the query is finished
        // $table_answer = $row['answer']; // the first password row is passed on to $table_users, and so on until the query is finished
        $table_hint = $row['hint'];
    }
    
}
else
{
    Print '<script>alert("Somethings Wrong, contact admin");</script>'; //Prompts the user
    //Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
}
?>

<div id="frame">  
    <form action="logout.php">
        Welcome <span><?php echo($user) ?></span>
        <input type="submit" value="LOGOUT" name="logout" id="logout">
    </form>
    <form method="post" action="hunt.php" name="ContactForm" onsubmit="return ValidateContactForm();">
        <img src="<?php echo("images/".$table_question.".png") ?>" alt="image"></img><br>
        <p>Hint: <?php echo($table_hint) ?> </p>
        <p>Answer: </p>
        <p><input type="text" size="65" name="answer"></p>
        <p><input type="submit" value="Send" name="hunt">
        <input type="reset" value="Reset" name="reset"></p>
    </form>
</div>

</body>
</html>
