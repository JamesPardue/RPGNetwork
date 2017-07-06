<?php 
//header('Cache-Control: no cache'); //no cache
//session_cache_limiter('private_no_expire'); // works
session_start();

//session_unset();
?>

<!DOCTYPE html>
<html>
<head>
    
<?php include 'head.php' ?>
    
</head>
<body onload="GetSearchResults('')">

<?php include 'header.php' ?>

<!-- SEARCH START -->
<div class="playersearch">
    <div class="playersheader">
        <div class="playerstitletext">Games Search</div>
        <div class="criteriacontainer">
            <div class="criteriabutton" onclick="ToggleDistanceCriteria()">Distance</div>
            <div class="criteriabutton" onclick="ToggleAvailabilityCriteria()">Type/Schedule</div>
            <div class="criteriabutton" onclick="ToggleSystemCriteria()">System</div>
            <div class="criteriabutton" onclick="TogglePlayStyleCriteria()">Play Style</div>
            <div class="criteriabutton" onclick="ToggleOtherCriteria()">Other</div>
			<div class="criteriabutton" onclick="ToggleSortCriteria()">Sort Results</div>
            <div style="clear: both"></div>
        </div>
        <form method="post" action="searchgames.php">
            <!-- DISTANCE -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==0); else echo("criteriainvisable"); ?>" id="ID_distance">
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Distance 
                    </div>
                    <div class="playercriteriaoptions">
                        <div class="profileedittext">
                            Zip Code
                        </div>
                        <select class="profileselect" name="distance" onchange='GetDistanceSearchResults(this)'>
                            <option value="dist_10" 
                                <?php if((isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] == 10)) echo "selected='selected'"; ?>>
                                Within 10 Miles
                            </option>
                            <option value="dist_25"
                                <?php if(isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] == 25) echo "selected='selected'"; ?>>
                                Within 25 Miles
                            </option>
                            <option value="dist_50" 
                                <?php if(isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] == 50) echo "selected='selected'"; ?>>
                                Within 50 Miles
                            </option>
                            <option value="dist_100" 
                                <?php if(isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] == 100) echo "selected='selected'"; ?>>
                                Within 100 Miles
                            </option>
                            <option value="dist_any" 
                                <?php if(!isset($_SESSION["gamesearchdist"]) || isset($_SESSION["gamesearchdist"]) && $_SESSION["gamesearchdist"] == 0) echo "selected='selected'"; ?>>
                                Any Distance
                            </option>
                        </select>
                        <input class="profilecriteriainput" id="ID_zipcode" type="text" name="location" size="25" maxlength="5" onkeyup="UpdateZipcodeSearch(this)"
                            <?php if(isset($_SESSION['gamesearchlocation'])): ?>
                                value="<?php echo $_SESSION['gamesearchlocation']; ?>"
                            <?php elseif(isset($_SESSION['location'])): ?>
                                value="<?php echo $_SESSION['location']; ?>"
                            <?php else: ?>
                                value=""
                            <?php endif; ?>
                            >
                    </div>
                </div>
            </div>
            <!-- AVAILABILITY -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==1); else echo("criteriainvisable"); ?>" id="ID_availability">
                <div class="playercriteria" id="ID_gametypecriteria">
                    <div class="playercriteriatitle">Game Type</div>
                    <div class="playercriteriaoptions" id="ID_gametypeoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="gametype_InPerson" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegametype']) || (isset($_SESSION['gamegametype']) && $_SESSION['gamegametype'][0]=="0")); 
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">In Person</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="gametype_OnlineWebcam" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegametype']) || (isset($_SESSION['gamegametype']) && $_SESSION['gamegametype'][1]=="0")); 
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Online (Webcam)</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="gametype_OnlineAudio" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegametype']) || (isset($_SESSION['gamegametype']) && $_SESSION['gamegametype'][2]=="0")); 
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Online (Audio)</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="gametype_OnlineTextOnly" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegametype']) || (isset($_SESSION['gamegametype']) && $_SESSION['gamegametype'][3]=="0")); 
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Online (Text Only)</label>
                    </div>
                </div>
                <div class="playercriteria">
                    <div class="playercriteriatitle">Play Rate</div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="rate_MoreThanOnceAWeek" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameplayrate']) || (isset($_SESSION['gameplayrate']) && $_SESSION['gameplayrate'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">More than Once a Week</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rate_Weekly" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameplayrate']) || (isset($_SESSION['gameplayrate']) && $_SESSION['gameplayrate'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Weekly</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rate_EveryTwoWeeks" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameplayrate']) || (isset($_SESSION['gameplayrate']) && $_SESSION['gameplayrate'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Every Two Weeks</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rate_Monthly" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameplayrate']) || (isset($_SESSION['gameplayrate']) && $_SESSION['gameplayrate'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Monthly</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rate_OnceInAWhile" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameplayrate']) || (isset($_SESSION['gameplayrate']) && $_SESSION['gameplayrate'][4]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Once In A While</label>
                    </div>
                </div>
                <div class="playercriteria">
                    <table class="profileavailability searchavailabilitytable" >
                        <tr>
                            <th class="searchavailabilityheadcol">Availability</th>
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
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][0]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][1]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][2]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][3]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][4]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][5]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Early" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameearly']) || (isset($_SESSION['gameearly']) && $_SESSION['gameearly'][6]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="headcol">Afternoon</td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][0]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][1]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][2]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][3]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][4]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][5]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Afternoon" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameafternoon']) || (isset($_SESSION['gameafternoon']) && $_SESSION['gameafternoon'][6]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="headcol">Evening</td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][0]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][1]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][2]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][3]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][4]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][5]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Evening" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gameevening']) || (isset($_SESSION['gameevening']) && $_SESSION['gameevening'][6]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="headcol">Late Night</td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Mon_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][0]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Tue_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][1]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Wed_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][2]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Thu_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][3]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Fri_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][4]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sat_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][5]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                            <td>
                                <input class="profileavailabilitycheckbox" type="checkbox" name="avail_Sun_Night" value="1" onChange='GetSearchResults(this)'
                                    <?php if(!isset($_SESSION['gamenight']) || (isset($_SESSION['gamenight']) && $_SESSION['gamenight'][6]=="0"));
                                        else echo "checked"; ?>>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- SYSTEM -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==2); else echo("criteriainvisable"); ?>" id="ID_system">
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Systems
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="system_OldSchool" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Old School/Old School Revival</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_DD3" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">D&amp;D 3.X/Pathfinder</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_DD4" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">D&amp;D 4</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_DD5" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">D&amp;D 5</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_PbtA" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][4]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">PbtA (Apoclypse World, Dungeon World, ...)</label>
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="system_WoD" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][5]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">World of Darkness (Vampire, Werewolf, ...)</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_BurningWheel" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][6]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Burning Wheel (Mouse Guard, Torch Bearer, ...</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_Other" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][7]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Other (Savage Worlds, GURPS, FATE, ...)</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_Hombrew" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][8]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Homebrew</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="system_BoardGames" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamesystem']) || (isset($_SESSION['gamesystem']) && $_SESSION['gamesystem'][9]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Board Games/MtG/Other Tabletop</label>
                    </div>
                </div>
            </div>
            <!-- PLAY STYLE -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==3); else echo("criteriainvisable"); ?>" id="ID_playstyle">
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Rules
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="rules_Written" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamerules']) || (isset($_SESSION['gamerules']) && $_SESSION['gamerules'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Rules as Written</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rules_Interpreted" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamerules']) || (isset($_SESSION['gamerules']) && $_SESSION['gamerules'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Rules as Interpreted</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rules_Suggested" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamerules']) || (isset($_SESSION['gamerules']) && $_SESSION['gamerules'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Rules as Suggested</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="rules_HouseRules" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamerules']) || (isset($_SESSION['gamerules']) && $_SESSION['gamerules'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">House Rules</label>
                    </div>
                </div>
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Style
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="style_Serious" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamestyle']) || (isset($_SESSION['gamestyle']) && $_SESSION['gamestyle'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Serious Roleplay</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="style_Silly" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamestyle']) || (isset($_SESSION['gamestyle']) && $_SESSION['gamestyle'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Silly Roleplay</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="style_Casual" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamestyle']) || (isset($_SESSION['gamestyle']) && $_SESSION['gamestyle'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Casual Game</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="style_Power" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamestyle']) || (isset($_SESSION['gamestyle']) && $_SESSION['gamestyle'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Power Gaming</label>
                    </div>
                </div>
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Genre
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Fantasy" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Fantasy</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_SciFi" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Sci-Fi</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Horror" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Horror</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Modern" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Modern</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Western" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][4]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Western</label>
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Historical" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][5]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Historical</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_PostApocolypse" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][6]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Post-Apocolypse</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Superhero" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][7]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Superhero</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="genre_Steampunk" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gamegenre']) || (isset($_SESSION['gamegenre']) && $_SESSION['gamegenre'][8]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Steampunk</label>
                    </div>
                </div>
            </div>
            <!-- OTHER -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==4); else echo("criteriainvisable"); ?>" id="ID_other">
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Status
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="gameactive" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameactive']) || (isset($_SESSION['gameactive']) && $_SESSION['gameactive']=="1"))
                                echo "checked"; ?>>
                        <label class="playercriterialabel">Active</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="playerswanted" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['playerswanted']) || (isset($_SESSION['playerswanted']) && $_SESSION['playerswanted']=="1"))
                                echo "checked"; ?>>
                        <label class="playercriterialabel">Players Wanted</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="dmwanted" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['dmwanted']) || (isset($_SESSION['dmwanted']) && $_SESSION['dmwanted']=="1"))
                                echo "checked"; ?>>
                        <label class="playercriterialabel">DM Wanted</label>
                    </div>
                </div>
				<div class="playercriteria">
                    <div class="playercriteriatitle">
                        Tone
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="tone_PG13" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gametone']) || (isset($_SESSION['gametone']) && $_SESSION['gametone'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">PG-13</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="tone_R" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gametone']) || (isset($_SESSION['gametone']) && $_SESSION['gametone'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">R</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="tone_M" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gametone']) || (isset($_SESSION['gametone']) && $_SESSION['gametone'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">M</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="tone_XXX" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gametone']) || (isset($_SESSION['gametone']) && $_SESSION['gametone'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">XXX</label>
                    </div>
                </div>
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Other
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="checkbox" name="other_Food" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameother']) || (isset($_SESSION['gameother']) && $_SESSION['gameother'][0]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Food</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="other_Alcohol" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameother']) || (isset($_SESSION['gameother']) && $_SESSION['gameother'][1]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Alcohol</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="other_Smoking" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameother']) || (isset($_SESSION['gameother']) && $_SESSION['gameother'][2]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Smoking</label>
                        <br>
                        <input class="playercriteriacheckbox" type="checkbox" name="other_Drugs" value="1" onChange='GetSearchResults(this)'
                            <?php if(!isset($_SESSION['gameother']) || (isset($_SESSION['gameother']) && $_SESSION['gameother'][3]=="0"));
                                else echo "checked"; ?>>
                        <label class="playercriterialabel">Drugs</label>
                    </div>
                </div>
            </div>
			<!-- SORT -->
            <div class="playercriteriacontainer 
                <?php if(isset($_SESSION['gamesearchtab'])&&$_SESSION['gamesearchtab']==5); else echo("criteriainvisable"); ?>" id="ID_sort">
                <div class="playercriteria">
                    <div class="playercriteriatitle">
                        Sort Results
                    </div>
                    <div class="playercriteriaoptions">
                        <input class="playercriteriacheckbox" type="radio" name="sort" value="random" onChange='SortResults(this)'
                            <?php if(!isset($_SESSION['gamesort']) || (isset($_SESSION['gamesort']) && $_SESSION['gamesort']=="random")) echo "checked"; ?>>
                        <label class="playercriterialabel">Random</label>
                        <br>
                        <input class="playercriteriacheckbox" type="radio" name="sort" value="distance" onChange='SortResults(this)'
                            <?php if(isset($_SESSION['gamesort']) && $_SESSION['gamesort']=="distance") echo "checked"; ?>>
                        <label class="playercriterialabel">By Distance</label>
                        <br>
                        <input class="playercriteriacheckbox" type="radio" name="sort" value="lastvisit" onChange='SortResults(this)'
                            <?php if(isset($_SESSION['gamesort']) && $_SESSION['gamesort']=="lastvisit") echo "checked"; ?>>
                        <label class="playercriterialabel">By Creation Date</label>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </form>
    </div>
    <div class="playerssection" id='ID_playerresults'>
        No Results
    </div>
</div>
<!-- RESULTS END -->

<?php include 'footer.php' ?>

<?php include 'js.php' ?>

<script>

var loadinghtml = "<div class=loader></div>";
    
var searchresults = "";
	
window.onscroll = function(ev) 
{
    if ((window.innerHeight + window.scrollY + 180) >= document.body.scrollHeight)
	{
		// you're at the bottom of the page
		AppendSearchResults();
    }
};

function AppendSearchResults()
{
	var length = searchresults.length;
	if(length != 0)
	{
		var endpos = searchresults.indexOf("<>");
		if(endpos != -1)
		{
			var append = searchresults.slice(0, endpos);
			searchresults = searchresults.slice(endpos + 2, length);
			document.getElementById('ID_playerresults').innerHTML += append;
		}
	}
}
	
function UpdateZipcodeSearch(source)
{    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = 
        function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
				searchresults = this.responseText;
				document.getElementById('ID_playerresults').innerHTML = "";
                AppendSearchResults();
            }
        };
    document.getElementById('ID_playerresults').innerHTML = loadinghtml;
	
    var searchquery = "";
    var updatesearchvariable = "";
    var updatesearchvalue = "";
    
    if(source.value.length > 2 && Number.isInteger(parseInt(source.value)) && parseInt(source.value) > 99)
        updatesearchvalue = parseInt(source.value);
    else
        updatesearchvalue = 0;
    updatesearchvariable = source.name;
    searchquery = updatesearchvariable + '=' + updatesearchvalue;
    
    xmlhttp.open("POST", "searchgames.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(searchquery);
}
    
