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
    $name = "";
    $country = "";
    $location = "";
    $age = "";
    $gender = "";
    $selfdescription = "";
    $rpgexperience = "";
    $interests = "";
    
    $pic1 = "";
    $pic2 = "";
    $pic3 = "";
    
    $gametype;
    $rate;
    $early;
    $afternoon;
    $evening;
    $night;
    $availabilitynotes = "";
    
    $system;
    $play;
    $rules;
    $style;
    $genre;
    $tone;
    $other;
    $preferencenotes = "";
    
    if(isset($_REQUEST['name']))
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
        
        $requestname = test_input($_REQUEST['name']);
        
        //Create database query
        $sql = "SELECT * FROM players WHERE name='" . $requestname . "'";

        //Send query
        $result = $conn->query($sql);
        
        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {            
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $name = $row["name"];
                $country = $row["country"];
                $location = $row["location"];
                $age = $row["age"];
                $gender = $row["gender"];
                $selfdescription = $row["SelfDescription"];
                $rpgexperience = $row["RPGExperience"];
                $interests = $row["Interests"];
                
                $pic1 = $row["pic1"];
                $pic2 = $row["pic2"];
                $pic3 = $row["pic3"];
                
                $gametype = explode(", ", $row["gametype"]);
                $rate = explode(", ", $row["rate"]);
                $early = explode(", ", $row["avail_early"]);
                $afternoon = explode(", ", $row["avail_afternoon"]);
                $evening = explode(", ", $row["avail_evening"]);
                $night = explode(", ", $row["avail_night"]);
                $availabilitynotes = $row["AvailabilityNotes"];
                
                $system = explode(", ", $row["System"]);
                $play = explode(", ", $row["Play"]);
                $rules = explode(", ", $row["Rules"]);
                $style = explode(", ", $row["Style"]);
                $genre = explode(", ", $row["Genre"]);
                $tone = explode(", ", $row["Tone"]);
                $other = explode(", ", $row["Other"]);
                $preferencenotes = $row["PreferenceNotes"];
                
                $conn->close();
                
                $selfdescription = nl2br($selfdescription);
                $rpgexperience = nl2br($rpgexperience);
                $interests = nl2br($interests);
                $availabilitynotes = nl2br($availabilitynotes);
            }
        }
        else
        {
            $_SESSION["error"] = "Name not found.";
            $conn->close();
        }
    }
    unset ($_REQUEST['name']);
?>
    
<?php
    
function GetGames($player)
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
    $sql = "SELECT * FROM games
        WHERE gameowner='" . $player . "'";

    //Send query
    $result = $conn->query($sql);
     
	echo "<div class='profilecontents'>";
    //If there is more than 0 rows
    if ($result->num_rows > 0)
    {
        //Output data of each row
        while($row = $result->fetch_assoc()) 
        {
            echo "<a class='profilebox' href='game.php?gameid=" . $row['GameID'] . "'>" 
                    . "<div class='profileresulttitle' >" . $row['gamename'] . "</div>";
                echo "<div class='profileresultpiccontainer'>";
                    if(isset( $row['gamepicture']) && $row['gamepicture']):
                        echo "<img class='profileresultpic' src='" . $row['gamepicture'] . "'>";
                    else:
                        echo "<img class='nogamepic' src='img/nopicgamered.png'>";
                    endif;
                echo "</div>";
            echo "</a>";
        }
    }
    else
    {
        echo "<div class='profiletext'><b>No Games Created</b></div>";
    }
	echo "</div>";
    
    $conn->close();
}
    
function GetAge($age)
{
    switch($age)
    {
        case "age_LessThan20": echo "Less Than 20"; break;
        case "age_20to30": echo "20 to 30"; break;
        case "age_30to40": echo "30 to 40"; break;
        case "age_40to50": echo "40 to 50"; break;
        case "age_50to60": echo "50 to 60"; break;
        case "age_Over60": echo "Over 60"; break;
        default: echo "";
    }   
}
    
