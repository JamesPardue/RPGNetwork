<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
    $gametype = array("0", "0", "0", "0");
    if(isset($_POST["gametype_InPerson"]))
        $gametype[0] = "1";
    if(isset($_POST["gametype_OnlineWebcam"]))
        $gametype[1] = "1";
    if(isset($_POST["gametype_OnlineAudio"]))
        $gametype[2] = "1";
    if(isset($_POST["gametype_OnlineTextOnly"]))
        $gametype[3] = "1";
    $gametypestring = implode(", ", $gametype);

    $rate = array("0", "0", "0", "0", "0");
    if(isset($_POST["rate_MoreThanOnceAWeek"]))
        $rate[0] = "1";
    if(isset($_POST["rate_Weekly"]))
        $rate[1] = "1";
    if(isset($_POST["rate_EveryTwoWeeks"]))
        $rate[2] = "1";
    if(isset($_POST["rate_Monthly"]))
        $rate[3] = "1";
    if(isset($_POST["rate_OnceInAWhile"]))
        $rate[4] = "1";
    $ratestring = implode(", ", $rate);
    
    $early = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Early"]))
        $early[0] = "1";
    if(isset($_POST["avail_Tue_Early"]))
        $early[1] = "1";
    if(isset($_POST["avail_Wed_Early"]))
        $early[2] = "1";
    if(isset($_POST["avail_Thu_Early"]))
        $early[3] = "1";
    if(isset($_POST["avail_Fri_Early"]))
        $early[4] = "1";
    if(isset($_POST["avail_Sat_Early"]))
        $early[5] = "1";
    if(isset($_POST["avail_Sun_Early"]))
        $early[6] = "1";
    $earlystring = implode(", ", $early);
    
    $afternoon = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Afternoon"]))
        $afternoon[0] = "1";
    if(isset($_POST["avail_Tue_Afternoon"]))
        $afternoon[1] = "1";
    if(isset($_POST["avail_Wed_Afternoon"]))
        $afternoon[2] = "1";
    if(isset($_POST["avail_Thu_Afternoon"]))
        $afternoon[3] = "1";
    if(isset($_POST["avail_Fri_Afternoon"]))
        $afternoon[4] = "1";
    if(isset($_POST["avail_Sat_Afternoon"]))
        $afternoon[5] = "1";
    if(isset($_POST["avail_Sun_Afternoon"]))
        $afternoon[6] = "1";
    $afternoonstring = implode(", ", $afternoon);
    
    $evening = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Evening"]))
        $evening[0] = "1";
    if(isset($_POST["avail_Tue_Evening"]))
        $evening[1] = "1";
    if(isset($_POST["avail_Wed_Evening"]))
        $evening[2] = "1";
    if(isset($_POST["avail_Thu_Evening"]))
        $evening[3] = "1";
    if(isset($_POST["avail_Fri_Evening"]))
        $evening[4] = "1";
    if(isset($_POST["avail_Sat_Evening"]))
        $evening[5] = "1";
    if(isset($_POST["avail_Sun_Evening"]))
        $evening[6] = "1";
    $eveningstring = implode(", ", $evening);
    
    $night = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Night"]))
        $night[0] = "1";
    if(isset($_POST["avail_Tue_Night"]))
        $night[1] = "1";
    if(isset($_POST["avail_Wed_Night"]))
        $night[2] = "1";
    if(isset($_POST["avail_Thu_Night"]))
        $night[3] = "1";
    if(isset($_POST["avail_Fri_Night"]))
        $night[4] = "1";
    if(isset($_POST["avail_Sat_Night"]))
        $night[5] = "1";
    if(isset($_POST["avail_Sun_Night"]))
        $night[6] = "1";
    $nightstring = implode(", ", $night);
    
    $AvailabilityNotes = test_input($_POST["AvailabilityNotes"]);
    
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
            "gametype='" . $gametypestring . "'" .
            ", rate='" . $ratestring . "'" .
            ", avail_early='" . $earlystring . "'" .
            ", avail_afternoon='" . $afternoonstring . "'" .
            ", avail_evening='" . $eveningstring . "'" .
            ", avail_night='" . $nightstring . "'" .
            ", AvailabilityNotes='" . $AvailabilityNotes . "'" .
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