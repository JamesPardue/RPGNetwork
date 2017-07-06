<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
	if(isset($_POST["name"]) && isset($_POST["email"]))
	{
		$name = test_input($_POST["name"]);
		$email = test_input($_POST["email"]);
		
		//Create connection
		$servername = "localhost";
		$username = "protoj18_dbuser";
		$dbpassword = "Kobe08jpx";
		$dbname = "protoj18_RPGFF";
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
		
		//Create database query
        $sql = "SELECT * FROM players WHERE name='$name' AND Email='$email'";

        //Send query
        $result = $conn->query($sql);
		
		//If there is more than 0 rows
        if ($result->num_rows > 0)
        {   
			$_SESSION['confirm'] = md5(rand());
			
            //Create Message
			$to = $email;
			$subject = "RPGFriendFiner Password Reset Code";
			$message = "Your Password Reset Code is: " . $_SESSION['confirm'];
			$headers = "From: verifyemail@rpgfriendfinder.com" . " " .
					   "Reply-To: verifyemail@rpgfriendfinder.com" . " " .
					   "X-Mailer: PHP/" . phpversion();
					   
			//Send Email
			$sentmail = mail($to,$subject,$message,null,'-fverifyemail@rpgfriendfinder.com');

			//If Email wasn't sent, set error
			if(!$sentmail)
			{
				$_SESSION['reseterror'] = "Email could not be sent.";
				$conn->close();
				//Return to page
				header("location: forgotpassword.php");
				exit();
			}
			
			$conn->close();
			unset($_SESSION['reseterror']);
			//Return to page
			header("location: newpassword.php");
			exit();
		}
		else
		{
			$_SESSION['reseterror'] = "Username and Password do not match.";
			$conn->close();
			//Return to page
			header("location: forgotpassword.php");
			exit();
		}
	}
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