function GetDistanceSearchResults(source)
{    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = 
        function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
				searchresults = this.responseText;
				document.getElementById('ID_playerresults').innerHTML = "";
                AppendSearchResults();
            }
        };
	document.getElementById('ID_playerresults').innerHTML = loadinghtml;
	
    var searchquery = "";
    var updatesearchvariable = "";
    var updatesearchvalue = "";
    updatesearchvariable = source.name;
    updatesearchvalue = source.options[ source.selectedIndex ].value;
    searchquery = updatesearchvariable + '=' + updatesearchvalue;

    xmlhttp.open("POST", "searchgames.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(searchquery);
}
    
function GetSearchResults(source)
{    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = 
        function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
				searchresults = this.responseText;
				document.getElementById('ID_playerresults').innerHTML = "";
                AppendSearchResults();
            }
        };
    document.getElementById('ID_playerresults').innerHTML = loadinghtml;
    
    var searchquery = "";
    var updatesearchvariable = "";
    var updatesearchvalue = "";
    updatesearchvariable = source.name;
    if(source.checked)
        updatesearchvalue = 1;
    else
        updatesearchvalue = 0;
    searchquery = updatesearchvariable + '=' + updatesearchvalue;

    xmlhttp.open("POST", "searchgames.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(searchquery);
}

