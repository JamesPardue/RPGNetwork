<?php
session_start();

//Define variables and set to empty values
$name = $password = $confirmpassword = "";

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
    if($_POST["email"]=="")
    {
        //Sanatize data and set errors
        if (empty($_POST["name"]))
        {
            $_SESSION["joinerror"] = "Please enter a name and confirm your password.";
        } 
        else 
        {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["password"])) 
        {
            $_SESSION["joinerror"] = "Please enter a name and confirm your password.";
        }
        else
        {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["confirmpassword"])) 
        {
            $_SESSION["joinerror"] = "Please enter a name and confirm your password.";
        } 
        else 
        {
            $confirmpassword = test_input($_POST["confirmpassword"]);
        }

        if ($name != "" && $password != "" && $confirmpassword != "")
        {
            if ($password === $confirmpassword)
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
                    $_SESSION["joinerror"] = "Cannot connect to server.";
                    die("Connection failed: " . $conn->connect_error);
                    header("location: profile.php");
                }

                //Create database query
                $sql = "SELECT name FROM players WHERE name = '$name'";

                //Send query
                $result = $conn->query($sql);
                $row_count = $result->num_rows;
                if($row_count >= 1)
                {
                    $_SESSION["joinerror"] = "Name is already being used.";
                    $conn->close();

                    header("location: index.php");
                    exit();
                }
                else
                {
                    //Get Hash of Password
                    $hash = password_hash($password, PASSWORD_BCRYPT);
					$visittime = date('c');
					
                    //Create database query
                    $sql = "INSERT INTO players (name, password, LastVisit) 
                        VALUES ('$name', '$hash', '$visittime')";

                    //Send query
                    if ($conn->query($sql) === TRUE)
                    {

                        $_SESSION["name"] = $name;
                        $conn->close();

                        mkdir("profiles/" . $_SESSION["name"] . "/");
                        header("location: home.php");
                        exit();
                    }
                    else
                    {
                        $_SESSION["joinerror"] = "Error: " . $sql . "<br>" . $conn->error;
                        $conn->close();

                        header("location: index.php");
                        exit();
                    }
                }
            }
            else
            {
                $_SESSION["joinerror"] = "Password confirmation does not match.";
                $conn->close();
                header("location: index.php");
                exit();
            }
        }

        header("location: index.php");
        exit();
    }
    else
    {
        header("location: index.php");
        exit();
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