function GetGender($gender)
{
    switch($gender)
    {
        case "gender_Man": echo "Man"; break;
        case "gender_Woman": echo "Woman"; break;
        case "gender_Other": echo "Other"; break;
        default: echo "";
    }   
}

function GetGameType($gametype)
{
    $gametypestring = "";
    if(isset($gametype[0]) && $gametype[0]) $gametypestring = $gametypestring . "In Person, ";
    if(isset($gametype[1]) && $gametype[1]) $gametypestring = $gametypestring . "Online (Webcam), ";
    if(isset($gametype[2]) && $gametype[2]) $gametypestring = $gametypestring . "Online (Audio), ";
    if(isset($gametype[3]) && $gametype[3]) $gametypestring = $gametypestring . "Online (Text Only), ";
    if($gametypestring == "")
        echo "N/A";
    else
    {
        $gametypestring = trim($gametypestring, ", ");
        echo $gametypestring;
    }
}
    
function GetRate($rate)
{
    $ratestring = "";
    if(isset($rate[0]) && $rate[0]) $ratestring = $ratestring . "More than Once a Week, ";
    if(isset($rate[1]) && $rate[1]) $ratestring = $ratestring . "Weekly, ";
    if(isset($rate[2]) && $rate[2]) $ratestring = $ratestring . "Every Two Weeks, ";
    if(isset($rate[3]) && $rate[3]) $ratestring = $ratestring . "Monthly, ";
    if(isset($rate[4]) && $rate[4]) $ratestring = $ratestring . "Once In A While, ";
    if($ratestring == "")
        echo "N/A";
    else
    {
        $ratestring = trim($ratestring, ", ");
        echo $ratestring;
    }
}
    
function GetSystem($system)
{
    $systemstring = "";
    if(isset($system[0]) && $system[0]) $systemstring = $systemstring . "Old School/Old School Revival <br>";
    if(isset($system[1]) && $system[1]) $systemstring = $systemstring . "D&amp;D 3.X/Pathfinder<br>";
    if(isset($system[2]) && $system[2]) $systemstring = $systemstring . "D&amp;D 4<br>";
    if(isset($system[3]) && $system[3]) $systemstring = $systemstring . "D&amp;D 5<br>";
    if(isset($system[4]) && $system[4]) $systemstring = $systemstring . "PbtA (Apoclypse World, Dungeon World, ...)<br>";
    if(isset($system[5]) && $system[5]) $systemstring = $systemstring . "World of Darkness (Vampire, Werewolf, ...)<br>";
    if(isset($system[6]) && $system[6]) $systemstring = $systemstring . "Burning Wheel (Mouse Guard, Torch Bearer, ...)<br>";
    if(isset($system[7]) && $system[7]) $systemstring = $systemstring . "Other (Savage Worlds, GURPS, FATE, ...)<br>";
    if(isset($system[8]) && $system[8]) $systemstring = $systemstring . "Homebrew<br>";
    if(isset($system[9]) && $system[9]) $systemstring = $systemstring . "Board Games/MtG/Other Tabletop<br>";
    if($systemstring == "")
        echo "N/A";
    else
    {
        $systemstring = trim($systemstring, ", ");
        echo $systemstring;
    }
}
    
function GetPlay($play)
{
    $playstring = "";
    if(isset($play[0]) && $play[0]) $playstring = $playstring . "Willing to GM, ";
    if(isset($play[1]) && $play[1]) $playstring = $playstring . "Willing to Play, ";
    if(isset($play[2]) && $play[2]) $playstring = $playstring . "Willing to Hangout, ";
    if($playstring == "")
        echo "N/A";
    else
    {
        $playstring = trim($playstring, ", ");
        echo $playstring;
    }
}
    
function GetRules($rules)
{
    $rulesstring = "";
    if(isset($rules[0]) && $rules[0]) $rulesstring = $rulesstring . "Rules as Written, ";
    if(isset($rules[1]) && $rules[1]) $rulesstring = $rulesstring . "Rules as Interpreted, ";
    if(isset($rules[2]) && $rules[2]) $rulesstring = $rulesstring . "Rules as Suggested, ";
    if(isset($rules[3]) && $rules[3]) $rulesstring = $rulesstring . "House Rules, ";
    if($rulesstring == "")
        echo "N/A";
    else
    {
        $rulesstring = trim($rulesstring, ", ");
        echo $rulesstring;
    }
}
    