function SortResults(source)
{    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = 
        function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
				searchresults = this.responseText;
				document.getElementById('ID_playerresults').innerHTML = "";
                AppendSearchResults();
            }
        };
    document.getElementById('ID_playerresults').innerHTML = loadinghtml;
    
    var searchquery = "";
    var updatesearchvariable = source.name;
    var updatesearchvalue = source.value;
    searchquery = updatesearchvariable + '=' + updatesearchvalue;

    xmlhttp.open("POST", "searchgames.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(searchquery);
}

function KeepSearchInfo()
{
	//Get current name/comment
	var zipcode = document.getElementById("ID_zipcode").value;
	
	//Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "gamekeepsearchinfo.php?zip="+zipcode, true);
	xhttp.send();
}
    
function EnableGameType(source)
{
    if(source.checked)
    {
        document.getElementsByName('gametype_InPerson')[0].disabled = false;
        document.getElementsByName('gametype_OnlineWebcam')[0].disabled = false;
        document.getElementsByName('gametype_OnlineAudio')[0].disabled = false;
        document.getElementsByName('gametype_OnlineTextOnly')[0].disabled = false;
        document.getElementById('ID_gametypecriteria').classList.remove("criteriagrey");
        document.getElementById('ID_gametypeoptions').classList.remove("criteriaoptionsgrey");
    }
    else
    {
        document.getElementsByName('gametype_InPerson')[0].disabled = true;
        document.getElementsByName('gametype_OnlineWebcam')[0].disabled = true;
        document.getElementsByName('gametype_OnlineAudio')[0].disabled = true;
        document.getElementsByName('gametype_OnlineTextOnly')[0].disabled = true;
        document.getElementById('ID_gametypecriteria').classList.add("criteriagrey");
        document.getElementById('ID_gametypeoptions').classList.add("criteriaoptionsgrey");
    }
}
    
