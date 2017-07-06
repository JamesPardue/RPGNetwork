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
    $gamepicture;
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
	$gameothernotes;

    $early;
    $afternoon;
    $evening;
    $night;

    if(isset($_SESSION['name']) && isset($_REQUEST['gameid']))
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

        //Create database query
        $sql = "SELECT * FROM games WHERE GameID='" . $_REQUEST['gameid'] . "'";

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

                $breaks = array("<br />", "<br>", "<br/>");
                $gamedescription = str_ireplace($breaks, "\r\n", $gamedescription);
                $gameavailnotes = str_ireplace($breaks, "\r\n", $gameavailnotes);
            }
        }
        else
        {
            $_SESSION["error"] = "Name not found.";
            $conn->close();
        }
    }
    else
    {
        header('Location: index.php');
        exit();
    }
?>

<!-- PROFILE START -->
<div class="profile">
	<div class="profilesection">
        <div class="profiletitle">
			<?php echo $gamename ?>
        </div>
        <div class="profilecontents">
            <form class="profileinfo" method="post" action="updategame.php">
				<input class="profileinputhidden" type="hidden" name="gameid" size="25" maxlength="20" value="<?php echo $gameid ?>">
                <input type="hidden" name="gameid" value="<?php echo $gameid ?>">
                <div class="profileedittext">
					Name:
                </div>
                <input class="profileinput" type="text" name="gamename" size="25" maxlength="15" value="<?php echo $gamename ?>">
                <div class="profileedittext">
					Zipcode:
                </div>
                <input class="profileinput" type="text" name="gamezipcode" size="25" maxlength="15" value="<?php echo $gamezipcode ?>">
                <div class="profileedittext">
					Description:
                </div>
                <textarea class="profiletextarea" name="gamedescription" rows="4" cols="50" maxlength="500"><?php echo $gamedescription; ?></textarea>
				
                <div class="profilelist">
                    <div class="profilelisttext">
						Game Type
                    </div>
                    <input class="profilecheckbox" type="radio" name="gametype" value="InPerson"
                        <?php if($gametype == "InPerson") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">In Person</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Webcam"
                        <?php if($gametype == "Online_Webcam") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Webcam)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Audio"
						<?php if($gametype == "Online_Audio") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Audio)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Text"
                        <?php if($gametype == "Online_Text") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Text Only)</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
						Game Rate
                    </div>
                    <input class="profilecheckbox" type="radio" name="rate" value="MoreThanOnceAWeek"
                        <?php if($gamerate == "MoreThanOnceAWeek") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">More than Once a Week</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="Weekly"
                        <?php if($gamerate == "Weekly") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Weekly</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="EveryTwoWeeks"
                        <?php if($gamerate == "EveryTwoWeeks") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Every Two Weeks</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="Monthly"
                        <?php if($gamerate == "Monthly") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Monthly</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="OnceInAWhile"
                        <?php if($gamerate == "OnceInAWhile") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Once In A While</label>
                </div>
				<div class="profilelist">
                    <div class="profilelisttext">
                        Status
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="gameactive" value="1"
                        <?php if(isset($gameactive) && $gameactive == "1") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Active</label>
					<br>
					<input class="profilecheckbox" type="checkbox" name="playerswanted" value="1"
                        <?php if(isset($gameneedplayers) && $gameneedplayers == "1") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Players Wanted</label>
					<br>
					<input class="profilecheckbox" type="checkbox" name="dmwanted" value="1"
                        <?php if(isset($gameneeddm) && $gameneeddm == "1") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">DM/GM Wanted</label>
                </div>
				<div style="clear: both"></div>
                <div class="profileedittext">
                    Game Times
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
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Early" value="1"
                            <?php if(isset($early[0]) && $early[0]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Early" value="1"
                            <?php if(isset($early[1]) && $early[1]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Early" value="1"
                            <?php if(isset($early[2]) && $early[2]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Early" value="1"
                            <?php if(isset($early[3]) && $early[3]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Early" value="1"
                            <?php if(isset($early[4]) && $early[4]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Early" value="1"
                            <?php if(isset($early[5]) && $early[5]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Early" value="1"
                            <?php if(isset($early[6]) && $early[6]) echo "checked"; ?>></td>
                    </tr>
                    <tr>
                        <td class="headcol">Afternoon</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Afternoon" value="1"
                            <?php if(isset($afternoon[0]) && $afternoon[0]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Afternoon" value="1"
                            <?php if(isset($afternoon[1]) && $afternoon[1]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Afternoon" value="1"
                            <?php if(isset($afternoon[2]) && $afternoon[2]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Afternoon" value="1"
                            <?php if(isset($afternoon[3]) && $afternoon[3]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Afternoon" value="1"
                            <?php if(isset($afternoon[4]) && $afternoon[4]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Afternoon" value="1"
                            <?php if(isset($afternoon[5]) && $afternoon[5]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Afternoon" value="1"
                            <?php if(isset($afternoon[6]) && $afternoon[6]) echo "checked"; ?>></td>
                    </tr>
                    <tr>
                        <td class="headcol">Evening</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Evening" value="1"
                            <?php if(isset($evening[0]) && $evening[0]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Evening" value="1"
                            <?php if(isset($evening[1]) && $evening[1]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Evening" value="1"
                            <?php if(isset($evening[2]) && $evening[2]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Evening" value="1"
                            <?php if(isset($evening[3]) && $evening[3]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Evening" value="1"
                            <?php if(isset($evening[4]) && $evening[4]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Evening" value="1"
                            <?php if(isset($evening[5]) && $evening[5]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Evening" value="1"
                            <?php if(isset($evening[6]) && $evening[6]) echo "checked"; ?>></td>
                    </tr>
                    <tr>
                        <td class="headcol">Late Night</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Night" value="1"
                            <?php if(isset($night[0]) && $night[0]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Night" value="1"
                            <?php if(isset($night[1]) && $night[1]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Night" value="1"
                            <?php if(isset($night[2]) && $night[2]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Night" value="1"
                            <?php if(isset($night[3]) && $night[3]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Night" value="1"
                            <?php if(isset($night[4]) && $night[4]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Night" value="1"
                            <?php if(isset($night[5]) && $night[5]) echo "checked"; ?>></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Night" value="1"
                            <?php if(isset($night[6]) && $night[6]) echo "checked"; ?>></td>
                    </tr>
                </table>

                <div class="profileedittext">
                    Availability Notes
                </div>
                <textarea class="profiletextarea" name="gameavailnotes" rows="4" cols="50" maxlength="500"><?php echo $gameavailnotes; ?></textarea>

                <div class="profilelistnofloat">
                    <div class="profilelisttext">
                        System
                    </div>
                    <input class="profilecheckbox" type="radio" name="system" value="OldSchool"
                        <?php if($gamesystem == "OldSchool") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Old School/Old School Revival</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD3"
                        <?php if($gamesystem == "DD3") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 3.X/Pathfinder</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD4"
                        <?php if($gamesystem == "DD4") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 4</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD5"
                        <?php if($gamesystem == "DD5") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 5</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="PbtA"
                        <?php if($gamesystem == "PbtA") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">PbtA (Apoclypse World, Dungeon World, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="WoD"
                        <?php if($gamesystem == "WoD") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">World of Darkness (Vampire, Werewolf, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="BurningWheel"
                        <?php if($gamesystem == "BurningWheel") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Burning Wheel (Mouse Guard, Torch Bearer, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="Other"
                        <?php if($gamesystem == "Other") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Other (Savage Worlds, GURPS, FATE, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="Homebrew"
                        <?php if($gamesystem == "Homebrew") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Homebrew</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="BoardGames"
                        <?php if($gamesystem == "BoardGames") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Board Games/MtG/Other Tabletop</label>
                </div>

				<div class="profilelist">
                    <div class="profilelisttext">
                        Genre
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="genre_Fantasy" value="1"
                        <?php if(isset($gamegenre[0]) && $gamegenre[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Fantasy</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_SciFi" value="1"
                        <?php if(isset($gamegenre[1]) && $gamegenre[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Sci-Fi</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Horror" value="1"
                        <?php if(isset($gamegenre[2]) && $gamegenre[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Horror</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Modern" value="1"
                        <?php if(isset($gamegenre[3]) && $gamegenre[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Modern</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Western" value="1"
                        <?php if(isset($gamegenre[4]) && $gamegenre[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Western</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Historical" value="1"
                        <?php if(isset($gamegenre[5]) && $gamegenre[5]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Historical</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_PostApocolypse" value="1"
                        <?php if(isset($gamegenre[6]) && $gamegenre[6]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Post-Apocolypse</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Superhero" value="1"
                        <?php if(isset($gamegenre[7]) && $gamegenre[7]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Superhero</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Steampunk" value="1"
                        <?php if(isset($gamegenre[8]) && $gamegenre[8]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Steampunk</label>
                </div>
				<div class="profilelist">
                    <div class="profilelisttext">
                        Style
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="style_Serious" value="1"
                        <?php if(isset($gamestyle[0]) && $gamestyle[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Serious Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Silly" value="1"
                        <?php if(isset($gamestyle[1]) && $gamestyle[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Silly Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Casual" value="1"
                        <?php if(isset($gamestyle[2]) && $gamestyle[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Casual Game</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Powergaming" value="1"
                        <?php if(isset($gamestyle[3]) && $gamestyle[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Power Gaming</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_GMVsPlayer" value="1"
                        <?php if(isset($gamestyle[4]) && $gamestyle[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">GM vs Player</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_PlayerVsPlayer" value="1"
                        <?php if(isset($gamestyle[5]) && $gamestyle[5]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Player vs Player</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Rules
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="rules_Written" value="1"
                        <?php if(isset($gamerules[0]) && $gamerules[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Written</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Interpreted" value="1"
                        <?php if(isset($gamerules[1]) && $gamerules[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Interpreted</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Suggested" value="1"
                        <?php if(isset($gamerules[2]) && $gamerules[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Suggested</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_HouseRules" value="1"
                        <?php if(isset($gamerules[3]) && $gamerules[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">House Rules</label>
                </div>
                <div style="clear: both"></div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Tone
                    </div>
                    <input class="profilecheckbox" type="radio" name="tone" value="PG13"
                        <?php if($gametone == "PG13") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">PG-13</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="R"
                        <?php if($gametone == "R") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">R</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="M"
                        <?php if($gametone == "M") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">M</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="XXX"
                        <?php if($gametone == "XXX") echo "checked"; ?>>
                    <label class="profilecheckboxlabel">XXX</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Other
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="other_Food" value="1"
                        <?php if(isset($gameother[0]) && $gameother[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Food</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Alcohol" value="1"
                        <?php if(isset($gameother[1]) && $gameother[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Alcohol</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Smoking" value="1"
                        <?php if(isset($gameother[2]) && $gameother[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Smoking</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Drugs" value="1"
                        <?php if(isset($gameother[3]) && $gameother[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Drugs</label>
                </div>
				<div style="clear: both"></div>
				<div class="profileedittext">
                    Other Game Notes
                </div>
				<textarea class="profiletextarea" name="gameothernotes" rows="4" cols="50" maxlength="500"><?php echo $gameothernotes; ?></textarea>
				<div style="clear: both"></div>
				<input class="profileupdatebutton" action="updategame.php" type="submit" name="submit" value="Update">
			</form>
			<div style="clear: both"></div>
        </div>
    </div>
	
	<div class="profilesection">
        <div class="profiletitle">
			Game Picture
        </div>
        <div class="profilecontents">
			<div class="profilepics">
				<div class="profileedittext">
					Game Picture
				</div>
				<?php if(isset($_SESSION["gamepicuploaderror"])): ?>
					<div class="profiletext"><i><?php echo $_SESSION["gamepicuploaderror"]; ?></i></div>
					<?php echo $_SESSION["gamepicuploaderror"] = ""; ?>
				<?php endif; ?>
				
				<div class="profilepiccontainer">
					<?php if(isset($gamepicture) && $gamepicture): ?>
						<img class="profilepic" src="<?php echo $gamepicture ?>">
					<?php else: ?>
						<img class="profilepic" src="img/nopicgamered.png">
					<?php endif; ?>
					<form class="profilehiddenbutton" style="display: none;" action="uploadgamepic.php" method="post" enctype="multipart/form-data">
						<input class="profilehiddenbutton" id="file1" type="file" name="fileToUpload">
						<input type="hidden" name="gameid" value="<?php echo $gameid ?>">
						<input type="hidden" name="piclabel" value="pic1">
						<input class="profilehiddenbutton" id="submit1" type="submit" name="submit" value="Submit!!!">
					</form>
					<div>
						<button class="gamepicupdatebutton" onclick="UploadPic(1);">Upload Game Picture</button>
					</div>
					<?php if(isset($gamepicture) && $gamepicture): ?>
						<form method="post" action="deletegamepic.php">
							<input type="hidden" name="piclabel" value="pic1">
							<input type="hidden" name="gameid" value="<?php echo $gameid ?>">
							<input class="gamepicupdatebutton" type="submit" value="Delete Pic" name="submit">
						</form>
					<?php endif; ?>
				</div>
			</div>
		<div style="clear: both"></div>
		</div>
    </div>
	
	<div class="profilesection">
        <div class="profiletitle">
			Other
        </div>
        <div class="profilecontents">
			<form class="profileinfo" method="post" action="deletegame.php">
				<input type="hidden" name="gameid" value="<?php echo $gameid ?>">
				<input class="profileupdatebutton" style="margin-top:10px;" type="submit" name="submit" value="Delete Game">
			</form>
		</div>
	</div>
</div>
<!-- PROFILE END -->

<?php include 'footer.php' ?>

<script>
    
function UploadPic(num) 
{
    var file;
    var submit;
    
    if (num == '1')
    {
        file = "file1";
        submit = "submit1";
    }
    
    document.getElementById(file).click();
    document.getElementById(file).onchange = 
        function() 
        {
            document.getElementById(submit).click();
        };
}

</script>

<?php include 'js.php' ?>

</body>
</html>
