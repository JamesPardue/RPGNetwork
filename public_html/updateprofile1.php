<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
    if($_POST["location"]=="" || is_numeric($_POST["location"]))
    {
        $_SESSION["ziperror"] = "";
        $_POST["location"] = (int)$_POST["location"];
    }
    else
    {
        $_SESSION["ziperror"] = $_POST["location"] . " is not a valid zipcode.";
        header("location: editprofile.php");
        exit();
    }
    
    $country = test_input($_POST["country"]);
    $location = test_input($_POST["location"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $selfdescription = test_input($_POST["selfdescription"]);
    $rpgexperience = test_input($_POST["rpgexperience"]);
    $interests = test_input($_POST["interests"]);
    $public = 0;
    if(isset($_POST["public"]))
        $public = 1;
    
    $_SESSION["location"] = $location;
    
    if (isset($_SESSION["name"]))
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
            $_SESSION["updateerror"] = "Cannot connect to server.";
            die("Connection failed: " . $conn->connect_error);
            header("location: profile.php");
        }
        
        //Create database query
        $sql = "UPDATE players SET " .
            "location='" . $location . "'" .
            ", country='" . $country .  "'" .
            ", age='" . $age .  "'" .
            ", gender='" . $gender .  "'" .
            ", SelfDescription='" . $selfdescription .  "'" .
            ", RPGExperience='" . $rpgexperience .  "'" .
            ", Interests='" . $interests .  "' " .
            ", Public='" . $public .  "' " .
            "WHERE name='" . $_SESSION["name"] . "'";
		
        //Send query
        $result = $conn->query($sql);
        
        //Close connection
        $conn->close();
        
        header("location: editprofile.php");
        exit();
    }
    $_SESSION["updateerror"] = "Not logged in.";

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