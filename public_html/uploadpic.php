<?php
session_start();

if(isset($_SESSION['name']))
{
	$uploadOk = 1;
	$_SESSION["picuploaderror"] = "";

	//Get file extension
	$imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);

	$piclabel = $_POST["piclabel"];
	$piclabel = trim($piclabel);
	$piclabel = stripslashes($piclabel);
	$piclabel = htmlspecialchars($piclabel);

	//Create filename
	$target_dir = "profiles/" . $_SESSION['name'] . "/";
	$target_file = $target_dir . $piclabel . "." . $imageFileType;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]))
	{
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false)
		{
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		}
		else
		{
			$_SESSION["picuploaderror"] = "File is not an image.";
			$uploadOk = 0;
		}
	}

	//Check if file already exists
	/*
	if (file_exists($target_file)) 
	{
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	*/

	//Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) 
	{
		$_SESSION["picuploaderror"] = "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	//Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "JPG")
	{
		$_SESSION["picuploaderror"] = "Sorry, only JPG files are allowed.";
		$uploadOk = 0;
	}

	//Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) 
	{
		//$_SESSION["picuploaderror"] = "Sorry, your file was not uploaded.";
	//If everything is ok, try to upload file
	} 
	else
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
		{
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			
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
			$sql = "UPDATE players SET " . $piclabel . "='" . $target_file . 
				 "' WHERE name='" . $_SESSION["name"] . "'";
			
			//Send query
			$result = $conn->query($sql);
			
			//Close connection
			$conn->close();
		}
		else
		{
			$_SESSION["picuploaderror"] = "Sorry, there was an error uploading your file.";
		}
	}

	header("location: editprofile.php");
	exit();
}
else
{
	header("location: index.php");
	exit();
}

?>