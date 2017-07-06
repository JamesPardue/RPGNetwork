<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<?php include 'head.php' ?>

</head>
<body>

<?php include 'header.php' ?>

<?php

	$gameid = "";
    $gamename = "";
    $gameowner = "";
	$gamezipcode = "";
    $gamedescription = "";
	$gameactive;
	$gameneedplayers;
    $gameneeddm;
    $gamepicture = "";
    $gametype;
    $gamerate;
    $gameavailability = "";
    $gameavailnotes = "";
    $gamesystem;
    $gamerules;
    $gamestyle;
    $gamegenre;
    $gametone;
    $gameother;

    $early;
    $afternoon;
    $evening;
    $night;

    if(isset($_REQUEST['gameid']))
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
            $_SESSION["error"] = "Cannot connect to server.";
            die("Connection failed: " . $conn->connect_error);
        }

		$gameid = test_input($_REQUEST['gameid']);
        //Create database query
        $sql = "SELECT * FROM games WHERE GameID='" . $gameid . "'";

        //Send query
        $result = $conn->query($sql);

        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc())
            {
				$gameid = $row["GameID"];
                $gamename = $row["gamename"];
                $gameowner = $row["gameowner"];
				$gamezipcode = $row["gamezipcode"];
                $gamedescription = $row["gamedescription"];
                $gamepicture = $row["gamepicture"];
                $gametype = $row["gametype"];
                $gamerate = $row["gamerate"];
                $gameavailability = $row["gameavailability"];
                $gameavailnotes = $row["gameavailnotes"];
                $gamesystem = $row["gamesystem"];
                $gamerules = explode(", ", $row["gamerules"]);
                $gamestyle = explode(", ", $row["gamestyle"]);
                $gamegenre = explode(", ", $row["gamegenre"]);
                $gametone = $row["gametone"];
				$gameother = explode(", ", $row["gameother"]);
				$gameothernotes = $row["gameothernotes"];
				$gameactive = $row["gameactive"];
				$gameneedplayers = $row["playerswanted"];
				$gameneeddm = $row["dmwanted"];

                $early = explode(", ", $row["avail_early"]);
                $afternoon = explode(", ", $row["avail_afternoon"]);
                $evening = explode(", ", $row["avail_evening"]);
                $night = explode(", ", $row["avail_night"]);

                $conn->close();
            }
        }
        else
        {
            $_SESSION["error"] = "Name not found.";
            $conn->close();
        }
    }
    unset ($_REQUEST['gamename']);
	
?>

<?php
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function GetGameType($gametype)
{
    if(isset($gametype))
	{
		if($gametype == "InPerson")
			echo "In Person";
		elseif($gametype == "Online_Webcam")
			echo "Online (Webcam)";
		elseif($gametype == "Online_Audio")
			echo "Online (Audio)";
		elseif($gametype == "Online_Text")
			echo "Online (Text Only)";
	}
}

function GetRate($gamerate)
{
	if(isset($gamerate))
	{
		if($gamerate == "MoreThanOnceAWeek")
			echo "More than Once a Week";
		elseif($gamerate == "Weekly")
			echo "Weekly";
		elseif($gamerate == "EveryTwoWeeks")
			echo "Every Two Weeks";
		elseif($gamerate == "Monthly")
			echo "Monthly";
		elseif($gamerate == "OnceInAWhile")
			echo "Once in a While";
	}
}

function GetSystem($gamesystem)
{
	if(isset($gamesystem))
	{
		if($gamesystem == "OldSchool")
			echo "Old School/Old School Revival";
		elseif($gamesystem == "DD3")
			echo "D&amp;D 3.X/Pathfinder";
		elseif($gamesystem == "DD4")
			echo "D&amp;D 4";
		elseif($gamesystem == "DD5")
			echo "D&amp;D 5";
		elseif($gamesystem == "PbtA")
			echo "PbtA (Apoclypse World, Dungeon World, ...)";
		elseif($gamesystem == "WoD")
			echo "World of Darkness (Vampire, Werewolf, ...)";
		elseif($gamesystem == "BurningWheel")
			echo "Burning Wheel (Mouse Guard, Torch Bearer, ...)";
		elseif($gamesystem == "Other")
			echo "Other (Savage Worlds, GURPS, FATE, ...)";
		elseif($gamesystem == "Homebrew")
			echo "Homebrew";
		elseif($gamesystem == "Board Games/MtG/Other Tabletop")
			echo "Board Games";
	}
}

