<?php
session_start();

// lookup all hints from array if $q is different from "" 
if ($_REQUEST["message"])
{
    if(!isset($_SESSION['updates']))
        $_SESSION['updates'] = 0;
    $_SESSION['updates']++;
    
	//Create connection
	$servername = "localhost";
	$username = "protoj18_dbuser";
	$dbpassword = "Kobe08jpx";
	$dbname = "protoj18_RPGFF";
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
    
    //Check connection
    if ($conn->connect_error) 
    {
        $_SESSION["error"] = "Cannot connect to server.";
        die("Connection failed: " . $conn->connect_error);
    }
    
    //Create database query
    $sql = "SELECT * FROM messages WHERE MessageID='" . $_REQUEST['message'] . "'";
    
    //Send query
    $result = $conn->query($sql);

    $content = "";
    //If there is more than 0 rows
    if ($result->num_rows > 0)
    {
        //Output data of each row
        while($row = $result->fetch_assoc()) 
        {
            $content = nl2br($row['Content']);
            
            if($row['Player1'] == $_SESSION['name'])
            {
                $content = str_replace("<p1style>", "style='font-weight:bold; text-align:left;'", $content);
                $content = str_replace("<p2style>", "style='font-weight:bold; text-align:right;'", $content);
                $content = str_replace("<p1text>", "style='text-align:left;'", $content);
                $content = str_replace("<p2text>", "style='text-align:right;'", $content);
            }
            elseif($row['Player2'] == $_SESSION['name'])
            {
                $content = str_replace("<p2style>", "style='font-weight:bold; text-align:left;'", $content);
                $content = str_replace("<p1style>", "style='font-weight:bold; text-align:right;'", $content);
                $content = str_replace("<p2text>", "style='text-align:left;'", $content);
                $content = str_replace("<p1text>", "style='text-align:right;'", $content);
            }
        }
    }
    $conn->close();

    echo $content;
}

?>