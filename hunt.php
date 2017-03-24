<html>
<head>    
    <title>Treasure Hunt</title>
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
?>


<div style="margin-right: auto;margin-left: auto;text-align:center;max-width:800px;padding:80px;box-shadow: 0 8px 6px -6px black;";>

<form method="post" action="form.php" name="ContactForm" onsubmit="return ValidateContactForm();">
    <img src="kalam.jpg" alt="image"></img><br>
    <p>Answer: <input type="text" size="65" name="Name"></p>
    <p><input type="submit" value="Send" name="submit">
    <input type="reset" value="Reset" name="reset"></p>
</form>
</div>

</body>
</html>
