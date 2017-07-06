<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
	if(isset($_POST["psresetcode"]) && isset($_POST["newpw"]) && isset($_POST["confirmnewpw"]) 
		&& isset($_POST["psresetcode"]) && isset($_POST["email"]))
	{
		if($_POST["newpw"] != "" && ($_POST["newpw"] == $_POST["confirmnewpw"]) && ($_POST["psresetcode"] == $_SESSION['confirm']) )
		{
			$name = test_input($_POST["name"]);
			$psresetcode = test_input($_POST["psresetcode"]);
			$newpw = test_input($_POST["newpw"]);
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
				//Get Hash of Password
				$hash = password_hash($newpw, PASSWORD_BCRYPT);

				//Create database query
				$sql = "UPDATE players SET password='$hash' WHERE name='$name'";

				//Send query
				if ($conn->query($sql) === TRUE)
				{
					unset($_SESSION['setnewpwerror']);
					$_SESSION["name"] = $name;
					$conn->close();

					header("location: home.php");
					exit();
				}
				else
				{
					$_SESSION['setnewpwerror'] = "Error updating account.";
					$conn->close();
					//Return to page
					header("location: newpassword.php");
					exit();
				}
				
				$conn->close();
				//Return to page
				header("location: newpassword.php");
				exit();
			}
			else
			{
				$_SESSION['setnewpwerror'] = "Username and Email do not match.";
				//Return to page
				header("location: newpassword.php");
				exit();
			}
		}
		else
		{
			$_SESSION['setnewpwerror'] = "Passwords do not match.";
			//Return to page
			header("location: newpassword.php");
			exit();
		}
	}
}
else
{
	$_SESSION['setnewpwerror'] = "Form not filled out.";
	//Return to page
	header("location: newpassword.php");
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