function GetStyle($stlye)
{
    $stylestring = "";
    if(isset($stlye[0]) && $stlye[0]) $stylestring = $stylestring . "Serious Roleplay, ";
    if(isset($stlye[1]) && $stlye[1]) $stylestring = $stylestring . "Silly Roleplay, ";
    if(isset($stlye[2]) && $stlye[2]) $stylestring = $stylestring . "Casual Game, ";
    if(isset($stlye[3]) && $stlye[3]) $stylestring = $stylestring . "Power Gaming, ";
    if(isset($stlye[4]) && $stlye[4]) $stylestring = $stylestring . "GM vs Player, ";
    if(isset($stlye[5]) && $stlye[5]) $stylestring = $stylestring . "Player vs Player, ";
    if($stylestring == "")
        echo "N/A";
    else
    {
        $stylestring = trim($stylestring, ", ");
        echo $stylestring;
    }
}
    
function GetGenre($genre)
{
    $genrestring = "";
    if(isset($genre[0]) && $genre[0]) $genrestring = $genrestring . "Fantasy, ";
    if(isset($genre[1]) && $genre[1]) $genrestring = $genrestring . "Sci-Fi, ";
    if(isset($genre[2]) && $genre[2]) $genrestring = $genrestring . "Horror, ";
    if(isset($genre[3]) && $genre[3]) $genrestring = $genrestring . "Modern, ";
    if(isset($genre[4]) && $genre[4]) $genrestring = $genrestring . "Western, ";
    if(isset($genre[5]) && $genre[5]) $genrestring = $genrestring . "Historical, ";
    if(isset($genre[6]) && $genre[6]) $genrestring = $genrestring . "Post-Apocolypse, ";
    if(isset($genre[7]) && $genre[7]) $genrestring = $genrestring . "Superhero, ";
    if(isset($genre[8]) && $genre[8]) $genrestring = $genrestring . "Steampunk, ";
    if($genrestring == "")
        echo "N/A";
    else
    {
        $genrestring = trim($genrestring, ", ");
        echo $genrestring;
    }
}
    
function GetTone($tone)
{
    $tonestring = "";
    if(isset($tone[0]) && $tone[0]) $tonestring = $tonestring . "PG-13, ";
    if(isset($tone[1]) && $tone[1]) $tonestring = $tonestring . "R, ";
    if(isset($tone[2]) && $tone[2]) $tonestring = $tonestring . "M, ";
    if(isset($tone[3]) && $tone[3]) $tonestring = $tonestring . "XXX, ";
    if($tonestring == "")
        echo "N/A";
    else
    {
        $tonestring = trim($tonestring, ", ");
        echo $tonestring;
    }
}
    