function GetRules($gamerules)
{
    $rulesstring = "";
    if(isset($gamerules[0]) && $gamerules[0]) $rulesstring = $rulesstring . "Rules as Written, ";
    if(isset($gamerules[1]) && $gamerules[1]) $rulesstring = $rulesstring . "Rules as Interpreted, ";
    if(isset($gamerules[2]) && $gamerules[2]) $rulesstring = $rulesstring . "Rules as Suggested, ";
    if(isset($gamerules[3]) && $gamerules[3]) $rulesstring = $rulesstring . "House Rules, ";
    if($rulesstring == "")
        echo "N/A";
    else
    {
        $rulesstring = trim($rulesstring, ", ");
        echo $rulesstring;
    }
}

function GetStyle($gamestyle)
{
    $stylestring = "";
    if(isset($gamestyle[0]) && $gamestyle[0]) $stylestring = $stylestring . "Serious Roleplay, ";
    if(isset($gamestyle[1]) && $gamestyle[1]) $stylestring = $stylestring . "Silly Roleplay, ";
    if(isset($gamestyle[2]) && $gamestyle[2]) $stylestring = $stylestring . "Casual Game, ";
    if(isset($gamestyle[3]) && $gamestyle[3]) $stylestring = $stylestring . "Power Gaming, ";
    if(isset($gamestyle[4]) && $gamestyle[4]) $stylestring = $stylestring . "GM vs Player, ";
    if(isset($gamestyle[5]) && $gamestyle[5]) $stylestring = $stylestring . "Player vs Player, ";
    if($stylestring == "")
        echo "N/A";
    else
    {
        $stylestring = trim($stylestring, ", ");
        echo $stylestring;
    }
}

function GetGenre($gamegenre)
{
    $genrestring = "";
    if(isset($gamegenre[0]) && $gamegenre[0]) $genrestring = $genrestring . "Fantasy, ";
    if(isset($gamegenre[1]) && $gamegenre[1]) $genrestring = $genrestring . "Sci-Fi, ";
    if(isset($gamegenre[2]) && $gamegenre[2]) $genrestring = $genrestring . "Horror, ";
    if(isset($gamegenre[3]) && $gamegenre[3]) $genrestring = $genrestring . "Modern, ";
    if(isset($gamegenre[4]) && $gamegenre[4]) $genrestring = $genrestring . "Western, ";
    if(isset($gamegenre[5]) && $gamegenre[5]) $genrestring = $genrestring . "Historical, ";
    if(isset($gamegenre[6]) && $gamegenre[6]) $genrestring = $genrestring . "Post-Apocolypse, ";
    if(isset($gamegenre[7]) && $gamegenre[7]) $genrestring = $genrestring . "Superhero, ";
    if(isset($gamegenre[8]) && $gamegenre[8]) $genrestring = $genrestring . "Steampunk, ";
    if($genrestring == "")
        echo "N/A";
    else
    {
        $genrestring = trim($genrestring, ", ");
        echo $genrestring;
    }
}

function GetTone($gametone)
{
	if(isset($gametone))
	{
		if($gametone == "PG13")
			echo "PG-13";
		elseif($gametone == "R")
			echo "R";
		elseif($gametone == "M")
			echo "M";
		elseif($gametone == "XXX")
			echo "XXX";
	}
}

function GetOther($gameother)
{
    $otherstring = "";
    if(isset($gameother[0]) && $gameother[0]) $otherstring = $otherstring . "Serious Roleplay, ";
    if(isset($gameother[1]) && $gameother[1]) $otherstring = $otherstring . "Silly Roleplay, ";
    if(isset($gameother[2]) && $gameother[2]) $otherstring = $otherstring . "Casual Game, ";
    if(isset($gameother[3]) && $gameother[3]) $otherstring = $otherstring . "Power Gaming, ";
    if($otherstring == "")
        echo "N/A";
    else
    {
        $otherstring = trim($otherstring, ", ");
        echo $otherstring;
    }
}
?>

