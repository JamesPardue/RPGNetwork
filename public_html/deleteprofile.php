<?php
session_start();

if(isset($_SESSION["name"]) && isset($_POST["name"]) && $_POST["name"] == $_SESSION["name"])
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
	$delfile = "";
	
	//Create database query
    $sql = "SELECT pic1 FROM players" . 
         " WHERE name='" . $_SESSION["name"] . "'";
    //Send query
    $result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$delfile = $row['pic1'];
		}
	}
	if($delfile != "")
		unlink($delfile);
	
	//Create database query
    $sql = "SELECT pic2 FROM players" . 
         " WHERE name='" . $_SESSION["name"] . "'";
    //Send query
    $result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$delfile = $row['pic2'];
		}
	}
	if($delfile != "")
		unlink($delfile);
	
	//Create database query
    $sql = "SELECT pic3 FROM players" . 
         " WHERE name='" . $_SESSION["name"] . "'";
    //Send query
    $result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$delfile = $row['pic3'];
		}
	}
	if($delfile != "")
		unlink($delfile);
	
	$dir = "profiles/" . $_SESSION["name"];
	rmdir($dir);
	
    //Create database query
    $sql = "DELETE FROM players " . 
         " WHERE name='" . $_SESSION["name"] . "'";

    //Send query
    $result = $conn->query($sql);

    //Close connection
    $conn->close();

	session_unset();
	session_destroy();
	
	$header = "Location: home.php";
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