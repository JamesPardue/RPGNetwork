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
    $public;
    
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
    
    $email = "";
	$emailupdates = "";
    
    if(isset($_SESSION['name']))
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
        $sql = "SELECT * FROM players WHERE name='" . $_SESSION['name'] . "'";

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
                $public = $row["Public"];
                
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
                
                $email = $row["Email"];
				$emailupdates = $row["emailupdates"];
                
                $conn->close();
                
                $breaks = array("<br />", "<br>", "<br/>");  
                $selfdescription = str_ireplace($breaks, "\r\n", $selfdescription);
                $rpgexperience = str_ireplace($breaks, "\r\n", $rpgexperience);
                $interests = str_ireplace($breaks, "\r\n", $interests);
                $availabilitynotes = str_ireplace($breaks, "\r\n", $availabilitynotes);
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
            <?php echo $name ?>
        </div>
        <div class="profilecontents">
            <form class="profileinfo" method="post" action="updateprofile1.php">
                <div class="profileedittext" style="display:none;">
                    Country
                </div>
                <select class="profileselect" id="ID_CountrySelect" style="display:none;" name="country" onchange="ShowZipCode()">
                    <option value="None" <?php if($country == "" || $country == "None") echo "selected='selected'"; ?>>Select Country</option>
                    <option value="USA" <?php if($country == "USA") echo "selected='selected'"; ?>>USA</option>
                    <option value="China" <?php if($country == "China") echo "selected='selected'"; ?>>China</option>
                    <option value="France" <?php if($country == "France") echo "selected='selected'"; ?>>France</option>
                    <option value="Germany" <?php if($country == "Germany") echo "selected='selected'"; ?>>Germany</option>
                    <option value="Japan" <?php if($country == "Japan") echo "selected='selected'"; ?>>Japan</option>
                    <option value="United Kingdom" <?php if($country == "United Kingdom") echo "selected='selected'"; ?>>United Kingdom</option>
                </select>
                <div class="profileedittext" id="ID_ZipCodeLabel" onload="ShowZipCode()">
                    Zip Code
                </div>
                <input class="profileinput" id="ID_ZipCodeInput" onload="ShowZipCode()" 
                    type="text" name="location" size="25" maxlength="5" value="<?php echo $location ?>">
                <?php if(isset($_SESSION["ziperror"]) && $_SESSION["ziperror"] != ""): ?>
                    <div class="profileerror">
                        <?php echo $_SESSION["ziperror"] ?>
                    </div>
                <?php endif; ?>
                <div class="profileedittext">
                    Age
                </div>
                <select class="profileselect" name="age">
                    <option value="age_None" <?php if($age == "") echo "selected='selected'"; ?>>Select Age</option>
                    <option value="age_LessThan20" <?php if($age == "age_LessThan20") echo "selected='selected'"; ?>>Less than 20</option>
                    <option value="age_20to30" <?php if($age == "age_20to30") echo "selected='selected'"; ?>>20 - 30</option>
                    <option value="age_30to40" <?php if($age == "age_30to40") echo "selected='selected'"; ?>>30 - 40</option>
                    <option value="age_40to50" <?php if($age == "age_40to50") echo "selected='selected'"; ?>>40 - 50</option>
                    <option value="age_50to60" <?php if($age == "age_50to60") echo "selected='selected'"; ?>>50 - 60</option>
                    <option value="age_Over60" <?php if($age == "age_Over60") echo "selected='selected'"; ?>>Over 60</option>
                </select>
                <div class="profileedittext">
                    Gender
                </div>
                <select class="profileselect" name="gender">
                    <option value="" <?php if($gender == "") echo "selected='selected'"; ?>>Select Gender</option>
                    <option value="gender_Man" <?php if($gender == "gender_Man") echo "selected='selected'"; ?>>Man</option>
                    <option value="gender_Woman" <?php if($gender == "gender_Woman") echo "selected='selected'"; ?>>Woman</option>
                    <option value="gender_Other" <?php if($gender == "gender_Other") echo "selected='selected'"; ?>>Other</option>
                </select>
                <div class="profileedittext">
                    Self Description
                </div>
                <textarea class="profiletextarea" name="selfdescription" rows="4" cols="50" maxlength="500"><?php echo $selfdescription ?></textarea>
                <div class="profileedittext">
                    RPG Experience
                </div>
                <textarea class="profiletextarea" name="rpgexperience" rows="4" cols="50" maxlength="500"><?php echo $rpgexperience ?></textarea>
                <div class="profileedittext">
                    Interests
                </div>
                <textarea class="profiletextarea" name="interests" rows="4" cols="50" maxlength="500"><?php echo $interests ?></textarea>
                <div class="">
                    <div class="profilelisttext">
                        Visiblity
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="public" value="1" 
                        <?php if(isset($public) && $public) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Public (Visable in Search)</label>
                </div>
                <input class="profileupdatebutton" action="updateprofile1.php" type="submit" name="submit" value="Update">
            </form>
            <div class="profilepics">
                <div class="profileedittext">
                    Profile Pictures
                </div>
                <?php if(isset($_SESSION["picuploaderror"])): ?>
                    <div class="profiletext"><i><?php echo $_SESSION["picuploaderror"]; ?></i></div>
                    <?php echo $_SESSION["picuploaderror"] = ""; ?>
                <?php endif; ?>
                
                <div class="profilepiccontainer">
                    <?php if(isset($pic1) && $pic1): ?>
                        <img class="profilepic" src="<?php echo $pic1 ?>">
                    <?php else: ?>
                        <img class="profilepic" src="img/nopicred.png">
                    <?php endif; ?>
                    <form class="profilehiddenbutton" style="display:none;" action="uploadpic.php" method="post" enctype="multipart/form-data">
                        <input class="profilehiddenbutton" id="file1" type="file" name="fileToUpload">
                        <input class="profilehiddenbutton" id="submit1" type="submit" name="submit" value="Submit">
                        <input type="hidden" name="piclabel" value="pic1">
                    </form>
                    <div>
                        <button class="profilepicupdatebutton" onclick="UploadPic(1);">Upload Profile Pic</button>
                    </div>
                    <?php if(isset($pic1) && $pic1): ?>
                        <form method="post" action="deletepic.php">
                            <input type="hidden" name="piclabel" value="pic1">
                            <input class="profilepicupdatebutton" type="submit" value="Delete Pic" name="submit">
                        </form>
                    <?php endif; ?>
                </div>
                <div style="clear: both"></div>
				<hr>
                <div class="profilepiccontainer">
                    <?php if(isset($pic2) && $pic2): ?>
                        <img class="profilepic" src="<?php echo $pic2 ?>">
                    <?php endif; ?>
                    <form class="profilehiddenbutton" style="display:none;" action="uploadpic.php" method="post" enctype="multipart/form-data">
                        <input class="profilehiddenbutton" id="file2" type="file" name="fileToUpload">
                        <input class="profilehiddenbutton" id="submit2" type="submit" name="submit" value="Submit">
                        <input type="hidden" name="piclabel" value="pic2">
                    </form>
                    <div>
                        <button class="profilepicupdatebutton" onclick="UploadPic(2);">Upload Pic</button>
                    </div>
                    <?php if(isset($pic2) && $pic2): ?>
                        <form method="post" action="deletepic.php">
                            <input type="hidden" name="piclabel" value="pic2">
                            <input class="profilepicupdatebutton" type="submit" value="Delete Pic" name="submit">
                        </form>
                    <?php endif; ?>
                </div>
                <div style="clear: both"></div>  
				<hr>				
                <div class="profilepiccontainer">
                    <?php if(isset($pic3) && $pic3): ?>
                        <img class="profilepic" src="<?php echo $pic3 ?>">
                    <?php endif; ?>
                    <form class="profilehiddenbutton" style="display:none;" action="uploadpic.php" method="post" enctype="multipart/form-data">
                        <input class="profilehiddenbutton" id="file3" type="file" name="fileToUpload">
                        <input class="profilehiddenbutton" id="submit3" type="submit" name="submit" value="Submit">
                        <input type="hidden" name="piclabel" value="pic3">
                    </form>
                    <div>
                        <button class="profilepicupdatebutton" onclick="UploadPic(3);">Upload Pic</button>
                    </div>
                    <?php if(isset($pic3) && $pic3): ?>
                        <form method="post" action="deletepic.php">
                            <input type="hidden" name="piclabel" value="pic3">
                            <input class="profilepicupdatebutton" type="submit" value="Delete Pic" name="submit">
                        </form>
                    <?php endif; ?>
                </div>
                
                <div style="clear: both"></div>
            </div>
            <div style="clear: both"></div>
            
        </div>
    </div>

    <div class="profilesection">
        <div class="profiletitle">Availability</div>
        <div class="profilecontents">
            <form class="profileinfo" method="post" action="updateprofile2.php">
                <div class="profilelist">
                    <div class="profilelisttext">
                        Game Type
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="gametype_InPerson" value="1" 
                        <?php if(isset($gametype[0]) && $gametype[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">In Person</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="gametype_OnlineWebcam" value="1"
                        <?php if(isset($gametype[1]) && $gametype[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Webcam)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="gametype_OnlineAudio" value="1"
                        <?php if(isset($gametype[2]) && $gametype[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Audio)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="gametype_OnlineTextOnly" value="1"
                        <?php if(isset($gametype[3]) && $gametype[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Online (Text Only)</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Play Rate
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="rate_MoreThanOnceAWeek" value="1"
                        <?php if(isset($rate[0]) && $rate[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">More than Once a Week</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rate_Weekly" value="1" 
                        <?php if(isset($rate[1]) && $rate[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Weekly</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rate_EveryTwoWeeks" value="1"
                        <?php if(isset($rate[2]) && $rate[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Every Two Weeks</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rate_Monthly" value="1"
                        <?php if(isset($rate[3]) && $rate[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Monthly</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rate_OnceInAWhile" value="1"
                        <?php if(isset($rate[4]) && $rate[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Once In A While</label>
                </div>
                <div style="clear: both"></div>
                <div class="profileedittext">
                        Weekly Availability
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
                <textarea class="profiletextarea" name="AvailabilityNotes" rows="4" cols="50" maxlength="500"><?php echo $availabilitynotes ?></textarea>
                <input class="profileupdatebutton" type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>        
    
    <div class="profilesection">
        <div class="profiletitle">RPG Preferences</div>
        <div class="profilecontents">
            <form class="profileinfo" method="post" action="updateprofile3.php">
                <div class="profilelistnofloat">
                    <div class="profilelisttext">
                        System
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="system_OldSchool" value="1"
                        <?php if(isset($system[0]) && $system[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Old School/Old School Revival</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_DD3" value="1"
                        <?php if(isset($system[1]) && $system[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 3.X/Pathfinder</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_DD4" value="1"
                        <?php if(isset($system[2]) && $system[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 4</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_DD5" value="1"
                        <?php if(isset($system[3]) && $system[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">D&amp;D 5</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_PbtA" value="1"
                        <?php if(isset($system[4]) && $system[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">PbtA (Apoclypse World, Dungeon World, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_WoD" value="1"
                        <?php if(isset($system[5]) && $system[5]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">World of Darkness (Vampire, Werewolf, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_BurningWheel" value="1"
                        <?php if(isset($system[6]) && $system[6]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Burning Wheel (Mouse Guard, Torch Bearer, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_Other" value="1"
                        <?php if(isset($system[7]) && $system[7]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Other (Savage Worlds, GURPS, FATE, ...)</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_Hombrew" value="1"
                        <?php if(isset($system[8]) && $system[8]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Homebrew</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="system_BoardGames" value="1"
                        <?php if(isset($system[9]) && $system[9]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Board Games/MtG/Other Tabletop</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Play
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="play_WillingGM" value="1"
                        <?php if(isset($play[0]) && $play[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Willing to GM</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="play_WillingPlay" value="1"
                        <?php if(isset($play[1]) && $play[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Willing to Play</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="play_Hangout" value="1"
                        <?php if(isset($play[2]) && $play[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Willing to Hangout</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Rules
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="rules_Written" value="1"
                        <?php if(isset($rules[0]) && $rules[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Written</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Interpreted" value="1"
                        <?php if(isset($rules[1]) && $rules[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Interpreted</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_Suggested" value="1"
                        <?php if(isset($rules[2]) && $rules[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Rules as Suggested</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="rules_HouseRules" value="1"
                        <?php if(isset($rules[3]) && $rules[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">House Rules</label>
                </div>
                <div style="clear: both"></div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Style
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="style_Serious" value="1"
                        <?php if(isset($style[0]) && $style[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Serious Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Silly" value="1"
                        <?php if(isset($style[1]) && $style[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Silly Roleplay</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Casual" value="1"
                        <?php if(isset($style[2]) && $style[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Casual Game</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_Powergaming" value="1"
                        <?php if(isset($style[3]) && $style[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Power Gaming</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_GMVsPlayer" value="1"
                        <?php if(isset($style[4]) && $style[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">GM vs Player</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="style_PlayerVsPlayer" value="1"
                        <?php if(isset($style[5]) && $style[5]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Player vs Player</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Genre
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="genre_Fantasy" value="1"
                        <?php if(isset($genre[0]) && $genre[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Fantasy</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_SciFi" value="1"
                        <?php if(isset($genre[1]) && $genre[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Sci-Fi</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Horror" value="1"
                        <?php if(isset($genre[2]) && $genre[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Horror</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Modern" value="1"
                        <?php if(isset($genre[3]) && $genre[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Modern</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Western" value="1"
                        <?php if(isset($genre[4]) && $genre[4]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Western</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Historical" value="1"
                        <?php if(isset($genre[5]) && $genre[5]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Historical</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_PostApocolypse" value="1"
                        <?php if(isset($genre[6]) && $genre[6]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Post-Apocolypse</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Superhero" value="1"
                        <?php if(isset($genre[7]) && $genre[7]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Superhero</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="genre_Steampunk" value="1"
                        <?php if(isset($genre[8]) && $genre[8]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Steampunk</label>
                </div>
                <div style="clear: both"></div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Tone
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="tone_PG13" value="1"
                        <?php if(isset($tone[0]) && $tone[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">PG-13</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="tone_R" value="1"
                        <?php if(isset($tone[1]) && $tone[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">R</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="tone_M" value="1"
                        <?php if(isset($tone[2]) && $tone[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">M</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="tone_XXX" value="1"
                        <?php if(isset($tone[3]) && $tone[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">XXX</label>
                </div>
                <div class="profilelist">
                    <div class="profilelisttext">
                        Other
                    </div>
                    <input class="profilecheckbox" type="checkbox" name="other_Food" value="1"
                        <?php if(isset($other[0]) && $other[0]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Food</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Alcohol" value="1"
                        <?php if(isset($other[1]) && $other[1]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Alcohol</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Smoking" value="1"
                        <?php if(isset($other[2]) && $other[2]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Smoking</label>
                    <br>
                    <input class="profilecheckbox" type="checkbox" name="other_Drugs" value="1"
                        <?php if(isset($other[3]) && $other[3]) echo "checked"; ?>>
                    <label class="profilecheckboxlabel">Drugs</label>
                </div>
                <div style="clear: both"></div>
                <div class="profileedittext">
                    Preference Notes
                </div>
                <textarea class="profiletextarea" name="PreferenceNotes" rows="4" cols="50" maxlength="500"><?php echo $preferencenotes ?></textarea>
                <div style="clear: both"></div>
                <input class="profileupdatebutton" type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>
    
    <div class="profilesection">
        <div class="profiletitle">Email</div>
		<div class="profileemaillabel"><i>Email addresses are not required to use the site, but can be added optionally in case of forgotten passwords and to recieve email updates for unread messages.</i></div>
        <div class="emailconfirmationcheckboxarea">
			<input class="profilecheckbox" type="checkbox" name="emailconfirmed" value="1" disabled
				<?php if(isset($email) && $email != "") echo "checked"; ?>>
			<label class="profilecheckboxlabel"><b>Email Confirmed</b></label>
		</div>
		<div class="profilecontents">
            <?php if(isset($_SESSION['emailerror'])): ?>
                <div class="profiletext"><i><?php echo $_SESSION['emailerror']; ?></i></div>
                <?php echo $_SESSION['emailerror'] = ""; ?>
            <?php endif; ?>
            <form class="profileinfo" method="post" action="setemail.php">
                <div class="profileedittext">
                    Email Address
                </div>	
                <input class="profileinput" type="text" name="email" size="45" maxlength="35" 
					value="<?php 
						if(isset($_SESSION['email']))
							echo $_SESSION['email'];
						elseif(isset($email))
							echo $email;
					?>">
                <input class="profileupdatebutton" type="submit" name="submit" value="Send Confirmation Code">
            </form>
            <form class="profileinfo" method="post" action="confirmemail.php">
                <div class="profileedittext">
                    Confirmation Code
                </div>
                <input class="profileinput" type="text" name="confirm" size="45" maxlength="35">
                <input class="profileupdatebutton" type="submit" name="submit" value="Confirm Email">
            </form>
			<form class="profileinfo" method="post" action="emailupdates.php">
                <div class="profileedittext">
                    Email Updates
                </div>
				<div class="profileemaillabel" style="margin-top: -5px; margin-bottom: 2px; margin-left:0px;">
					<i>When turned on, this feature will send an email to inform you of unread messaged over 2 days old.</i>
				</div>
				<input type="hidden" name="name" value="<?php echo $_SESSION['name'] ?>">
                <input class="profilecheckbox" type="checkbox" name="emailupdates" value="1"
					<?php if((!isset($email)) || (isset($email) && $email == "")) echo "disabled"; ?>
					<?php if((isset($emailupdates)) && $emailupdates == "1") echo "checked"; ?>>
				<label class="profilecheckboxlabel"><b>Receive Email Updates</b></label>
                <input class="profileupdatebutton" type="submit" name="submit" value="Add/Remove Email Updates"
					<?php if((!isset($email)) || (isset($email) && $email == "")) echo "disabled"; ?>>
            </form>
			<form class="profileinfo" method="post" action="removeemail.php">
                <div class="profileedittext">Remove Email On File</div>
				<input type="hidden" name="name" value="<?php echo $_SESSION['name'] ?>">
                <input class="profileupdatebutton" type="submit" name="submit" value="Remove Email"
					<?php if((!isset($email)) || (isset($email) && $email == "")) echo "disabled"; ?>>
            </form>
        </div>
    </div>
	
    <div class="profilesection">
        <div class="profiletitle">
			Other
        </div>
        <div class="profilecontents">
			<form class="profileinfo" method="post" action="deleteprofile.php">
				<input type="hidden" name="name" value="<?php echo $_SESSION['name'] ?>">
				<input class="profileupdatebutton" style="margin-top:10px;" type="submit" name="submit" value="Delete Profile">
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
    else if (num == '2')
    {
        file = "file2";
        submit = "submit2";
    }
    else if (num == '3')
    {
        file = "file3";
        submit = "submit3";
    }
    
    document.getElementById(file).click();
    document.getElementById(file).onchange = 
        function() 
        {
            document.getElementById(submit).click();
        };
}
    
function ShowZipCode()
{
    var x = document.getElementById("ID_CountrySelect").value;
    if(x == 'USA')
    {
        document.getElementById("ID_ZipCodeLabel").classList.remove("profileselecthidden");
        document.getElementById("ID_ZipCodeInput").classList.remove("profileselecthidden");
    }
    else
    {
        document.getElementById("ID_ZipCodeLabel").classList.add("profileselecthidden");
        document.getElementById("ID_ZipCodeInput").classList.add("profileselecthidden");
    }
}

</script>    
    
<?php include 'js.php' ?>
    
</body>
</html>