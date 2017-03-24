<html>
<head>    
    <title>Treasure Hunt</title>
    <link rel="stylesheet" href="index.css">
    
</head>
<body>

    <div id="frame">
        <strong><?php echo($user) ?></strong>
        <a href="/hunt.php">PUZZLES</a>
        <a href="/logout.php">LOGOUT</a>
        <h1>LEADERBOARD</h1>
        <form>
            <table>
                <tr>
                    <th>USER</th>
                    <th>PUZZLES SOLVED</th>
                </tr>
                <?php 
                    mysql_connect("in-cdbr-azure-south-c.cloudapp.net", "bf142daa6c0a1f","97095cdc", "treasurehunt") or die(mysql_error()); //Connect to server
                    mysql_select_db("treasurehunt") or die("Cannot connect to database"); //Connect to database

                    $query = mysql_query("SELECT * from users order by current desc"); //Query the users table if there are matching rows equal to $username
                    $exists = mysql_num_rows($query); //Checks if username exists
                    if($exists > 0) //IF there are no returning rows or no existing username
                    {
                        while($row = mysql_fetch_assoc($query)) //display all rows from query
                        {
                            $c = intval($row["current"]) - 1;
                            echo("<tr>");
                                echo("<td>".$row["email"]."</td>");
                                echo("<td>".$c."</td>");
                            echo("</tr>"); 
                        }
                        
                    }
                ?>
            </table>
        </form>
    </div>
</body>
</html>