function ToggleDistanceInput(source)
{
    if(source.selectedIndex == 4)
        document.getElementById("ID_zipcode").disabled = true;
    else
        document.getElementById("ID_zipcode").disabled = false;
}
    
function ToggleDistanceCriteria()
{
    document.getElementById('ID_distance').classList.toggle("criteriainvisable");
    document.getElementById('ID_availability').classList.add("criteriainvisable");
    document.getElementById('ID_system').classList.add("criteriainvisable");
    document.getElementById('ID_playstyle').classList.add("criteriainvisable");
    document.getElementById('ID_other').classList.add("criteriainvisable");
	document.getElementById('ID_sort').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "gamekeepsearchtab.php?q="+0, true);
	xhttp.send();
}
    
function ToggleAvailabilityCriteria()
{
    document.getElementById('ID_availability').classList.toggle("criteriainvisable");
    document.getElementById('ID_distance').classList.add("criteriainvisable");
    document.getElementById('ID_system').classList.add("criteriainvisable");
    document.getElementById('ID_playstyle').classList.add("criteriainvisable");
    document.getElementById('ID_other').classList.add("criteriainvisable");
	document.getElementById('ID_sort').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "gamekeepsearchtab.php?q="+1, true);
	xhttp.send();
}

function ToggleSystemCriteria()
{
    document.getElementById('ID_system').classList.toggle("criteriainvisable");
    document.getElementById('ID_distance').classList.add("criteriainvisable");
    document.getElementById('ID_availability').classList.add("criteriainvisable");
    document.getElementById('ID_playstyle').classList.add("criteriainvisable");
    document.getElementById('ID_other').classList.add("criteriainvisable");
	document.getElementById('ID_sort').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "gamekeepsearchtab.php?q="+2, true);
	xhttp.send();
}
    