<!-- PROFILE START -->
<div class="profile">

    <div class="profilesection">
        <div class="profiletitle">
            <?php echo $gamename ?>
            <?php if($gameowner==$_SESSION["name"]): ?>
                <a class="profileeditbutton" href="editgame.php?gameid=<?php echo $gameid; ?>">Edit Game</a>
            <?php endif; ?>
        </div>
        <div class="profilecontents">
            <div class="profiletext">
                <b>Name:</b> <?php echo $gamename ?>
            </div>
            <div class="profiletext">
                <b>Creator:</b> <a style="color:blue;"; href="profile.php?name=<?php echo $gameowner; ?>"><b><?php echo $gameowner ?></b></a>
            </div>
		    <div class="profiletext">
                <b>Zipcode:</b> <?php echo $gamezipcode ?>
            </div>
            <div class="profiletext">
                <b>Description:</b>
                <br>
                <?php echo $gamedescription ?>
            </div>
            <div class="profiletext">
            </div>
            <div class="profilepics">
                <div class="profilepiccontainer">
                    <?php if(isset($gamepicture) && $gamepicture): ?>
                        <img class="profilepic" src="<?php echo $gamepicture; ?>">
                    <?php else: ?>
                        <img class="profilepic" src="img/nopicgamered.png">
                    <?php endif; ?>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>

    <div class="profilesection">
        <div class="profiletitle">Availability</div>
        <div class="profilecontents">
			<div class="profilelist" style="margin-bottom:0px;">
				<div class="profiletext" style="margin-bottom:0px;">
					<b>Status</b>
				</div>
				<input class="profilecheckboxsmall" type="checkbox" name="gameactive" value="1" disabled
					<?php if(isset($gameactive) && $gameactive == "1") echo "checked"; ?>>
				<label class="profilecheckboxlabel" style="margin-left:1px;">Active</label>
				<br>
				<input class="profilecheckboxsmall" type="checkbox" name="playerswanted" value="1" disabled
					<?php if(isset($gameneedplayers) && $gameneedplayers == "1") echo "checked"; ?>>
				<label class="profilecheckboxlabel" style="margin-left:1px;">Players Wanted</label>
				<br>
				<input class="profilecheckboxsmall" type="checkbox" name="dmwanted" value="1" disabled
					<?php if(isset($gameneeddm) && $gameneeddm == "1") echo "checked"; ?>>
				<label class="profilecheckboxlabel" style="margin-left:1px;">DM/GM Wanted</label>
			</div>
			<div style="clear: both"></div>
            <div class="profiletext">
                <b>Type: </b> <?php GetGameType($gametype) ?>
            </div>
            <div class="profiletext">
                <b>Rate: </b> <?php GetRate($gamerate) ?>
            </div>
            <div class="profiletext">
                <b>Game Times</b>
            </div>
            <table class="profileavailability">
                <tr>
                    <th class="headcol topleft"></th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
                <tr>
                    <td class="headcol">Morning</td>
                    <td <?php if(isset($early[0]) && $early[0]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[1]) && $early[1]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[2]) && $early[2]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[3]) && $early[3]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[4]) && $early[4]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[5]) && $early[5]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($early[6]) && $early[6]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                </tr>
                <tr>
                    <td class="headcol">Afternoon</td>
                    <td <?php if(isset($afternoon[0]) && $afternoon[0]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[1]) && $afternoon[1]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[2]) && $afternoon[2]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[3]) && $afternoon[3]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[4]) && $afternoon[4]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[5]) && $afternoon[5]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($afternoon[6]) && $afternoon[6]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                </tr>
                <tr>
                    <td class="headcol">Evening</td>
                    <td <?php if(isset($evening[0]) && $evening[0]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[1]) && $evening[1]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[2]) && $evening[2]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[3]) && $evening[3]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[4]) && $evening[4]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[5]) && $evening[5]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($evening[6]) && $evening[6]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                </tr>
                <tr>
                    <td class="headcol">Late Night</td>
                    <td <?php if(isset($night[0]) && $night[0]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[1]) && $night[1]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[2]) && $night[2]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[3]) && $night[3]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[4]) && $night[4]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[5]) && $night[5]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                    <td <?php if(isset($night[6]) && $night[6]) echo "class='greenbox'><i class='af af_bigcheck'></i>"; else echo "class='greybox'>"?></td>
                </tr>
            </table>
            <div class="profiletext">
                <b>Notes:</b>
                <br>
                <?php echo $gameavailnotes ?>
            </div>
        </div>
    </div>

    <div class="profilesection">
        <div class="profiletitle">RPG Configuration</div>
        <div class="profilecontents">
            <div class="profiletext">
                <b>System:</b>
                <?php GetSystem($gamesystem); ?>
            </div>
            <div class="profiletext">
                <b>Rules: </b> <?php GetRules($gamerules); ?>
            </div>
            <div class="profiletext">
                <b>Style: </b> <?php GetStyle($gamestyle); ?>
            </div>
            <div class="profiletext">
                <b>Genre: </b> <?php GetGenre($gamegenre); ?>
            </div>
            <div class="profiletext">
                <b>Tone: </b> <?php GetTone($gametone); ?>
            </div>
            <div class="profiletext">
                <b>Other: </b> <?php GetOther($gameother); ?>
            </div>
			<div class="profiletext">
                <b>Other Game Notes:</b>
                <br>
                <?php echo $gameothernotes ?>
            </div>
        </div>
    </div>

</div>
<!-- PROFILE END -->

<?php include 'footer.php' ?>

<?php include 'js.php' ?>

</body>
</html>
