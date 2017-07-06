<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_SESSION["name"]) && isset($_POST["toplayer"]))
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
        
        $toplayer = test_input($_REQUEST['toplayer']);
        //Create database query
        $sql = "SELECT * FROM messages WHERE " .
            "(Player1='" . $toplayer . "' AND Player2='" . $_SESSION['name'] . "') " .
            "OR " .
            "(Player1='" . $_SESSION['name'] . "' AND Player2='" . $toplayer . "')";
        
        //Send query
        $result = $conn->query($sql);
        
        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $headertext = "location: messages.php?name=" . $_SESSION['name'] . "&message=" . $row['MessageID'];
                header($headertext);
                exit();
            }
        }
        else
        {
			$currenttime = date('Y-m-d H:i:s');
            //Create database query
            $sql = "INSERT INTO messages (Player1, Player2, Date)
                VALUES ('" . $_SESSION['name'] . "', '" . $_POST["toplayer"] . "', $currenttime)";
            
            //Send query
            if ($conn->query($sql) === TRUE)
            {
                //Create database query
                $sql = "SELECT * FROM messages WHERE " .
                    "(Player1='" . $_REQUEST['toplayer'] . "' AND Player2='" . $_SESSION['name'] . "') " .
                    "OR " .
                    "(Player1='" . $_SESSION['name'] . "' AND Player2='" . $toplayer . "')";
                
                //Send query
                $result = $conn->query($sql);

                //If there is more than 0 rows
                if ($result->num_rows > 0)
                {
                    //Output data of each row
                    while($row = $result->fetch_assoc()) 
                    {
                        $headertext = "location: messages.php?name=" . $_SESSION['name'] . "&message=" . $row['MessageID'];
                        header($headertext);
                        exit();
                    }
                }
                else
                {
                    $headertext = "location: profile.php?name=" . $toplayer;
                    header($headertext);
                    exit();
                }
            }
            else
            {
                $headertext = "location: profile.php?name=" . $toplayer;
                header($headertext);
                exit();
            }
        }
    }
    else
    {
        $toplayer = test_input($_REQUEST['toplayer']);
        $headertext = "location: profile.php?name=" . $toplayer;
        header($headertext);
        exit();
    }
}
else
{
    $headertext = "location: index.php";
    header($headertext);
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