function TogglePlayStyleCriteria()
{
    document.getElementById('ID_playstyle').classList.toggle("criteriainvisable");
    document.getElementById('ID_distance').classList.add("criteriainvisable");
    document.getElementById('ID_availability').classList.add("criteriainvisable");
    document.getElementById('ID_system').classList.add("criteriainvisable");
    document.getElementById('ID_other').classList.add("criteriainvisable");
	document.getElementById('ID_sort').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();	
	xhttp.open("POST", "gamekeepsearchtab.php?q="+3, true);
	xhttp.send();
}
    
function ToggleOtherCriteria()
{
    document.getElementById('ID_other').classList.toggle("criteriainvisable");
    document.getElementById('ID_distance').classList.add("criteriainvisable");
    document.getElementById('ID_availability').classList.add("criteriainvisable");
    document.getElementById('ID_system').classList.add("criteriainvisable");
    document.getElementById('ID_playstyle').classList.add("criteriainvisable");
	document.getElementById('ID_sort').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "gamekeepsearchtab.php?q="+4, true);
	xhttp.send();
}

function ToggleSortCriteria()
{
	document.getElementById('ID_sort').classList.toggle("criteriainvisable");
    document.getElementById('ID_distance').classList.add("criteriainvisable");
    document.getElementById('ID_availability').classList.add("criteriainvisable");
    document.getElementById('ID_system').classList.add("criteriainvisable");
    document.getElementById('ID_playstyle').classList.add("criteriainvisable");
	document.getElementById('ID_other').classList.add("criteriainvisable");
    
    //Set data to keepsessioninfo.php
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "gamekeepsearchtab.php?q="+5, true);
	xhttp.send();
}
    
</script>    
    
</body>
</html>