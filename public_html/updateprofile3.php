<?php
session_start();

//Define variables and set to empty values
$updateerror = "";

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
    $system = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["system_OldSchool"]))
        $system[0] = "1";
    if(isset($_POST["system_DD3"]))
        $system[1] = "1";
    if(isset($_POST["system_DD4"]))
        $system[2] = "1";
    if(isset($_POST["system_DD5"]))
        $system[3] = "1";
    if(isset($_POST["system_PbtA"]))
        $system[4] = "1";
    if(isset($_POST["system_WoD"]))
        $system[5] = "1";
    if(isset($_POST["system_BurningWheel"]))
        $system[6] = "1";
    if(isset($_POST["system_Other"]))
        $system[7] = "1";
    if(isset($_POST["system_Hombrew"]))
        $system[8] = "1";
    if(isset($_POST["system_BoardGames"]))
        $system[9] = "1";
    $systemstring = implode(", ", $system);
    
    $play = array("0", "0", "0");
    if(isset($_POST["play_WillingGM"]))
        $play[0] = "1";
    if(isset($_POST["play_WillingPlay"]))
        $play[1] = "1";
    if(isset($_POST["play_Hangout"]))
        $play[2] = "1";
    $playstring = implode(", ", $play);
    
    $rules = array("0", "0", "0");
    if(isset($_POST["rules_Written"]))
        $rules[0] = "1";
    if(isset($_POST["rules_Interpreted"]))
        $rules[1] = "1";
    if(isset($_POST["rules_Suggested"]))
        $rules[2] = "1";
    if(isset($_POST["rules_HouseRules"]))
        $rules[3] = "1";
    $rulesstring = implode(", ", $rules);
    
    $style = array("0", "0", "0", "0", "0", "0");
    if(isset($_POST["style_Serious"]))
        $style[0] = "1";
    if(isset($_POST["style_Silly"]))
        $style[1] = "1";
    if(isset($_POST["style_Casual"]))
        $style[2] = "1";
    if(isset($_POST["style_Powergaming"]))
        $style[3] = "1";
    if(isset($_POST["style_GMVsPlayer"]))
        $style[4] = "1";
    if(isset($_POST["style_PlayerVsPlayer"]))
        $style[5] = "1";
    $stylestring = implode(", ", $style);
    
    $genre = array("0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["genre_Fantasy"]))
        $genre[0] = "1";
    if(isset($_POST["genre_SciFi"]))
        $genre[1] = "1";
    if(isset($_POST["genre_Horror"]))
        $genre[2] = "1";
    if(isset($_POST["genre_Modern"]))
        $genre[3] = "1";
    if(isset($_POST["genre_Western"]))
        $genre[4] = "1";
    if(isset($_POST["genre_Historical"]))
        $genre[5] = "1";
    if(isset($_POST["genre_PostApocolypse"]))
        $genre[6] = "1";
    if(isset($_POST["genre_Superhero"]))
        $genre[7] = "1";
    if(isset($_POST["genre_Steampunk"]))
        $genre[8] = "1";
    $genrestring = implode(", ", $genre);
    
    $tone = array("0", "0", "0", "0");
    if(isset($_POST["tone_PG13"]))
        $tone[0] = "1";
    if(isset($_POST["tone_R"]))
        $tone[1] = "1";
    if(isset($_POST["tone_M"]))
        $tone[2] = "1";
    if(isset($_POST["tone_XXX"]))
        $tone[3] = "1";
    $tonestring = implode(", ", $tone);
    
    $other = array("0", "0", "0", "0");
    if(isset($_POST["other_Food"]))
        $other[0] = "1";
    if(isset($_POST["other_Alcohol"]))
        $other[1] = "1";
    if(isset($_POST["other_Smoking"]))
        $other[2] = "1";
    if(isset($_POST["other_Drugs"]))
        $other[3] = "1";
    $otherstring = implode(", ", $other);
    
    $PreferenceNotes = test_input($_POST["PreferenceNotes"]);
    
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
            "System='" .  $systemstring . "'" .
            ", Play='" . $playstring .  "' " .
            ", Rules='" . $rulesstring .  "' " .
            ", Style='" . $stylestring .  "' " .
            ", Genre='" . $genrestring .  "' " .
            ", Tone='" . $tonestring .  "' " .
            ", Other='" . $otherstring .  "' " .
            ", PreferenceNotes='" . $PreferenceNotes .  "' " .
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