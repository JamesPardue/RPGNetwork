<?php
session_start();

//Define variables and set to empty values
$name = $password = "";

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //Sanatize data and set errors
	if (empty($_POST["name"])) 
	{
		$_SESSION["loginerror"] = "Please enter a name and password.";
	}
	else 
	{
		$name = test_input($_POST["name"]);
	}

	if (empty($_POST["password"])) 
	{
		$_SESSION["loginerror"] = "Please enter a name and password.";
	} 
	else 
	{
		$password = test_input($_POST["password"]);
	}
    
    if ($name != "" && $password != "")
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
            $_SESSION["loginerror"] = "Cannot connect to server.";
            die("Connection failed: " . $conn->connect_error);
        } 
        
        //Create database query
        $sql = "SELECT * FROM players WHERE name='$name'";

        //Send query
        $result = $conn->query($sql);
        
        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {            
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                if (password_verify($password, $row["password"]))
                {
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["location"] = $row["location"];
                    unset($_SESSION["loginerror"]);
                    
                    //Create database query
                    $sql = "SELECT * FROM messages WHERE ToPlayer='$name' AND New='1'";
                    //Send query
                    $messageresult = $conn->query($sql);
                    $_SESSION["messagenum"] = $messageresult->num_rows;
					
					$lastvisit = date('c');
					//Create database query
                    $sql = "UPDATE players SET LastVisit='$lastvisit' WHERE name='$name'";
                    //Send query
                    $conn->query($sql);
                }
                else
                {
                    $_SESSION["loginerror"] = "Password does not match. 
						<a class='' href='forgotpassword.php' style='color:blue;'>Forgot Password?</a>";
                    $conn->close();

                    redirect();
                    exit();
                }
            }
        }
        else
        {
            $_SESSION["loginerror"] = "Name not found.";
            $conn->close();

            redirect();
            exit();
        }
        
        //Close connection
        $conn->close();
         
        //Redirect to Home
        header("location: home.php");
        exit();
    }
    //Return to Index
    redirect();
    exit();
}

function redirect()
{
    if(isset($_SERVER['HTTP_REFERER'])) 
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);  
    } 
    else 
    {
        header('Location: index.php');  
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