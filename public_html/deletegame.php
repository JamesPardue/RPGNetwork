<?php
session_start();

if(isset($_SESSION["name"]) && isset($_POST["gameid"]))
{
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

	$gameid = test_input($_POST["gameid"]);
	
	//Create database query
    $sql = "SELECT gamepicture FROM games" . 
         " WHERE GameID='" . $gameid . "' AND gameowner='" . $_SESSION["name"] . "'";

    //Send query
	$delfile = "";
    $result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$delfile = $row['gamepicture'];
		}
	}
	
    //Create database query
    $sql = "DELETE FROM games " . 
         " WHERE GameID='" . $gameid . "' AND gameowner='" . $_SESSION["name"] . "'";

    //Send query
    $result = $conn->query($sql);

    //Close connection
    $conn->close();

	if($delfile != "")
		unlink($delfile);
	
	$dir = "games/" . $gameid;
	if(file_exists($dir))
		rmdir($dir);
	
	$header = "Location: profile.php?name=" . $_SESSION["name"];
    header($header);
	exit();
}
else
{
    header('Location: index.php');
	exit();
}

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>