function GetOther($other)
{
    $otherstring = "";
    if(isset($other[0]) && $other[0]) $otherstring = $otherstring . "Food, ";
    if(isset($other[1]) && $other[1]) $otherstring = $otherstring . "Alcohol, ";
    if(isset($other[2]) && $other[2]) $otherstring = $otherstring . "Smoking, ";
    if(isset($other[3]) && $other[3]) $otherstring = $otherstring . "Drugs, ";
    if($otherstring == "")
        echo "N/A";
    else
    {
        $otherstring = trim($otherstring, ", ");
        echo $otherstring;
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

<!-- PROFILE START -->
<div class="profile">
    
    <div class="profilesection">
        <div class="profiletitle">
            <?php echo $name ?>
            <?php if(isset($_SESSION["name"]) && $name==$_SESSION["name"]): ?>
                <a class="profileeditbutton" href="editprofile.php">Edit Profile</a>
            <?php elseif(isset($_SESSION["name"])): ?>
                <form class="sendmessageform" method="post" action="sendnewmessage.php">
                    <input class='nonvisiblereplyinput' type='text' name='toplayer' value='<?php echo $name; ?>'>
                    <input class="sendnewmessagebutton" type='submit' name='submit' value="Send Message">
                </form>
            <?php endif; ?>
        </div>
        <div class="profilecontents">
            <div class="profiletext" style="display:none;">
                <b>Country: </b> <?php echo $country; ?>
            </div>
            <div class="profiletext">
                <b>Zip Code: </b> <?php echo $location; ?>
            </div>
            <div class="profiletext">
                <b>Age: </b> <?php GetAge($age); ?> 
            </div>
            <div class="profiletext">
                <b>Gender: </b> <?php GetGender($gender); ?>
            </div>
            <div class="profiletext">
                <b>Self Description</b> 
                <br>
                <?php echo $selfdescription ?>
            </div>
            <div class="profiletext">
                <b>RPG Experience</b> 
                <br>
                <?php echo $rpgexperience ?>
            </div>
            <div class="profiletext">
                <b>Interests</b>
                <br>
                <?php echo $interests ?>
            </div>
            <div class="profiletext">
                <b>Profile Pictures</b>
            </div>
            <div class="profilepics">
                <div class="profilepiccontainer">
                    <?php if(isset($pic1) && $pic1): ?>
                        <img class="profilepic" src="<?php echo $pic1; ?>">
                    <?php else: ?>
                        <img class="profilepic" src="img/nopicred.png">
                    <?php endif; ?>
                </div>
                <div class="profilepiccontainer">
                    <?php if(isset($pic2) && $pic2): ?>
                        <img class="profilepic" src="<?php echo $pic2 ?>">
                    <?php endif; ?>
                </div>
                <div class="profilepiccontainer">
                    <?php if(isset($pic3) && $pic3): ?>
                        <img class="profilepic" src="<?php echo $pic3 ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
    
    
    <div class="profilesection">
        <div class="profiletitle">
            Games
			<?php if(isset($_SESSION["name"]) && $name==$_SESSION["name"]): ?>
				<a class="profileeditbutton" href="newgame.php">Create Game</a>
            <?php endif; ?>
        </div>
        <?php GetGames($name) ?>
        <?php if(isset($_SESSION["name"]) && $name==$_SESSION["name"]): ?>
        
        <?php endif ?>
    </div>
    
    
    <div class="profilesection">
        <div class="profiletitle">Availability</div>
        <div class="profilecontents">
            <div class="profiletext">
                <b>Game Type: </b> <?php GetGameType($gametype) ?> 
            </div>
            <div class="profiletext">
                <b>Play Rate: </b> <?php GetRate($rate) ?>
            </div>
			<div>
				<div class="profiletext">
					<b>Weekly Availablity</b>
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
			</div>
            <div class="profiletext">
                <b>Availability Notes</b>
                <br>
                <?php echo $availabilitynotes ?>
            </div>
        </div>
    </div>
    
    <div class="profilesection">
        <div class="profiletitle">RPG Preferences</div>
        <div class="profilecontents">
            <div class="profiletext">
                <b>Systems</b>
                <br>
                <?php GetSystem($system); ?>
            </div>
            <div class="profiletext">
                <b>Play: </b> <?php GetPlay($play); ?>
            </div>
            <div class="profiletext">
                <b>Rules: </b> <?php GetRules($rules); ?>
            </div>
            <div class="profiletext">
                <b>Style: </b> <?php GetStyle($style); ?>
            </div>
            <div class="profiletext">
                <b>Genre: </b> <?php GetGenre($genre); ?>
            </div>
            <div class="profiletext">
                <b>Tone: </b> <?php GetTone($tone); ?>
            </div>
            <div class="profiletext">
                <b>Other: </b> <?php GetOther($other); ?>
            </div>
            <div class="profiletext">
                <b>Preference Notes</b>
                <br>
                <?php echo $preferencenotes ?>
            </div>
        </div>
    </div>
    
</div>
<!-- PROFILE END -->

<?php include 'footer.php' ?>
    
<?php include 'js.php' ?>
    
</body>
</html>