<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    
<?php include 'head.php' ?>
    
</head>
<body>

<?php
function joinerrorvisable()
{
    if(isset($_SESSION["joinerror"]))
    {
        echo "signupvisable";
    }
}

function joinbuttoninvisable()
{
    if(isset($_SESSION["joinerror"]))
    {
        echo "joinbuttoninvisable";
    }
}
?>
    
<?php include 'header.php' ?>

<!-- SPLASH START -->
<div class="splash">
    
    <div class="splashcaption" >
        <h1 class="splashtitle">
            Find Players. Find Games.
        </h1>
        <h2 class="splashsubtitle">
            <b>Play the game you've always wanted.</b>
        </h2>
        <a onclick="ToggleSignup()" class="joinbutton <?php joinbuttoninvisable() ?>" ID="ID_joinbutton">
            Join Now
        </a>
        <form class="signup <?php joinerrorvisable() ?>" ID= "ID_signup" method="post" action="createprofile.php">
            <div class="inputsection" id="ID_nameinput">
                <div class="imputtext">
                    Name
                </div>
                <input class="signupinput" type="text" name="name" size="10" maxlength="20">
            </div>
            <div class="inputsection" id="ID_pw">
                <div class="imputtext">
                    Password
                </div>
                <input class="signupinput" type="password" name="password" size="10" maxlength="20">
            </div>
            <div class="inputsection" id="ID_email">
                <div class="imputtext">
                    Don't fill this out
                </div>
                <input class="signupinput" type="text" name="email" size="10" maxlength="10">
            </div>
            <div class="inputsection" id="ID_cpw">
                <div class="imputtext">
                    Confirm Password
                </div>
                <input class="signupinput" type="password" name="confirmpassword" size="10" maxlength="20">
            </div>
            <?php if(isset($_SESSION["joinerror"])): ?>
                <div class="signuperror">
                    <?php echo $_SESSION["joinerror"]; ?>
                </div>
            <?php endif; ?>
            <div class="submitsection">
                <input class="signupbutton" type="submit" name="submit" value="Sign Up">
            </div>
        </form>
    </div>
    
</div>    
<!-- SPLASH END -->
    
<!-- INFO START -->
<div class="info">
    
    <div class="infosection">
        <div class="infotitle">Find Games</div>
        <p class="infotext">
            Looking to find a group or join a game? Our Game-Search function will find the game you want to be a part of. Search on location, local or online, game system, session length, and many more. RPGFriendFinder was created to make sure you find the game you've always been looking for.
        </p>
    </div>
    <div class="infosection">
        <div class="infotitle">Find Players</div>
        <p class="infotext">
            Whether you're looking to start a brand new campaign or trying to add to an exisiting roster, our Player-Search function cane help. Browse through profiles to find the the right Player for your game, track the status of existing campaigns, and forge new friendships. Let the fun begin.
        </p>
    </div>
    <div class="infosection">
        <div class="infotitle">Totally Free</div>
        <p class="infotext">
            Every feature on RPGFriendFinder is free. No adds, no spam, no selling your data. All that's required is a name and password and you're ready to browse for games, players, and be a part of the RPGFriendFinder community. Looking to improve your RPG experience? What are you waiting for?
        </p>
    </div>
    
</div>
<!-- INFO END -->
    
<?php include 'footer.php' ?>

<?php include 'js.php' ?>
    
</body>
</html>