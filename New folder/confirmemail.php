<?php
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['confirm']) && isset($_POST['confirm']))
{
	$confirm = test_input($_POST['confirm']);
    if($_SESSION['confirm'] == $_POST['confirm'])
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

        //Create database query
        $sql = "UPDATE players SET Email='" . $_SESSION['email'] . 
             "' WHERE name='" . $_SESSION["name"] . "'";

        //Send query
        $result = $conn->query($sql);

        //Close connection
        $conn->close();
        
        $_SESSION['emailerror'] = "Email confirmed.";
    }
    else
    {
        $_SESSION['emailerror'] = "Confirmation number does not match.";
    }
	//Return to page
	header("location: editprofile.php");
	exit();
}
else
{
	//Return to page
	header("location: editprofile.php");
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