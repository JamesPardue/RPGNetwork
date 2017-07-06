<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_SESSION["name"]) && isset($_POST["content"]))
	{
        $_SESSION['nocontent'] = "";
        
		//Create connection
		$servername = "localhost";
		$username = "protoj18_dbuser";
		$dbpassword = "Kobe08jpx";
		$dbname = "protoj18_RPGFF";
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);
        
        $messageid = test_input($_REQUEST['messageid']);
		$content = test_input($_POST["content"]);
		$from = test_input($_POST["from"]);
		
        //Check connection
        if ($conn->connect_error) 
        {
            $_SESSION["updateerror"] = "Cannot connect to server.";
            die("Connection failed: " . $conn->connect_error);
            header("location: profile.php");
        }
        
        //Create database query
        $sql = "SELECT * FROM messages WHERE MessageID='" . $messageid . "'";
        
        //Send query
        $result = $conn->query($sql);
        
        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $styleplayer = "";
                $styletext = "";
				$PlayerNew = "";
                if($row['Player1'] == $_SESSION["name"])
                {
                    $styleplayer = "<p1style>";
                    $styletext = "<p1text>";
					$PlayerNew = "Player2New";
                }
                elseif($row['Player2'] == $_SESSION["name"])
                {
                    $styleplayer = "<p2style>";
                    $styletext = "<p2text>";
					$PlayerNew = "Player1New";
                }
                
                $fullcontent = 
                    $row['Content'] . 
                    "<div $styleplayer>" . $from . "</div>" .
                    "<div $styletext>" . $content . "</div>";
                
				$currenttime = date('Y-m-d H:i:s');
                //Create database query
                $sql = "UPDATE messages SET Content='" . $fullcontent ."', $PlayerNew='1', Date='$currenttime'" .
				"WHERE MessageID='" . $row['MessageID'] . "'";

                //Send query
                $updateresult = $conn->query($sql);
            }
        }
        $conn->close();
        exit();
    }
    else
    {
        $_SESSION['nocontent'] = "";
        exit();
    }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}
?>