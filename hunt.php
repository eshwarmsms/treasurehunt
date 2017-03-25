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

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($_POST['hunt'])){
                $query = mysql_query("SELECT * from answer, users WHERE users.email='$user' and users.current = answer.question");
                $exists = mysql_num_rows($query);
                if($exists > 0)
                {
                    while($row = mysql_fetch_assoc($query))
                    {
                        $table_answer = $row['answer']; 
                    }
                    if(strtolower($table_answer) == strtolower($_POST["answer"])){
                        $query = mysql_query("UPDATE users set current = current + 1, users.timestamp=CURRENT_TIMESTAMP where  users.email='$user'");
                    }
                    
                }
                else
                {
                    echo( '<script>alert("Wrong Answer!!!");</script>');
                }
            }
        }
        $query = mysql_query("SELECT * from answer, users WHERE users.email='$user' and users.current = answer.question");
        $exists = mysql_num_rows($query);
        if($exists > 0)
        {
            while($row = mysql_fetch_assoc($query))
            {
                $table_question = $row['question'];
                $table_hint = $row['hint'];
            }
            if($table_hint == "end"){
                header("location:congrats.php");
            }
        }
        else
        {
                Print '<script>alert("Somethings Wrong, contact admin");</script>';
        }
    ?>

    <div id="frame">  
        Welcome <strong><?php echo($user) ?></strong>
        <!--<form>-->
            <a href="/instructions.php">INSTRUCTIONS</a>
            <br>
            <a href="/leaderboard.php">LEADERBOARD</a>
            <a href="/logout.php">LOGOUT</a>
        <!--</form>-->
        <form>
            <h3>PUZZLE <?php echo($table_question) ?></h3>  
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
