<?php
session_start();

if(isset($_POST['email']) && $_POST['email'] != "")
{
	$email = test_input($_POST['email']);
	//Save Email
	$_SESSION['email'] = $email;
	//Set Confirmation Number
	$_SESSION['confirm'] = md5(rand());

	//Create Message
	$to = $_SESSION['email'];
	$subject = "RPGFriendFiner Email Confirmation";
	$message = "Your Email Confirmation number is: " . $_SESSION['confirm'];
	$headers = "From: verifyemail@rpgfriendfinder.com" . " " .
			   "Reply-To: verifyemail@rpgfriendfinder.com" . " " .
			   "X-Mailer: PHP/" . phpversion();
	
	//Send Email
	$sentmail = mail($to,$subject,$message,null,'-fverifyemail@rpgfriendfinder.com');

	//If Email wasn't sent, set error
	if(!$sentmail)
	{
		$_SESSION['email'] = "";
		$_SESSION['emailerror'] = "Email could not be sent.";
	}

	//Return to page
	header("location: editprofile.php");
	exit();
}
elseif(isset($_POST['email']) && $_POST['email'] == "")
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
	$sql = "UPDATE players SET Email='' WHERE name='" . $_SESSION["name"] . "'";

	//Send query
	$result = $conn->query($sql);

	//Close connection
	$conn->close();
	
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