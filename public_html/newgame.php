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

<!-- PROFILE START -->
<div class="profile">
	<div class="profilesection">
		<div class="profiletitle">
			Create New Game
		</div>
        <div class="profilecontents">
            <form class="profileinfo" method="post" action="creategame.php">
                <div class="profileedittext">
					Game Name:
                </div>
                <input class="profileinput" type="text" name="gamename" size="25" maxlength="20">
				<div class="profileedittext">
					Zipcode:
                </div>
                <input class="profileinput" type="text" name="gamezipcode" size="25" maxlength="15">
                <div class="profileedittext">
					Description:
                </div>
                <textarea class="profiletextarea" name="gamedescription" rows="4" cols="50" maxlength="500"></textarea>

                <div class="profilelist">
					<div class="profilelisttext">
						Game Type
                    </div>
                    <input class="profilecheckbox" type="radio" name="gametype" value="InPerson">
                    <label class="profilecheckboxlabel">In Person</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Webcam">
                    <label class="profilecheckboxlabel">Online (Webcam)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Audio">
                    <label class="profilecheckboxlabel">Online (Audio)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="gametype" value="Online_Text">
                    <label class="profilecheckboxlabel">Online (Text Only)</label>
                </div>
                <div class="profilelist">
					<div class="profilelisttext">
						Game Rate
                    </div>
                    <input class="profilecheckbox" type="radio" name="rate" value="MoreThanOnceAWeek">
                    <label class="profilecheckboxlabel">More than Once a Week</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="Weekly">
                    <label class="profilecheckboxlabel">Weekly</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="EveryTwoWeeks">
                    <label class="profilecheckboxlabel">Every Two Weeks</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="Monthly">
                    <label class="profilecheckboxlabel">Monthly</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="rate" value="OnceInAWhile">
                    <label class="profilecheckboxlabel">Once In A While</label>
                </div>
				<div class="profilelist">
                    <div class="profilelisttext">
                        Status
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="gameactive" value="1">
                    <label class="profilecheckboxlabel">Active</label>
					<br>
					<input class="profilecheckbox" type="checkbox" name="playerswanted" value="1">
                    <label class="profilecheckboxlabel">Players Wanted</label>
					<br>
					<input class="profilecheckbox" type="checkbox" name="dmwanted" value="1">
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
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Early" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Early" value="1"></td>
                    </tr>
                    <tr>
                        <td class="headcol">Afternoon</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Afternoon" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Afternoon" value="1"></td>
                    </tr>
                    <tr>
                        <td class="headcol">Evening</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Evening" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Evening" value="1"></td>
                    </tr>
                    <tr>
                        <td class="headcol">Late Night</td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Night" value="1"></td>
                        <td><input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Night" value="1"></td>
                    </tr>
                </table>
                <div class="profileedittext">
                    Availability Notes
                </div>
                <textarea class="profiletextarea" name="gameavailnotes" rows="4" cols="50" maxlength="500"></textarea>

                <div class="profilelistnofloat">
                    <div class="profilelisttext">
                        System
                    </div>
                    <input class="profilecheckbox" type="radio" name="system" value="OldSchool">
                    <label class="profilecheckboxlabel">Old School/Old School Revival</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD3">
                    <label class="profilecheckboxlabel">D&amp;D 3.X/Pathfinder</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD4">
                    <label class="profilecheckboxlabel">D&amp;D 4</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="DD5">
                    <label class="profilecheckboxlabel">D&amp;D 5</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="PbtA">
                    <label class="profilecheckboxlabel">PbtA (Apoclypse World, Dungeon World, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="WoD">
                    <label class="profilecheckboxlabel">World of Darkness (Vampire, Werewolf, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="BurningWheel">
                    <label class="profilecheckboxlabel">Burning Wheel (Mouse Guard, Torch Bearer, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="Other">
                    <label class="profilecheckboxlabel">Other (Savage Worlds, GURPS, FATE, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="Homebrew">
                    <label class="profilecheckboxlabel">Homebrew</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="system" value="BoardGames">
                    <label class="profilecheckboxlabel">Board Games/MtG/Other Tabletop</label>
                </div>

				<div class="profilelist">
                    <div class="profilelisttext">
                        Genre
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="genre_Fantasy" value="1">
                    <label class="profilecheckboxlabel">Fantasy</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_SciFi" value="1">
                    <label class="profilecheckboxlabel">Sci-Fi</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Horror" value="1">
                    <label class="profilecheckboxlabel">Horror</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Modern" value="1">
                    <label class="profilecheckboxlabel">Modern</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Western" value="1">
                    <label class="profilecheckboxlabel">Western</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Historical" value="1">
                    <label class="profilecheckboxlabel">Historical</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_PostApocolypse" value="1">
                    <label class="profilecheckboxlabel">Post-Apocolypse</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Superhero" value="1">
                    <label class="profilecheckboxlacheckboxbel">Superhero</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Steampunk" value="1">
                    <label class="profilecheckboxlabel">Steampunk</label>
                </div>
				<div class="profilelist">
                    <div class="profilelisttext">
                        Style
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="style_Serious" value="1">
                    <label class="profilecheckboxlabel">Serious Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Silly" value="1">
                    <label class="profilecheckboxlabel">Silly Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Casual" value="1">
                    <label class="profilecheckboxlabel">Casual Game</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Powergaming" value="1">
                    <label class="profilecheckboxlabel">Power Gaming</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_GMVsPlayer" value="1">
                    <label class="profilecheckboxlabel">GM vs Player</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_PlayerVsPlayer" value="1">
                    <label class="profilecheckboxlabel">Player vs Player</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Rules
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="rules_Written" value="1">
                    <label class="profilecheckboxlabel">Rules as Written</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Interpreted" value="1">
                    <label class="profilecheckboxlabel">Rules as Interpreted</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Suggested" value="1">
                    <label class="profilecheckboxlabel">Rules as Suggested</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_HouseRules" value="1">
                    <label class="profilecheckboxlabel">House Rules</label>
                </div>
				<div style="clear: both"></div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Tone
                    </div>
                    <input class="profilecheckbox" type="radio" name="tone" value="PG13">
                    <label class="profilecheckboxlabel">PG-13</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="R">
                    <label class="profilecheckboxlabel">R</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="M">
                    <label class="profilecheckboxlabel">M</label>
                    <br>
                    <input class="profilecheckbox" type="radio" name="tone" value="XXX">
                    <label class="profilecheckboxlabel">XXX</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Other
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="other_Food" value="1">
                    <label class="profilecheckboxlabel">Food</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Alcohol" value="1">
                    <label class="profilecheckboxlabel">Alcohol</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Smoking" value="1">
                    <label class="profilecheckboxlabel">Smoking</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Drugs" value="1">
                    <label class="profilecheckboxlabel">Drugs</label>
                </div>
				<div style="clear: both"></div>
				<div class="profileedittext">
                    Other Game Notes
                </div>
				<textarea class="profiletextarea" name="gameothernotes" rows="4" cols="50" maxlength="500"></textarea>
				<div style="clear: both"></div>
				<input class="profileupdatebutton" type="submit" name="submit" value="Create Game">
            </form>
            <div style="clear: both"></div>
        </div>
    </div>

</div>
<!-- PROFILE END -->

<?php include 'footer.php' ?>
<?php include 'js.php' ?>

</body>
</html>
