<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$gameowner = $_SESSION['name'];
    $gamename = test_input($_POST["gamename"]);
    $gamedescription = test_input($_POST["gamedescription"]);
    $gameavailnotes = test_input($_POST["gameavailnotes"]);
    $gameother = test_input($_POST["gameOther"]);

	$gamezipcode = "";
	if(isset($_POST["gamezipcode"]))
		$gametype = test_input($_POST["gamezipcode"]);
	
	$gametype = "";
	if(isset($_POST["gametype"]))
		$gametype = test_input($_POST["gametype"]);

	$gamerate = "";
    if(isset($_POST["rate"]))
		$gamerate = test_input($_POST["rate"]);
	
	$gameactive = "";
    if(isset($_POST["gameactive"]))
		$gameactive = "1";
	else
		$gameactive = "0";
	
	$playerswanted = "";
    if(isset($_POST["playerswanted"]))
		$playerswanted = "1";
	else
		$playerswanted = "0";
	
	$gameneeddm = "";
    if(isset($_POST["dmwanted"]))
		$gameneeddm = "1";
	else
		$gameneeddm = "0";

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

	$gameavailnotes = "";
	if(isset($_POST["gameavailnotes"]))
		$gameavailnotes = test_input($_POST["gameavailnotes"]);

	$gamesystem = "";
	if(isset($_POST["system"]))
		$gamesystem = test_input($_POST["system"]);

    $gamerules = array("0", "0", "0");
    if(isset($_POST["rules_Written"]))
        $gamerules[0] = "1";
    if(isset($_POST["rules_Interpreted"]))
        $gamerules[1] = "1";
    if(isset($_POST["rules_Suggested"]))
        $gamerules[2] = "1";
    if(isset($_POST["rules_HouseRules"]))
        $gamerules[3] = "1";
    $gamerulesstring = implode(", ", $gamerules);

    $gamestyle = array("0", "0", "0", "0", "0", "0");
    if(isset($_POST["style_Serious"]))
        $gamestyle[0] = "1";
    if(isset($_POST["style_Silly"]))
        $gamestyle[1] = "1";
    if(isset($_POST["style_Casual"]))
        $gamestyle[2] = "1";
    if(isset($_POST["style_Powergaming"]))
        $gamestyle[3] = "1";
    if(isset($_POST["style_GMVsPlayer"]))
        $gamestyle[4] = "1";
    if(isset($_POST["style_PlayerVsPlayer"]))
        $gamestyle[5] = "1";
    $gamestylestring = implode(", ", $gamestyle);

    $gamegenre = array("0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["genre_Fantasy"]))
        $gamegenre[0] = "1";
    if(isset($_POST["genre_SciFi"]))
        $gamegenre[1] = "1";
    if(isset($_POST["genre_Horror"]))
        $gamegenre[2] = "1";
    if(isset($_POST["genre_Modern"]))
        $gamegenre[3] = "1";
    if(isset($_POST["genre_Western"]))
        $gamegenre[4] = "1";
    if(isset($_POST["genre_Historical"]))
        $gamegenre[5] = "1";
    if(isset($_POST["genre_PostApocolypse"]))
        $gamegenre[6] = "1";
    if(isset($_POST["genre_Superhero"]))
        $gamegenre[7] = "1";
    if(isset($_POST["genre_Steampunk"]))
        $gamegenre[8] = "1";
    $gamegenrestring = implode(", ", $gamegenre);

	$gametone = "";
	if(isset($_POST["tone"]))
		$gametone = test_input($_POST["tone"]);

	$gameother = array("0", "0", "0", "0");
    if(isset($_POST["style_Serious"]))
        $gameother[0] = "1";
    if(isset($_POST["style_Silly"]))
        $gameother[1] = "1";
    if(isset($_POST["style_Casual"]))
        $gameother[2] = "1";
    if(isset($_POST["style_Powergaming"]))
        $gameother[3] = "1";
    $gameotherstring = implode(", ", $gameother);
	
	$gameothernotes = "";
	if(isset($_POST["gameothernotes"]))
		$gameothernotes = test_input($_POST["gameothernotes"]);
	
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
        header("location: game.php");
    }

    //Create database query
   $sql = "INSERT INTO games (gamename, gameowner, gamedescription, gamezipcode, 
							  gametype, gamerate, gameavailnotes, gamesystem, gamerules, 
							  gamestyle, gamegenre, gametone, gameother, gameothernotes,
							  gameactive, playerswanted, dmwanted, 
							  avail_early, avail_afternoon, avail_evening, avail_night)
					 VALUES ('$gamename', '$gameowner', '$gamedescription', '$gamezipcode', 
							 '$gametype', '$gamerate', '$gameavailnotes', '$gamesystem', '$gamerulesstring',
							 '$gamestylestring', '$gamegenrestring', '$gametone', '$gameotherstring', '$gameothernotes',
							 '$gameactive', '$playerswanted', '$gameneeddm',
							 '$earlystring', '$afternoonstring', '$eveningstring', '$nightstring')";

    //Send query
    $result = $conn->query($sql);

    //Close connection
    $conn->close();

	$header = "location: profile.php?name=" . $_SESSION['name'];
    header($header);
    exit();
}
else
{
	header("location: index.php");
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
