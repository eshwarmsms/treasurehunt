<html>
<head>    
    <title>Treasure Hunt</title>
    <link rel="stylesheet" href="index.css">
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
                    if(strtolower($table_answer) == strtolower($_POST["answer"])){
                        $query = mysql_query("UPDATE users set current = current + 1, users.timestamp=CURRENT_TIMESTAMP where  users.email='$user'"); //Query the users table if there are matching rows equal to $username
                    }
                    
                }
                else
                {
                    echo( '<script>alert("Wrong Answer!!!");</script>'); //Prompts the user
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
        Welcome <strong><?php echo($user) ?></strong>
        <form>
            <a href="/leaderboard.php">LEADERBOARD</a>
            <a href="/logout.php">LOGOUT</a>
        </form>
        <form>
            <h1>PUZZLE <?php echo($table_question) ?></h1>  
        </form>
        <form method="post" action="hunt.php" name="ContactForm" onsubmit="return ValidateContactForm();">
            <img src="<?php echo("images/".$table_question.".png") ?>" alt="image"></img><br>
            <p>Hint: <?php echo($table_hint) ?> </p>
            <p>Answer: </p>
            <p><input type="text" name="answer" id="input"></p>
            <p><input type="submit" value="SUBMIT" name="hunt">
            <input type="reset" value="RESET" name="reset"></p>
        </form>
    </div>

</body>
</html>
