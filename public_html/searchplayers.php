<?php
session_start();

//Catch POST command sent to file
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Location
    if(isset($_POST["location"]) && is_numeric($_POST["location"]))
    {
        //$_SESSION["ziperror"] = "";
        $_SESSION["searchlocation"] = (int)$_POST["location"];
    }
    if(isset($_POST["distance"]))
    {
        if($_POST["distance"] == "dist_10")
            $_SESSION["searchdist"] = 10;
        elseif($_POST["distance"] == "dist_25")
            $_SESSION["searchdist"] = 25;
        elseif($_POST["distance"] == "dist_50")
            $_SESSION["searchdist"] = 50;
        elseif($_POST["distance"] == "dist_100")
            $_SESSION["searchdist"] = 100;
        elseif($_POST["distance"] == "dist_any")
            $_SESSION["searchdist"] = 0;
    }
    
    if(!isset($_SESSION['gametype']))
        $_SESSION['gametype'] = array("0", "0", "0", "0");
    if(isset($_POST["gametype_InPerson"]))
        $_SESSION['gametype'][0] = $_POST["gametype_InPerson"];
    if(isset($_POST["gametype_OnlineWebcam"]))
        $_SESSION['gametype'][1] = $_POST["gametype_OnlineWebcam"];
    if(isset($_POST["gametype_OnlineAudio"]))
        $_SESSION['gametype'][2] = $_POST["gametype_OnlineAudio"];
    if(isset($_POST["gametype_OnlineTextOnly"]))
        $_SESSION['gametype'][3] = $_POST["gametype_OnlineTextOnly"];
        
    if(!isset($_SESSION['playrate']))
        $_SESSION['playrate'] = array("0", "0", "0", "0", "0");
    if(isset($_POST["rate_MoreThanOnceAWeek"]))
        $_SESSION['playrate'][0] = $_POST["rate_MoreThanOnceAWeek"];
    if(isset($_POST["rate_Weekly"]))
        $_SESSION['playrate'][1] = $_POST["rate_Weekly"];
    if(isset($_POST["rate_EveryTwoWeeks"]))
        $_SESSION['playrate'][2] = $_POST["rate_EveryTwoWeeks"];
    if(isset($_POST["rate_Monthly"]))
        $_SESSION['playrate'][3] = $_POST["rate_Monthly"];
    if(isset($_POST["rate_OnceInAWhile"]))
        $_SESSION['playrate'][4] = $_POST["rate_OnceInAWhile"];
    
    if(!isset($_SESSION['early']))
        $_SESSION['early'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Early"]))
        $_SESSION['early'][0] = $_POST["avail_Mon_Early"];
    if(isset($_POST["avail_Tue_Early"]))
        $_SESSION['early'][1] = $_POST["avail_Tue_Early"];
    if(isset($_POST["avail_Wed_Early"]))
        $_SESSION['early'][2] = $_POST["avail_Wed_Early"];
    if(isset($_POST["avail_Thu_Early"]))
        $_SESSION['early'][3] = $_POST["avail_Thu_Early"];
    if(isset($_POST["avail_Fri_Early"]))
        $_SESSION['early'][4] = $_POST["avail_Fri_Early"];
    if(isset($_POST["avail_Sat_Early"]))
        $_SESSION['early'][5] = $_POST["avail_Sat_Early"];
    if(isset($_POST["avail_Sun_Early"]))
        $_SESSION['early'][6] = $_POST["avail_Sun_Early"];
    
    if(!isset($_SESSION['afternoon']))
        $_SESSION['afternoon'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Afternoon"]))
        $_SESSION['afternoon'][0] = $_POST["avail_Mon_Afternoon"];
    if(isset($_POST["avail_Tue_Afternoon"]))
        $_SESSION['afternoon'][1] = $_POST["avail_Tue_Afternoon"];
    if(isset($_POST["avail_Wed_Afternoon"]))
        $_SESSION['afternoon'][2] = $_POST["avail_Wed_Afternoon"];
    if(isset($_POST["avail_Thu_Afternoon"]))
        $_SESSION['afternoon'][3] = $_POST["avail_Thu_Afternoon"];
    if(isset($_POST["avail_Fri_Afternoon"]))
        $_SESSION['afternoon'][4] = $_POST["avail_Fri_Afternoon"];
    if(isset($_POST["avail_Sat_Afternoon"]))
        $_SESSION['afternoon'][5] = $_POST["avail_Sat_Afternoon"];
    if(isset($_POST["avail_Sun_Afternoon"]))
        $_SESSION['afternoon'][6] = $_POST["avail_Sun_Afternoon"];
    
    if(!isset($_SESSION['evening']))
        $_SESSION['evening'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Evening"]))
        $_SESSION['evening'][0] = $_POST["avail_Mon_Evening"];
    if(isset($_POST["avail_Tue_Evening"]))
        $_SESSION['evening'][1] = $_POST["avail_Tue_Evening"];
    if(isset($_POST["avail_Wed_Evening"]))
        $_SESSION['evening'][2] = $_POST["avail_Wed_Evening"];
    if(isset($_POST["avail_Thu_Evening"]))
        $_SESSION['evening'][3] = $_POST["avail_Thu_Evening"];
    if(isset($_POST["avail_Fri_Evening"]))
        $_SESSION['evening'][4] = $_POST["avail_Fri_Evening"];
    if(isset($_POST["avail_Sat_Evening"]))
        $_SESSION['evening'][5] = $_POST["avail_Sat_Evening"];
    if(isset($_POST["avail_Sun_Evening"]))
        $_SESSION['evening'][6] = $_POST["avail_Sun_Evening"];
    
    if(!isset($_SESSION['night']))
        $_SESSION['night'] = array("0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["avail_Mon_Night"]))
        $_SESSION['night'][0] = $_POST["avail_Mon_Night"];
    if(isset($_POST["avail_Tue_Night"]))
        $_SESSION['night'][1] = $_POST["avail_Tue_Night"];
    if(isset($_POST["avail_Wed_Night"]))
        $_SESSION['night'][2] = $_POST["avail_Wed_Night"];
    if(isset($_POST["avail_Thu_Night"]))
        $_SESSION['night'][3] = $_POST["avail_Thu_Night"];
    if(isset($_POST["avail_Fri_Night"]))
        $_SESSION['night'][4] = $_POST["avail_Fri_Night"];
    if(isset($_POST["avail_Sat_Night"]))
        $_SESSION['night'][5] = $_POST["avail_Sat_Night"];
    if(isset($_POST["avail_Sun_Night"]))
        $_SESSION['night'][6] = $_POST["avail_Sun_Night"];
    
    //System
    if(!isset($_SESSION['system']))
        $_SESSION['system'] = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["system_OldSchool"]))
        $_SESSION['system'][0] = $_POST["system_OldSchool"];
    if(isset($_POST["system_DD3"]))
        $_SESSION['system'][1] = $_POST["system_DD3"];
    if(isset($_POST["system_DD4"]))
        $_SESSION['system'][2] = $_POST["system_DD4"];
    if(isset($_POST["system_DD5"]))
        $_SESSION['system'][3] = $_POST["system_DD5"];
    if(isset($_POST["system_PbtA"]))
        $_SESSION['system'][4] = $_POST["system_PbtA"];
    if(isset($_POST["system_WoD"]))
        $_SESSION['system'][5] = $_POST["system_WoD"];
    if(isset($_POST["system_BurningWheel"]))
        $_SESSION['system'][6] = $_POST["system_BurningWheel"];
    if(isset($_POST["system_Other"]))
        $_SESSION['system'][7] = $_POST["system_Other"];
    if(isset($_POST["system_Hombrew"]))
        $_SESSION['system'][8] = $_POST["system_Hombrew"];
    if(isset($_POST["system_BoardGames"]))
        $_SESSION['system'][9] = $_POST["system_BoardGames"];
    
    //Play Style
    if(!isset($_SESSION['play']))
        $_SESSION['play'] = array("0", "0", "0");
    if(isset($_POST["play_WillingGM"]))
        $_SESSION['play'][0] = $_POST["play_WillingGM"];
    if(isset($_POST["play_WillingPlay"]))
        $_SESSION['play'][1] = $_POST["play_WillingPlay"];
    if(isset($_POST["play_Hangout"]))
        $_SESSION['play'][2] = $_POST["play_Hangout"];
    
    if(!isset($_SESSION['rules']))
        $_SESSION['rules'] = array("0", "0", "0", "0");
    if(isset($_POST["rules_Written"]))
        $_SESSION['rules'][0] = $_POST["rules_Written"];
    if(isset($_POST["rules_Interpreted"]))
        $_SESSION['rules'][1] = $_POST["rules_Interpreted"];
    if(isset($_POST["rules_Suggested"]))
        $_SESSION['rules'][2] = $_POST["rules_Suggested"];
    if(isset($_POST["rules_HouseRules"]))
        $_SESSION['rules'][3] = $_POST["rules_HouseRules"];
    
    if(!isset($_SESSION['style']))
        $_SESSION['style'] = array("0", "0", "0", "0");
    if(isset($_POST["style_Serious"]))
        $_SESSION['style'][0] = $_POST["style_Serious"];
    if(isset($_POST["style_Silly"]))
        $_SESSION['style'][1] = $_POST["style_Silly"];
    if(isset($_POST["style_Casual"]))
        $_SESSION['style'][2] = $_POST["style_Casual"];
    if(isset($_POST["style_Power"]))
        $_SESSION['style'][3] = $_POST["style_Power"];
    
    if(!isset($_SESSION['genre']))
        $_SESSION['genre'] = array("0", "0", "0", "0", "0", "0", "0", "0", "0");
    if(isset($_POST["genre_Fantasy"]))
        $_SESSION['genre'][0] = $_POST["genre_Fantasy"];
    if(isset($_POST["genre_SciFi"]))
        $_SESSION['genre'][1] = $_POST["genre_SciFi"];
    if(isset($_POST["genre_Horror"]))
        $_SESSION['genre'][2] = $_POST["genre_Horror"];
    if(isset($_POST["genre_Modern"]))
        $_SESSION['genre'][3] = $_POST["genre_Modern"];
    if(isset($_POST["genre_Western"]))
        $_SESSION['genre'][4] = $_POST["genre_Western"];
    if(isset($_POST["genre_Historical"]))
        $_SESSION['genre'][5] = $_POST["genre_Historical"];
    if(isset($_POST["genre_PostApocolypse"]))
        $_SESSION['genre'][6] = $_POST["genre_PostApocolypse"];
    if(isset($_POST["genre_Superhero"]))
        $_SESSION['genre'][7] = $_POST["genre_Superhero"];
    if(isset($_POST["genre_Steampunk"]))
        $_SESSION['genre'][8] = $_POST["genre_Steampunk"];
    
    //Other
    if(!isset($_SESSION['tone']))
        $_SESSION['tone'] = array("0", "0", "0", "0");
    if(isset($_POST["tone_PG13"]))
        $_SESSION['tone'][0] = $_POST["tone_PG13"];
    if(isset($_POST["tone_R"]))
        $_SESSION['tone'][1] = $_POST["tone_R"];
    if(isset($_POST["tone_M"]))
        $_SESSION['tone'][2] = $_POST["tone_M"];
    if(isset($_POST["tone_XXX"]))
        $_SESSION['tone'][3] = $_POST["tone_XXX"];
    
    if(!isset($_SESSION['other']))
        $_SESSION['other'] = array("0", "0", "0", "0");
    if(isset($_POST["other_Food"]))
        $_SESSION['other'][0] = $_POST["other_Food"];
    if(isset($_POST["other_Alcohol"]))
        $_SESSION['other'][1] = $_POST["other_Alcohol"];
    if(isset($_POST["other_Smoking"]))
        $_SESSION['other'][2] = $_POST["other_Smoking"];
    if(isset($_POST["other_Drugs"]))
        $_SESSION['other'][3] = $_POST["other_Drugs"];
    
    if(!isset($_SESSION['age']))
        $_SESSION['age'] = array("0", "0", "0", "0", "0", "0");
    if(isset($_POST["age_LessThan20"]))
        $_SESSION['age'][0] = $_POST["age_LessThan20"];
    if(isset($_POST["age_20to30"]))
        $_SESSION['age'][1] = $_POST["age_20to30"];
    if(isset($_POST["age_30to40"]))
        $_SESSION['age'][2] = $_POST["age_30to40"];
    if(isset($_POST["age_40to50"]))
        $_SESSION['age'][3] = $_POST["age_40to50"];
    if(isset($_POST["age_50to60"]))
        $_SESSION['age'][4] = $_POST["age_50to60"];
    if(isset($_POST["age_Over60"]))
        $_SESSION['age'][5] = $_POST["age_Over60"];
    
    if(!isset($_SESSION['gender']))
        $_SESSION['gender'] = array("0", "0", "0");
    if(isset($_POST["gender_Man"]))
        $_SESSION['gender'][0] = $_POST["gender_Man"];
    if(isset($_POST["gender_Woman"]))
        $_SESSION['gender'][1] = $_POST["gender_Woman"];
    if(isset($_POST["gender_Other"]))
        $_SESSION['gender'][2] = $_POST["gender_Other"];

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
    $sql = "SELECT * FROM players";

    //Send query
    $result = $conn->query($sql);
        
    $matches = 0;
    //If there is more than 0 rows
    if ($result->num_rows > 0)
    {
		$playerlist = array();
		
        //Output data of each row
        while($row = $result->fetch_assoc()) 
        {
            if($row["Public"] == 1)
            {
                //Availability
                $match_gametype = "false";
                if(isset($_SESSION['gametype']))
                {
                    $getgametype = "";
                    if(isset($row["gametype"]))
                        $getgametype = explode(", ", $row["gametype"]);
                    
                    if($_SESSION['gametype'][0] == "0" && $_SESSION['gametype'][1] == "0" 
                       && $_SESSION['gametype'][2] == "0" && $_SESSION['gametype'][3] == "0")
                        $match_gametype = "true";
                    elseif($_SESSION['gametype'][0] == "1" && ((isset($getgametype[0])) && $getgametype[0] == "1"))
                        $match_gametype = "true";
                    elseif($_SESSION['gametype'][1] == "1" && ((isset($getgametype[1])) && $getgametype[1] == "1"))
                        $match_gametype = "true";
                    elseif($_SESSION['gametype'][2] == "1" && ((isset($getgametype[2])) && $getgametype[2] == "1"))
                        $match_gametype = "true";
                    elseif($_SESSION['gametype'][3] == "1" && ((isset($getgametype[3])) && $getgametype[3] == "1"))
                        $match_gametype = "true";
                }
                else
                    $match_gametype = "true";

                $match_playrate = "false";
                if(isset($_SESSION['playrate']))
                {
                    $getplayrate = "";
                    if(isset($row["rate"]))
                        $getplayrate = explode(", ", $row["rate"]);

                    if($_SESSION['playrate'][0] == "0" && $_SESSION['playrate'][1] == "0" && $_SESSION['playrate'][2] == "0"
                       && $_SESSION['playrate'][3] == "0" && $_SESSION['playrate'][4] == "0")
                        $match_playrate = "true";
                    elseif($_SESSION['playrate'][0] == "1" && ((isset($getplayrate[0])) && $getplayrate[0] == "1"))
                        $match_playrate = "true";
                    elseif($_SESSION['playrate'][1] == "1" && ((isset($getplayrate[1])) && $getplayrate[1] == "1"))
                        $match_playrate = "true";
                    elseif($_SESSION['playrate'][2] == "1" && ((isset($getplayrate[2])) && $getplayrate[2] == "1"))
                        $match_playrate = "true";
                    elseif($_SESSION['playrate'][3] == "1" && ((isset($getplayrate[3])) && $getplayrate[3] == "1"))
                        $match_playrate = "true";
                    elseif($_SESSION['playrate'][4] == "1" && ((isset($getplayrate[4])) && $getplayrate[4] == "1"))
                        $match_playrate = "true";
                }
                else
                    $match_playrate = "true";

                $match_time = "false";
                if(isset($_SESSION['early']) || isset($_SESSION['afternoon']) || 
                    isset($_SESSION['evening']) || isset($_SESSION['night']))
                {
                    $match_early = "false";
                    $match_afternoon = "false";
                    $match_evening = "false";
                    $match_night = "false";

                    if(($_SESSION['early'][0] == "0" && $_SESSION['early'][1] == "0" && $_SESSION['early'][2] == "0"
                            && $_SESSION['early'][3] == "0" && $_SESSION['early'][4] == "0"
                            && $_SESSION['early'][5] == "0" && $_SESSION['early'][6] == "0")
                        && ($_SESSION['afternoon'][0] == "0" && $_SESSION['afternoon'][1] == "0" && $_SESSION['afternoon'][2] == "0"
                            && $_SESSION['afternoon'][3] == "0" && $_SESSION['afternoon'][4] == "0"
                            && $_SESSION['afternoon'][5] == "0" && $_SESSION['afternoon'][6] == "0")
                        && ($_SESSION['evening'][0] == "0" && $_SESSION['evening'][1] == "0" && $_SESSION['evening'][2] == "0"
                            && $_SESSION['evening'][3] == "0" && $_SESSION['evening'][4] == "0"
                            && $_SESSION['evening'][5] == "0" && $_SESSION['evening'][6] == "0")
                        && ($_SESSION['night'][0] == "0" && $_SESSION['night'][1] == "0" && $_SESSION['night'][2] == "0"
                            && $_SESSION['night'][3] == "0" && $_SESSION['night'][4] == "0"
                            && $_SESSION['night'][5] == "0" && $_SESSION['night'][6] == "0"))
                            $match_time = "true";
                    else
                    {
                        if(isset($_SESSION['early']))
                        {
                            $getearly = "";
                            if(isset($row["avail_early"]))
                                $getearly = explode(", ", $row["avail_early"]);

                            if($_SESSION['early'][0] == "1" && ((isset($getearly[0])) && $getearly[0] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][1] == "1" && ((isset($getearly[1])) && $getearly[1] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][2] == "1" && ((isset($getearly[2])) && $getearly[2] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][3] == "1" && ((isset($getearly[3])) && $getearly[3] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][4] == "1" && ((isset($getearly[4])) && $getearly[4] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][5] == "1" && ((isset($getearly[5])) && $getearly[5] == "1"))
                                $match_early = "true";
                            elseif($_SESSION['early'][6] == "1" && ((isset($getearly[6])) && $getearly[6] == "1"))
                                $match_early = "true";
                        }

                        if(isset($_SESSION['afternoon']))
                        {
                            $getafternoon = "";
                            if(isset($row["avail_afternoon"]))
                                $getafternoon = explode(", ", $row["avail_afternoon"]);

                            if($_SESSION['afternoon'][0] == "1" && ((isset($getafternoon[0])) && $getafternoon[0] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][1] == "1" && ((isset($getafternoon[1])) && $getafternoon[1] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][2] == "1" && ((isset($getafternoon[2])) && $getafternoon[2] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][3] == "1" && ((isset($getafternoon[3])) && $getafternoon[3] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][4] == "1" && ((isset($getafternoon[4])) && $getafternoon[4] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][5] == "1" && ((isset($getafternoon[5])) && $getafternoon[5] == "1"))
                                $match_afternoon = "true";
                            elseif($_SESSION['afternoon'][6] == "1" && ((isset($getafternoon[6])) && $getafternoon[6] == "1"))
                                $match_afternoon = "true";
                        }

                        if(isset($_SESSION['evening']))
                        {
                            $getevening = "";
                            if(isset($row["avail_evening"]))
                                $getevening = explode(", ", $row["avail_evening"]);

                            if($_SESSION['evening'][0] == "1" && ((isset($getevening[0])) && $getevening[0] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][1] == "1" && ((isset($getevening[1])) && $getevening[1] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][2] == "1" && ((isset($getevening[2])) && $getevening[2] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][3] == "1" && ((isset($getevening[3])) && $getevening[3] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][4] == "1" && ((isset($getevening[4])) && $getevening[4] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][5] == "1" && ((isset($getevening[5])) && $getevening[5] == "1"))
                                $match_evening = "true";
                            elseif($_SESSION['evening'][6] == "1" && ((isset($getevening[6])) && $getevening[6] == "1"))
                                $match_evening = "true";
                        }

                        if(isset($_SESSION['night']))
                        {
                            $getnight = "";
                            if(isset($row["avail_night"]))
                                $getnight = explode(", ", $row["avail_night"]);

                            if($_SESSION['night'][0] == "1" && ((isset($getnight[0])) && $getnight[0] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][1] == "1" && ((isset($getnight[1])) && $getnight[1] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][2] == "1" && ((isset($getnight[2])) && $getnight[2] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][3] == "1" && ((isset($getnight[3])) && $getnight[3] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][4] == "1" && ((isset($getnight[4])) && $getnight[4] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][5] == "1" && ((isset($getnight[5])) && $getnight[5] == "1"))
                                $match_night = "true";
                            elseif($_SESSION['night'][6] == "1" && ((isset($getnight[6])) && $getnight[6] == "1"))
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
                if(isset($_SESSION['system']))
                {
                    $getsystem = "";
                    if(isset($row["System"]))
                        $getsystem = explode(", ", $row["System"]);

                    if($_SESSION['system'][0] == "0" && $_SESSION['system'][1] == "0" && $_SESSION['system'][2] == "0" 
                        && $_SESSION['system'][3] == "0" && $_SESSION['system'][4] == "0" && $_SESSION['system'][5] == "0"
                        && $_SESSION['system'][6] == "0" && $_SESSION['system'][7] == "0" && $_SESSION['system'][8] == "0"
                        && $_SESSION['system'][9] == "0")
                        $match_system = "true";
                    elseif($_SESSION['system'][0] == "1" && ((isset($getsystem[0])) && $getsystem[0] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][1] == "1" && ((isset($getsystem[1])) && $getsystem[1] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][2] == "1" && ((isset($getsystem[2])) && $getsystem[2] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][3] == "1" && ((isset($getsystem[3])) && $getsystem[3] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][4] == "1" && ((isset($getsystem[4])) && $getsystem[4] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][5] == "1" && ((isset($getsystem[5])) && $getsystem[5] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][6] == "1" && ((isset($getsystem[6])) && $getsystem[6] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][7] == "1" && ((isset($getsystem[7])) && $getsystem[7] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][8] == "1" && ((isset($getsystem[8])) && $getsystem[8] == "1"))
                        $match_system = "true";
                    elseif($_SESSION['system'][9] == "1" && ((isset($getsystem[9])) && $getsystem[9] == "1"))
                        $match_system = "true";
                }
                else
                    $match_system = "true";

                //Play Style
                $match_playtype = "false";
                if(isset($_SESSION['play']))
                {
                    $getplay = "";
                    if(isset($row["Play"]))
                        $getplay = explode(", ", $row["Play"]);

                    if($_SESSION['play'][0] == "0" && $_SESSION['play'][1] == "0" && $_SESSION['play'][2] == "0")
                        $match_playtype = "true";
                    elseif($_SESSION['play'][0] == "1" && ((isset($getplay[0])) && $getplay[0] == "1"))
                        $match_playtype = "true";
                    elseif($_SESSION['play'][1] == "1" && ((isset($getplay[1])) && $getplay[1] == "1"))
                        $match_playtype = "true";
                    elseif($_SESSION['play'][2] == "1" && ((isset($getplay[2])) && $getplay[2] == "1"))
                        $match_playtype = "true";
                }
                else
                    $match_playtype = "true";

                $match_rules = "false";
                if(isset($_SESSION['rules']))
                {
                    $getrules = "";
                    if(isset($row["Rules"]))
                        $getrules = explode(", ", $row["Rules"]);

                    if($_SESSION['rules'][0] == "0" && $_SESSION['rules'][1] == "0" 
                       && $_SESSION['rules'][2] == "0" && $_SESSION['rules'][3] == "0")
                        $match_rules = "true";
                    elseif($_SESSION['rules'][0] == "1" && ((isset($getrules[0])) && $getrules[0] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['rules'][1] == "1" && ((isset($getrules[1])) && $getrules[1] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['rules'][2] == "1" && ((isset($getrules[2])) && $getrules[2] == "1"))
                        $match_rules = "true";
                    elseif($_SESSION['rules'][3] == "1" && ((isset($getrules[3])) && $getrules[3] == "1"))
                        $match_rules = "true";
                }
                else
                    $match_rules = "true";

                $match_style = "false";
                if(isset($_SESSION['style']))
                {
                    $getstyle = "";
                    if(isset($row["Style"]))
                        $getstyle = explode(", ", $row["Style"]);

                    if($_SESSION['style'][0] == "0" && $_SESSION['style'][1] == "0" 
                       && $_SESSION['style'][2] == "0" && $_SESSION['style'][3] == "0")
                        $match_style = "true";
                    elseif($_SESSION['style'][0] == "1" && ((isset($getstyle[0])) && $getstyle[0] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['style'][1] == "1" && ((isset($getstyle[1])) && $getstyle[1] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['style'][2] == "1" && ((isset($getstyle[2])) && $getstyle[2] == "1"))
                        $match_style = "true";
                    elseif($_SESSION['style'][3] == "1" && ((isset($getstyle[3])) && $getstyle[3] == "1"))
                        $match_style = "true";
                }
                else
                    $match_style = "true";

                $match_genre = "false";
                if(isset($_SESSION['genre']))
                {
                    $getgenre = "";
                    if(isset($row["Genre"]))
                        $getgenre = explode(", ", $row["Genre"]);

                    if($_SESSION['genre'][0] == "0" && $_SESSION['genre'][1] == "0" && $_SESSION['genre'][2] == "0" 
                      && $_SESSION['genre'][3] == "0" && $_SESSION['genre'][4] == "0" && $_SESSION['genre'][5] == "0"
                      && $_SESSION['genre'][6] == "0" && $_SESSION['genre'][7] == "0" && $_SESSION['genre'][8] == "0")
                        $match_genre = "true";
                    elseif($_SESSION['genre'][0] == "1" && ((isset($getgenre[0])) && $getgenre[0] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][1] == "1" && ((isset($getgenre[1])) && $getgenre[1] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][2] == "1" && ((isset($getgenre[2])) && $getgenre[2] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][3] == "1" && ((isset($getgenre[3])) && $getgenre[3] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][4] == "1" && ((isset($getgenre[4])) && $getgenre[4] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][5] == "1" && ((isset($getgenre[5])) && $getgenre[5] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][6] == "1" && ((isset($getgenre[6])) && $getgenre[6] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][7] == "1" && ((isset($getgenre[7])) && $getgenre[7] == "1"))
                        $match_genre = "true";
                    elseif($_SESSION['genre'][8] == "1" && ((isset($getgenre[8])) && $getgenre[8] == "1"))
                        $match_genre = "true";
                }
                else
                    $match_genre = "true";
                
                //Other
                $match_tone = "false";
                if(isset($_SESSION['tone']))
                {
                    $gettone = "";
                    if(isset($row["Tone"]))
                        $gettone = explode(", ", $row["Tone"]);

                    if($_SESSION['tone'][0] == "0" && $_SESSION['tone'][1] == "0" 
                       && $_SESSION['tone'][2] == "0" && $_SESSION['tone'][3] == "0")
                        $match_tone = "true";
                    elseif($_SESSION['tone'][0] == "1" && ((isset($gettone[0])) && $gettone[0] == "1"))
                        $match_tone = "true";
                    elseif($_SESSION['tone'][1] == "1" && ((isset($gettone[1])) && $gettone[1] == "1"))
                        $match_tone = "true";
                    elseif($_SESSION['tone'][2] == "1" && ((isset($gettone[2])) && $gettone[2] == "1"))
                        $match_tone = "true";
                    elseif($_SESSION['tone'][3] == "1" && ((isset($gettone[3])) && $gettone[3] == "1"))
                        $match_tone = "true";
                }
                else
                    $match_tone = "true";

                $match_other = "false";
                if(isset($_SESSION['other']))
                {
                    $getother = "";
                    if(isset($row["Other"]))
                        $getother = explode(", ", $row["Other"]);

                    if($_SESSION['other'][0] == "0" && $_SESSION['other'][1] == "0" 
                       && $_SESSION['other'][2] == "0" && $_SESSION['other'][3] == "0")
                        $match_other = "true";
                    elseif($_SESSION['other'][0] == "1" && ((isset($getother[0])) && $getother[0] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['other'][1] == "1" && ((isset($getother[1])) && $getother[1] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['other'][2] == "1" && ((isset($getother[2])) && $getother[2] == "1"))
                        $match_other = "true";
                    elseif($_SESSION['other'][3] == "1" && ((isset($getother[3])) && $getother[3] == "1"))
                        $match_other = "true";
                }
                else
                    $match_other = "true";
                
                $match_age = "false";
                if(isset($_SESSION['age']))
                {                    
                    if($_SESSION['age'][0] == "0" && $_SESSION['age'][1] == "0" && $_SESSION['age'][2] == "0"
                      && $_SESSION['age'][3] == "0" && $_SESSION['age'][4] == "0" && $_SESSION['age'][5] == "0")
                        $match_age = "true";
                    elseif($_SESSION['age'][0] == "1" && $row["age"] == "age_LessThan20")
                        $match_age = "true";
                    elseif($_SESSION['age'][1] == "1" && $row["age"] == "age_20to30")
                        $match_age = "true";
                    elseif($_SESSION['age'][2] == "1" && $row["age"] == "age_30to40")
                        $match_age = "true";
                    elseif($_SESSION['age'][3] == "1" && $row["age"] == "age_40to50")
                        $match_age = "true";
                    elseif($_SESSION['age'][4] == "1" && $row["age"] == "age_50to60")
                        $match_age = "true";
                    elseif($_SESSION['age'][5] == "1" && $row["age"] == "age_Over60")
                        $match_age = "true";
                }
                else
                    $match_age = "true";
                
                $match_gender = "false";
                if(isset($_SESSION['gender']))
                {                    
                    if($_SESSION['gender'][0] == "0" && $_SESSION['gender'][1] == "0" && $_SESSION['gender'][2] == "0")
                        $match_gender = "true";
                    elseif($_SESSION['gender'][0] == "1" && $row["gender"] == "gender_Man")
                        $match_gender = "true";
                    elseif($_SESSION['gender'][1] == "1" && $row["gender"] == "gender_Woman")
                        $match_gender = "true";
                    elseif($_SESSION['gender'][2] == "1" && $row["gender"] == "gender_Other")
                        $match_gender = "true";
                }
                else
                    $match_gender = "true";

                $playername = $row["name"];
                $playerpic = $row['pic1'];
				$playervisit = $row['LastVisit'];
                
                $match_true = ($match_gametype == "true" && $match_playrate == "true" && $match_time == "true" 
                               && $match_system == "true" && $match_playtype == "true" && $match_rules == "true" 
                               && $match_style == "true" && $match_genre == "true" && $match_tone == "true" 
                               && $match_other == "true" && $match_gender == "true" && $match_age == "true");
               
                //Location
                $match_location = 'false';
                if($match_true && isset($_SESSION["searchlocation"]) && $_SESSION["searchlocation"] > 0
                   && isset($_SESSION["searchdist"]) && $_SESSION["searchdist"] != 0)
                {
                    if(isset($row["location"]))
                    {
                        $player_zip = $row["location"];
                        $locationvalid = 'true';

                        $self_lat;
                        $self_lng;
                        $self_coslat;

                        $player_lat;
                        $player_lng;
                        $player_coslat;

                        //Create database query
                        $sql = "SELECT * FROM zipcodes 
                            WHERE zipcode='" . $_SESSION["searchlocation"] . "'";

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

                            if($_SESSION["searchdist"] >= $totaldist)
							{
                                $match_location = 'true';
								$playerlist[$matches]['dist'] = $totaldist;
							}
                        }
                    }
                }
                else
                    $match_location = 'true';

                if($match_true == 'true' && $match_location == 'true')
                {
					$playerlist[$matches]['name'] = $playername;
					$playerlist[$matches]['pic'] = $playerpic;
					$playerlist[$matches]['visit'] = $playervisit;
                    ++$matches;
                }
            }
        }
		
		if(isset($_POST['sort']))
			$_SESSION['sort'] = test_input($_POST['sort']);
		elseif(!isset($_SESSION['sort']))
			$_SESSION['sort'] = "random";
			
		if($_SESSION['sort'] == "distance")
			usort($playerlist, 'DistCompare');
		elseif($_SESSION['sort'] == "lastvisit")
			usort($playerlist, 'VisitCompare');
		else
			shuffle($playerlist);
		
		if($matches > 0)
		{
			for($iter = 0; $iter < $matches; ++$iter)
			{
				echo "<a class='profilebox' href='profile.php?name=" . $playerlist[$iter]['name'] . "'>" 
						. "<div class='profileresulttitle' >" . $playerlist[$iter]['name'] . "</div>";
					echo "<div class='profileresultpiccontainer'>";
						if(isset($playerlist[$iter]['pic']) && $playerlist[$iter]['pic'] != ""):
							echo "<div class='profileresultpic' style='background-position:center;background-size:cover;background-image: url(" . $playerlist[$iter]['pic'] . ");background-repeat:no-repeat;height:200px;width:200px;'></div>";
						else:
							echo "<img class='profileresultpic' src='img/nopicred.png'>";
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