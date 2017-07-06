<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Location
    if(isset($_POST["location"]) && is_numeric($_POST["location"]))
    {
        //$_SESSION["ziperror"] = "";
        $_SESSION["gamesearchlocation"] = (int)$_POST["location"];
    }
    if(isset($_POST["distance"]))
    {
        if($_POST["distance"] == "dist_10")
            $_SESSION["gamesearchdist"] = 10;
        elseif($_POST["distance"] == "dist_25")
            $_SESSION["gamesearchdist"] = 25;
        elseif($_POST["distance"] == "dist_50")
            $_SESSION["gamesearchdist"] = 50;
        elseif($_POST["distance"] == "dist_100")
            $_SESSION["gamesearchdist"] = 100;
        elseif($_POST["distance"] == "dist_any")
            $_SESSION["gamesearchdist"] = 0;
    }
	
    if(!isset($_SESSION['gamegametype']))
        $_SESSION['gamegametype'] = array("0", "0", "0", "0");
    if(isset($_POST["gametype_InPerson"]))
        $_SESSION['gamegametype'][0] = $_POST["gametype_InPerson"];
    if(isset($_POST["gametype_OnlineWebcam"]))
        $_SESSION['gamegametype'][1] = $_POST["gametype_OnlineWebcam"];
    if(isset($_POST["gametype_OnlineAudio"]))
        $_SESSION['gamegametype'][2] = $_POST["gametype_OnlineAudio"];
    if(isset($_POST["gametype_OnlineTextOnly"]))
        $_SESSION['gamegametype'][3] = $_POST["gametype_OnlineTextOnly"];
        
    if(!isset($_SESSION['gameplayrate']))
        $_SESSION['gameplayrate'] = array("0", "0", "0", "0", "0");
    if(isset($_POST["rate_MoreThanOnceAWeek"]))
        $_SESSION['gameplayrate'][0] = $_POST["rate_MoreThanOnceAWeek"];
    if(isset($_POST["rate_Weekly"]))
        $_SESSION['gameplayrate'][1] = $_POST["rate_Weekly"];
    if(isset($_POST["rate_EveryTwoWeeks"]))
        $_SESSION['gameplayrate'][2] = $_POST["rate_EveryTwoWeeks"];
    if(isset($_POST["rate_Monthly"]))
        $_SESSION['gameplayrate'][3] = $_POST["rate_Monthly"];
    if(isset($_POST["rate_OnceInAWhile"]))
        $_SESSION['gameplayrate'][4] = $_POST["rate_OnceInAWhile"];
    
    if(!isset($_SESSION['gameearly']))
        $_SESSION['gameearly'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Early"]))
        $_SESSION['gameearly'][0] = $_POST["avail_Mon_Early"];
    if(isset($_POST["avail_Tue_Early"]))
        $_SESSION['gameearly'][1] = $_POST["avail_Tue_Early"];
    if(isset($_POST["avail_Wed_Early"]))
        $_SESSION['gameearly'][2] = $_POST["avail_Wed_Early"];
    if(isset($_POST["avail_Thu_Early"]))
        $_SESSION['gameearly'][3] = $_POST["avail_Thu_Early"];
    if(isset($_POST["avail_Fri_Early"]))
        $_SESSION['gameearly'][4] = $_POST["avail_Fri_Early"];
    if(isset($_POST["avail_Sat_Early"]))
        $_SESSION['gameearly'][5] = $_POST["avail_Sat_Early"];
    if(isset($_POST["avail_Sun_Early"]))
        $_SESSION['gameearly'][6] = $_POST["avail_Sun_Early"];
    
    if(!isset($_SESSION['gameafternoon']))
        $_SESSION['gameafternoon'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Afternoon"]))
        $_SESSION['gameafternoon'][0] = $_POST["avail_Mon_Afternoon"];
    if(isset($_POST["avail_Tue_Afternoon"]))
        $_SESSION['gameafternoon'][1] = $_POST["avail_Tue_Afternoon"];
    if(isset($_POST["avail_Wed_Afternoon"]))
        $_SESSION['gameafternoon'][2] = $_POST["avail_Wed_Afternoon"];
    if(isset($_POST["avail_Thu_Afternoon"]))
        $_SESSION['gameafternoon'][3] = $_POST["avail_Thu_Afternoon"];
    if(isset($_POST["avail_Fri_Afternoon"]))
        $_SESSION['gameafternoon'][4] = $_POST["avail_Fri_Afternoon"];
    if(isset($_POST["avail_Sat_Afternoon"]))
        $_SESSION['gameafternoon'][5] = $_POST["avail_Sat_Afternoon"];
    if(isset($_POST["avail_Sun_Afternoon"]))
        $_SESSION['gameafternoon'][6] = $_POST["avail_Sun_Afternoon"];
    
    if(!isset($_SESSION['gameevening']))
        $_SESSION['gameevening'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Evening"]))
        $_SESSION['gameevening'][0] = $_POST["avail_Mon_Evening"];
    if(isset($_POST["avail_Tue_Evening"]))
        $_SESSION['gameevening'][1] = $_POST["avail_Tue_Evening"];
    if(isset($_POST["avail_Wed_Evening"]))
        $_SESSION['gameevening'][2] = $_POST["avail_Wed_Evening"];
    if(isset($_POST["avail_Thu_Evening"]))
        $_SESSION['gameevening'][3] = $_POST["avail_Thu_Evening"];
    if(isset($_POST["avail_Fri_Evening"]))
        $_SESSION['gameevening'][4] = $_POST["avail_Fri_Evening"];
    if(isset($_POST["avail_Sat_Evening"]))
        $_SESSION['gameevening'][5] = $_POST["avail_Sat_Evening"];
    if(isset($_POST["avail_Sun_Evening"]))
        $_SESSION['gameevening'][6] = $_POST["avail_Sun_Evening"];
    
    if(!isset($_SESSION['gamenight']))
        $_SESSION['gamenight'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Night"]))
        $_SESSION['gamenight'][0] = $_POST["avail_Mon_Night"];
    if(isset($_POST["avail_Tue_Night"]))
        $_SESSION['gamenight'][1] = $_POST["avail_Tue_Night"];
    if(isset($_POST["avail_Wed_Night"]))
        $_SESSION['gamenight'][2] = $_POST["avail_Wed_Night"];
    if(isset($_POST["avail_Thu_Night"]))
        $_SESSION['gamenight'][3] = $_POST["avail_Thu_Night"];
    if(isset($_POST["avail_Fri_Night"]))
        $_SESSION['gamenight'][4] = $_POST["avail_Fri_Night"];
    if(isset($_POST["avail_Sat_Night"]))
        $_SESSION['gamenight'][5] = $_POST["avail_Sat_Night"];
    if(isset($_POST["avail_Sun_Night"]))
        $_SESSION['gamenight'][6] = $_POST["avail_Sun_Night"];
    
    //System
    if(!isset($_SESSION['gamesystem']))
        $_SESSION['gamesystem'] = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["system_OldSchool"]))
        $_SESSION['gamesystem'][0] = $_POST["system_OldSchool"];
    if(isset($_POST["system_DD3"]))
        $_SESSION['gamesystem'][1] = $_POST["system_DD3"];
    if(isset($_POST["system_DD4"]))
        $_SESSION['gamesystem'][2] = $_POST["system_DD4"];
    if(isset($_POST["system_DD5"]))
        $_SESSION['gamesystem'][3] = $_POST["system_DD5"];
    if(isset($_POST["system_PbtA"]))
        $_SESSION['gamesystem'][4] = $_POST["system_PbtA"];
    if(isset($_POST["system_WoD"]))
        $_SESSION['gamesystem'][5] = $_POST["system_WoD"];
    if(isset($_POST["system_BurningWheel"]))
        $_SESSION['gamesystem'][6] = $_POST["system_BurningWheel"];
    if(isset($_POST["system_Other"]))
        $_SESSION['gamesystem'][7] = $_POST["system_Other"];
    if(isset($_POST["system_Hombrew"]))
        $_SESSION['gamesystem'][8] = $_POST["system_Hombrew"];
    if(isset($_POST["system_BoardGames"]))
        $_SESSION['gamesystem'][9] = $_POST["system_BoardGames"];
    
    //Play Style    
    if(!isset($_SESSION['gamerules']))
        $_SESSION['gamerules'] = array("0", "0", "0", "0");
    if(isset($_POST["rules_Written"]))
        $_SESSION['gamerules'][0] = $_POST["rules_Written"];
    if(isset($_POST["rules_Interpreted"]))
        $_SESSION['gamerules'][1] = $_POST["rules_Interpreted"];
    if(isset($_POST["rules_Suggested"]))
        $_SESSION['gamerules'][2] = $_POST["rules_Suggested"];
    if(isset($_POST["rules_HouseRules"]))
        $_SESSION['gamerules'][3] = $_POST["rules_HouseRules"];
    
    if(!isset($_SESSION['gamestyle']))
        $_SESSION['gamestyle'] = array("0", "0", "0", "0");
    if(isset($_POST["style_Serious"]))
        $_SESSION['gamestyle'][0] = $_POST["style_Serious"];
    if(isset($_POST["style_Silly"]))
        $_SESSION['gamestyle'][1] = $_POST["style_Silly"];
    if(isset($_POST["style_Casual"]))
        $_SESSION['gamestyle'][2] = $_POST["style_Casual"];
    if(isset($_POST["style_Power"]))
        $_SESSION['gamestyle'][3] = $_POST["style_Power"];
    
    if(!isset($_SESSION['gamegenre']))
        $_SESSION['gamegenre'] = array("0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["genre_Fantasy"]))
        $_SESSION['gamegenre'][0] = $_POST["genre_Fantasy"];
    if(isset($_POST["genre_SciFi"]))
        $_SESSION['gamegenre'][1] = $_POST["genre_SciFi"];
    if(isset($_POST["genre_Horror"]))
        $_SESSION['gamegenre'][2] = $_POST["genre_Horror"];
    if(isset($_POST["genre_Modern"]))
        $_SESSION['gamegenre'][3] = $_POST["genre_Modern"];
    if(isset($_POST["genre_Western"]))
        $_SESSION['gamegenre'][4] = $_POST["genre_Western"];
    if(isset($_POST["genre_Historical"]))
        $_SESSION['gamegenre'][5] = $_POST["genre_Historical"];
    if(isset($_POST["genre_PostApocolypse"]))
        $_SESSION['gamegenre'][6] = $_POST["genre_PostApocolypse"];
    if(isset($_POST["genre_Superhero"]))
        $_SESSION['gamegenre'][7] = $_POST["genre_Superhero"];
    if(isset($_POST["genre_Steampunk"]))
        $_SESSION['gamegenre'][8] = $_POST["genre_Steampunk"];
    
    //Other
	if(isset($_POST["gameactive"]))
        $_SESSION['gameactive'] = $_POST["gameactive"];
	elseif(!isset($_SESSION['gameactive']))
		$_SESSION['gameactive'] = '1';
		
	if(isset($_POST["playerswanted"]))
        $_SESSION['playerswanted'] = $_POST["playerswanted"];
	elseif(!isset($_SESSION['playerswanted']))
		$_SESSION['playerswanted'] = '1';
	
	if(isset($_POST["dmwanted"]))
        $_SESSION['dmwanted'] = $_POST["dmwanted"];
	elseif(!isset($_SESSION['dmwanted']))
		$_SESSION['dmwanted'] = '1';
	
    if(!isset($_SESSION['gametone']))
        $_SESSION['gametone'] = array("0", "0", "0", "0");
    if(isset($_POST["tone_PG13"]))
        $_SESSION['gametone'][0] = $_POST["tone_PG13"];
    if(isset($_POST["tone_R"]))
        $_SESSION['gametone'][1] = $_POST["tone_R"];
    if(isset($_POST["tone_M"]))
        $_SESSION['gametone'][2] = $_POST["tone_M"];
    if(isset($_POST["tone_XXX"]))
        $_SESSION['gametone'][3] = $_POST["tone_XXX"];
    
    if(!isset($_SESSION['gameother']))
        $_SESSION['gameother'] = array("0", "0", "0", "0");
    if(isset($_POST["other_Food"]))
        $_SESSION['gameother'][0] = $_POST["other_Food"];
    if(isset($_POST["other_Alcohol"]))
        $_SESSION['gameother'][1] = $_POST["other_Alcohol"];
    if(isset($_POST["other_Smoking"]))
        $_SESSION['gameother'][2] = $_POST["other_Smoking"];
    if(isset($_POST["other_Drugs"]))
        $_SESSION['gameother'][3] = $_POST["other_Drugs"];

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
    $sql = "SELECT * FROM games";

    //Send query
    $result = $conn->query($sql);
        
    $matches = 0;
	
    //If there is more than 0 rows
    if ($result->num_rows > 0)
    {
		$gamelist = array();

        //Output data of each row
        while($row = $result->fetch_assoc()) 
        {
            if(1)
            {
                //Availability
                $match_gametype = "false";
                if(isset($_SESSION['gamegametype']))
                {
                    $getgametype = "";
                    if(isset($row["gametype"]))
                        $getgametype = $row["gametype"];
					
                    if($_SESSION['gamegametype'][0] == "0" && $_SESSION['gamegametype'][1] == "0" 
                       && $_SESSION['gamegametype'][2] == "0" && $_SESSION['gamegametype'][3] == "0")
                        $match_gametype = "true";
                    elseif($_SESSION['gamegametype'][0] == "1" && ($getgametype == "InPerson"))
                        $match_gametype = "true";
                    elseif($_SESSION['gamegametype'][1] == "1" && ($getgametype == "Online_Webcam"))
                        $match_gametype = "true";
                    elseif($_SESSION['gamegametype'][2] == "1" && ($getgametype == "Online_Audio"))
                        $match_gametype = "true";
                    elseif($_SESSION['gamegametype'][3] == "1" && ($getgametype == "Online_Text"))
                        $match_gametype = "true";
                }
                else
                    $match_gametype = "true";

                $match_playrate = "false";
                if(isset($_SESSION['gameplayrate']))
                {
                    $getplayrate = "";
                    if(isset($row["gamerate"]))
                        $getplayrate = $row["gamerate"];

                    if($_SESSION['gameplayrate'][0] == "0" && $_SESSION['gameplayrate'][1] == "0" && $_SESSION['gameplayrate'][2] == "0"
                       && $_SESSION['gameplayrate'][3] == "0" && $_SESSION['gameplayrate'][4] == "0")
                        $match_playrate = "true";
                    elseif($_SESSION['gameplayrate'][0] == "1" && ($getplayrate == "MoreThanOnceAWeek"))
                        $match_playrate = "true";
                    elseif($_SESSION['gameplayrate'][1] == "1" && ($getplayrate == "Weekly"))
                        $match_playrate = "true";
                    elseif($_SESSION['gameplayrate'][2] == "1" && ($getplayrate == "EveryTwoWeeks"))
                        $match_playrate = "true";
                    elseif($_SESSION['gameplayrate'][3] == "1" && ($getplayrate == "Monthly"))
                        $match_playrate = "true";
                    elseif($_SESSION['gameplayrate'][4] == "1" && ($getplayrate == "OnceInAWhile"))
                        $match_playrate = "true";
                }
                else
                    $match_playrate = "true";

                $match_time = "false";
                if(isset($_SESSION['gameearly']) || isset($_SESSION['gameafternoon']) || 
                    isset($_SESSION['gameevening']) || isset($_SESSION['gamenight']))
                {
                    $match_early = "false";
                    $match_afternoon = "false";
                    $match_evening = "false";
                    $match_night = "false";

                    if(($_SESSION['gameearly'][0] == "0" && $_SESSION['gameearly'][1] == "0" && $_SESSION['gameearly'][2] == "0"
                            && $_SESSION['gameearly'][3] == "0" && $_SESSION['gameearly'][4] == "0"
                            && $_SESSION['gameearly'][5] == "0" && $_SESSION['gameearly'][6] == "0")
                        && ($_SESSION['gameafternoon'][0] == "0" && $_SESSION['gameafternoon'][1] == "0" && $_SESSION['gameafternoon'][2] == "0"
                            && $_SESSION['gameafternoon'][3] == "0" && $_SESSION['gameafternoon'][4] == "0"
                            && $_SESSION['gameafternoon'][5] == "0" && $_SESSION['gameafternoon'][6] == "0")
                        && ($_SESSION['gameevening'][0] == "0" && $_SESSION['gameevening'][1] == "0" && $_SESSION['gameevening'][2] == "0"
                            && $_SESSION['gameevening'][3] == "0" && $_SESSION['gameevening'][4] == "0"
                            && $_SESSION['gameevening'][5] == "0" && $_SESSION['gameevening'][6] == "0")
                        && ($_SESSION['gamenight'][0] == "0" && $_SESSION['gamenight'][1] == "0" && $_SESSION['gamenight'][2] == "0"
                            && $_SESSION['gamenight'][3] == "0" && $_SESSION['gamenight'][4] == "0"
                            && $_SESSION['gamenight'][5] == "0" && $_SESSION['gamenight'][6] == "0"))
                            $match_time = "true";
                    else
                    {
                        if(isset($_SESSION['gameearly']))
                        {
                            $getearly = "";
                            if(isset($row["avail_early"]))
                                $getearly = explode(", ", $row["avail_early"]);

                            if($_SESSION['gameearly'][0] == "1" && ((isset($getearly[0])) && $getearly[0] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][1] == "1" && ((isset($getearly[1])) && $getearly[1] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][2] == "1" && ((isset($getearly[2])) && $getearly[2] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][3] == "1" && ((isset($getearly[3])) && $getearly[3] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][4] == "1" && ((isset($getearly[4])) && $getearly[4] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][5] == "1" && ((isset($getearly[5])) && $getearly[5] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['gameearly'][6] == "1" && ((isset($getearly[6])) && $getearly[6] == "1"))
                                $match_early = "true";
                        }

                        if(isset($_SESSION['gameafternoon']))
                        {
                            $getafternoon = "";
                            if(isset($row["avail_afternoon"]))
                                $getafternoon = explode(", ", $row["avail_afternoon"]);

                            if($_SESSION['gameafternoon'][0] == "1" && ((isset($getafternoon[0])) && $getafternoon[0] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][1] == "1" && ((isset($getafternoon[1])) && $getafternoon[1] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][2] == "1" && ((isset($getafternoon[2])) && $getafternoon[2] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][3] == "1" && ((isset($getafternoon[3])) && $getafternoon[3] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][4] == "1" && ((isset($getafternoon[4])) && $getafternoon[4] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][5] == "1" && ((isset($getafternoon[5])) && $getafternoon[5] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['gameafternoon'][6] == "1" && ((isset($getafternoon[6])) && $getafternoon[6] == "1"))
                                $match_afternoon = "true";
                        }

                        if(isset($_SESSION['gameevening']))
                        {
                            $getevening = "";
                            if(isset($row["avail_evening"]))
                                $getevening = explode(", ", $row["avail_evening"]);

                            if($_SESSION['gameevening'][0] == "1" && ((isset($getevening[0])) && $getevening[0] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][1] == "1" && ((isset($getevening[1])) && $getevening[1] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][2] == "1" && ((isset($getevening[2])) && $getevening[2] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][3] == "1" && ((isset($getevening[3])) && $getevening[3] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][4] == "1" && ((isset($getevening[4])) && $getevening[4] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][5] == "1" && ((isset($getevening[5])) && $getevening[5] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['gameevening'][6] == "1" && ((isset($getevening[6])) && $getevening[6] == "1"))
                                $match_evening = "true";
                        }

                        if(isset($_SESSION['gamenight']))
                        {
                            $getnight = "";
                            if(isset($row["avail_night"]))
                                $getnight = explode(", ", $row["avail_night"]);

                            if($_SESSION['gamenight'][0] == "1" && ((isset($getnight[0])) && $getnight[0] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][1] == "1" && ((isset($getnight[1])) && $getnight[1] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][2] == "1" && ((isset($getnight[2])) && $getnight[2] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][3] == "1" && ((isset($getnight[3])) && $getnight[3] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][4] == "1" && ((isset($getnight[4])) && $getnight[4] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][5] == "1" && ((isset($getnight[5])) && $getnight[5] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['gamenight'][6] == "1" && ((isset($getnight[6])) && $getnight[6] == "1"))
                                $match_night = "true";
                        }

                        if($match_early == "true" || $match_afternoon == "true" || $match_evening == "true" || $match_night == "true")
                            $match_time = "true";
                    }
                }
                else
                    $match_time = "true";

                
                //System
                $match_system = "false";
                if(isset($_SESSION['gamesystem']))
                {
                    $getsystem = "";
                    if(isset($row["gamesystem"]))
                        $getsystem = $row["gamesystem"];

                    if($_SESSION['gamesystem'][0] == "0" && $_SESSION['gamesystem'][1] == "0" && $_SESSION['gamesystem'][2] == "0" 
                        && $_SESSION['gamesystem'][3] == "0" && $_SESSION['gamesystem'][4] == "0" && $_SESSION['gamesystem'][5] == "0"
                        && $_SESSION['gamesystem'][6] == "0" && $_SESSION['gamesystem'][7] == "0" && $_SESSION['gamesystem'][8] == "0"
                        && $_SESSION['gamesystem'][9] == "0")
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][0] == "1" && ($getsystem == "OldSchool"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][1] == "1" && ($getsystem == "DD3"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][2] == "1" && ($getsystem == "DD4"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][3] == "1" && ($getsystem == "DD5"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][4] == "1" && ($getsystem == "PbtA"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][5] == "1" && ($getsystem == "WoD"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][6] == "1" && ($getsystem == "BurningWheel"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][7] == "1" && ($getsystem == "Other"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][8] == "1" && ($getsystem == "Homebrew"))
                        $match_system = "true";
                    elseif($_SESSION['gamesystem'][9] == "1" && ($getsystem == "BoardGames"))
                        $match_system = "true";
                }
                else
                    $match_system = "true";

                //Play Style
                $match_rules = "false";
                if(isset($_SESSION['gamerules']))
                {
                    $getrules = "";
                    if(isset($row["gamerules"]))
                        $getrules = explode(", ", $row["gamerules"]);

                    if($_SESSION['gamerules'][0] == "0" && $_SESSION['gamerules'][1] == "0" 
                       && $_SESSION['gamerules'][2] == "0" && $_SESSION['gamerules'][3] == "0")
                        $match_rules = "true";
                    elseif($_SESSION['gamerules'][0] == "1" && ((isset($getrules[0])) && $getrules[0] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['gamerules'][1] == "1" && ((isset($getrules[1])) && $getrules[1] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['gamerules'][2] == "1" && ((isset($getrules[2])) && $getrules[2] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['gamerules'][3] == "1" && ((isset($getrules[3])) && $getrules[3] == "1"))
                        $match_rules = "true";
                }
                else
                    $match_rules = "true";

                $match_style = "false";
                if(isset($_SESSION['gamestyle']))
                {
                    $getstyle = "";
                    if(isset($row["gamestyle"]))
                        $getstyle = explode(", ", $row["gamestyle"]);

                    if($_SESSION['gamestyle'][0] == "0" && $_SESSION['gamestyle'][1] == "0" 
                       && $_SESSION['gamestyle'][2] == "0" && $_SESSION['gamestyle'][3] == "0")
                        $match_style = "true";
                    elseif($_SESSION['gamestyle'][0] == "1" && ((isset($getstyle[0])) && $getstyle[0] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['gamestyle'][1] == "1" && ((isset($getstyle[1])) && $getstyle[1] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['gamestyle'][2] == "1" && ((isset($getstyle[2])) && $getstyle[2] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['gamestyle'][3] == "1" && ((isset($getstyle[3])) && $getstyle[3] == "1"))
                        $match_style = "true";
                }
                else
                    $match_style = "true";

                $match_genre = "false";
                if(isset($_SESSION['gamegenre']))
                {
                    $getgenre = "";
                    if(isset($row["gamegenre"]))
                        $getgenre = explode(", ", $row["gamegenre"]);

                    if($_SESSION['gamegenre'][0] == "0" && $_SESSION['gamegenre'][1] == "0" && $_SESSION['gamegenre'][2] == "0" 
                      && $_SESSION['gamegenre'][3] == "0" && $_SESSION['gamegenre'][4] == "0" && $_SESSION['gamegenre'][5] == "0"
                      && $_SESSION['gamegenre'][6] == "0" && $_SESSION['gamegenre'][7] == "0" && $_SESSION['gamegenre'][8] == "0")
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][0] == "1" && ((isset($getgenre[0])) && $getgenre[0] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][1] == "1" && ((isset($getgenre[1])) && $getgenre[1] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][2] == "1" && ((isset($getgenre[2])) && $getgenre[2] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][3] == "1" && ((isset($getgenre[3])) && $getgenre[3] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][4] == "1" && ((isset($getgenre[4])) && $getgenre[4] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][5] == "1" && ((isset($getgenre[5])) && $getgenre[5] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][6] == "1" && ((isset($getgenre[6])) && $getgenre[6] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][7] == "1" && ((isset($getgenre[7])) && $getgenre[7] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['gamegenre'][8] == "1" && ((isset($getgenre[8])) && $getgenre[8] == "1"))
                        $match_genre = "true";
                }
                else
                    $match_genre = "true";
                
                //Other
                $match_tone = "false";
                if(isset($_SESSION['gametone']))
                {
                    $gettone = "";
                    if(isset($row["gametone"]))
                        $gettone = $row["gametone"];

                    if($_SESSION['gametone'][0] == "0" && $_SESSION['gametone'][1] == "0" 
                       && $_SESSION['gametone'][2] == "0" && $_SESSION['gametone'][3] == "0")
                        $match_tone = "true";
                    elseif($_SESSION['gametone'][0] == "1" && ($gettone == "PG13"))
                        $match_tone = "true";
                    elseif($_SESSION['gametone'][1] == "1" && ($gettone == "R"))
                        $match_tone = "true";
                    elseif($_SESSION['gametone'][2] == "1" && ($gettone == "M"))
                        $match_tone = "true";
                    elseif($_SESSION['gametone'][3] == "1" && ($gettone == "XXX"))
                        $match_tone = "true";
                }
                else
                    $match_tone = "true";

                $match_other = "false";
                if(isset($_SESSION['gameother']))
                {
                    $getother = "";
                    if(isset($row["gameother"]))
                        $getother = explode(", ", $row["gameother"]);

                    if($_SESSION['gameother'][0] == "0" && $_SESSION['gameother'][1] == "0" 
                       && $_SESSION['gameother'][2] == "0" && $_SESSION['gameother'][3] == "0")
                        $match_other = "true";
                    elseif($_SESSION['gameother'][0] == "1" && ((isset($getother[0])) && $getother[0] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['gameother'][1] == "1" && ((isset($getother[1])) && $getother[1] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['gameother'][2] == "1" && ((isset($getother[2])) && $getother[2] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['gameother'][3] == "1" && ((isset($getother[3])) && $getother[3] == "1"))
                        $match_other = "true";
                }
                else
                    $match_other = "true";
				
				$match_active = "true";
                if(isset($_SESSION['gameactive']))
                {
                    $getactive = "";
                    if(isset($row["gameactive"]))
                        $getactive = $row["gameactive"];

                    if($_SESSION['gameactive'] == "1" && $getactive == "0")
                        $match_active = "false";
                }
				
				$match_playerswanted = "true";
                if(isset($_SESSION['playerswanted']))
                {
                    $getplayerswanted = "";
                    if(isset($row["playerswanted"]))
                        $getplayerswanted = $row["playerswanted"];

                    if($_SESSION['playerswanted'] == "1" && $getplayerswanted == "0")
                        $match_playerswanted = "false";
                }

                $match_dmwanted = "true";
                if(isset($_SESSION['playerswanted']))
                {
                    $getdmwanted = "";
                    if(isset($row["dmwanted"]))
                        $getdmwanted = $row["dmwanted"];

                    if($_SESSION['dmwanted'] == "1" && $getdmwanted == "0")
                        $match_dmwanted = "false";
                }
				
				if($_SESSION['dmwanted'] == "1" && $_SESSION['playerswanted'] == "1"
					&& ($match_dmwanted == "true" || $match_playerswanted == "true"))
				{
					$match_playerswanted = "true";
					$match_dmwanted = "true";
				}

                $gamename = $row["gamename"];
				$gameid = $row["GameID"];
                $gamepic = $row['gamepicture'];
				$gamecreated = $row['gamecreateddate'];
                
                $match_true = ($match_gametype == "true" && $match_playrate == "true" && $match_time == "true" 
                               && $match_system == "true" && $match_rules == "true" 
                               && $match_style == "true" && $match_genre == "true" && $match_tone == "true" 
                               && $match_other == "true" && $match_active == "true" 
							   && $match_playerswanted == "true" && $match_dmwanted == "true");
							   
                //Location
                $match_location = 'false';
                if($match_true && isset($_SESSION["gamesearchlocation"]) && $_SESSION["gamesearchlocation"] > 0
                   && isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] != 0)
                {
                    if(isset($row["gamezipcode"]))
                    {
                        $player_zip = $row["gamezipcode"];
                        $locationvalid = 'true';

                        $self_lat;
                        $self_lng;
                        $self_coslat;

                        $player_lat;
                        $player_lng;
                        $player_coslat;

                        //Create database query
                        $sql = "SELECT * FROM zipcodes 
                            WHERE zipcode='" . $_SESSION["gamesearchlocation"] . "'";

                        //Send query
                        $self = $conn->query($sql);

                        //If there is more than 0 rows
                        if ($self->num_rows > 0)
                        {
                            //Output data of each row
                            while($ziprow = $self->fetch_assoc()) 
                            {
                                $self_lat = $ziprow["latrad"];
                                $self_lng = $ziprow["longrad"];
                                $self_coslat = $ziprow["latcos"];
                            }
                        }
                        else
                        {
                            $locationvalid = 'false';
                        }

                        if($locationvalid == 'true')
                        {
                            //Create database query
                            $sql = "SELECT * FROM zipcodes 
                                WHERE zipcode='" . $player_zip . "'";

                            //Send query
                            $other = $conn->query($sql);

                            //If there is more than 0 rows
                            if ($other->num_rows > 0)
                            {
                                //Output data of each row
                                while($ziprow = $other->fetch_assoc()) 
                                {
                                    $player_lat = $ziprow["latrad"];
                                    $player_lng = $ziprow["longrad"];
                                    $player_coslat = $ziprow["latcos"];
                                }
                            }
                            else
                            {
                                $locationvalid = 'false';
                            }
                        }

                        if($locationvalid == 'true')
                        {
                            $lat_avg = ($self_lat - $player_lat) / 2;
                            $lng_avg = ($self_lng - $player_lng) / 2;

                            $earthrad = 3959;
                            $totaldist = 
                                2 * $earthrad * 
                                    asin( sqrt( pow(sin($lat_avg), 2) + $self_coslat * $player_coslat *pow(sin($lng_avg), 2) ) );

                            if($_SESSION["gamesearchdist"] >= $totaldist)
							{
                                $match_location = 'true';
								$gamelist[$matches]['dist'] = $totaldist;
							}
                        }
                    }
                }
                else
                    $match_location = 'true';

                if($match_true == 'true' && $match_location == 'true')
                {
					$gamelist[$matches]['name'] = $gamename;
					$gamelist[$matches]['pic'] = $gamepic;
					$gamelist[$matches]['visit'] = $gamecreated;
					$gamelist[$matches]['id'] = $gameid;
                    ++$matches;
                }
            }
        }
		
		if(isset($_POST['sort']))
			$_SESSION['gamesort'] = test_input($_POST['sort']);
		elseif(!isset($_SESSION['sort']))
			$_SESSION['gamesort'] = "random";
			
		if($_SESSION['gamesort'] == "distance")
			usort($gamelist, 'DistCompare');
		elseif($_SESSION['gamesort'] == "lastvisit")
			usort($gamelist, 'VisitCompare');
		else
			shuffle($gamelist);
		
		if($matches > 0)
		{
			for($iter = 0; $iter < $matches; ++$iter)
			{
				echo "<a class='profilebox' href='game.php?gameid=" . $gamelist[$iter]['id'] . "'>" 
						. "<div class='profileresulttitle' >" . $gamelist[$iter]['name'] . "</div>";
					echo "<div class='profileresultpiccontainer'>";
						if(isset($gamelist[$iter]['pic']) && $gamelist[$iter]['pic'] != ""):
							echo "<div class='profileresultpic' style='background-position:center;background-size:cover;background-image: url(" . $gamelist[$iter]['pic'] . ");background-repeat:no-repeat;height:200px;width:200px;'></div>";
						else:
							echo "<img class='nogamepic' src='img/nopicgamered.png'>";
						endif;
					echo "</div>";
				echo "</a>";
				if(($iter+1) % 10 == 0)
					echo "<>";
			}
			echo "<>";
		}
    }
    else
    {
        $_SESSION["error"] = "Name not found.";
    }
    $conn->close();
    
    if($matches == 0)
        echo "<div class='playerresulttext'><b>No Matches Found</b></div><>";
}

function DistCompare($a, $b)
{
	if ($a['dist'] == $b['dist'])
	{
        return 0;
    }
    return ($a['dist'] < $b['dist']) ? -1 : 1;
}

function VisitCompare($a, $b)
{
	if ($a['visit'] == $b['visit'])
	{
        return 0;
    }
    return ($a['visit'] < $b['visit']) ? -1 : 1;
}

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>