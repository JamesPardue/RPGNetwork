<!-- HEADER START -->

<?php
    $message_num = 0;

    if (isset($_SESSION["name"]))
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
            $_SESSION["updateerror"] = "Cannot connect to server.";
            die("Connection failed: " . $conn->connect_error);
            header("location: profile.php");
        }

        //Create database query
        $sql = "SELECT * FROM messages WHERE " .
            "(Player1='" . $_SESSION['name'] . "') OR (Player2='" . $_SESSION['name'] . "')";

        //Send query
        $result = $conn->query($sql);

        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc())
            {
                if($row['Player1'] == $_SESSION['name'] && $row['Player1New'] == 1)
                    ++$message_num;
                elseif($row['Player2'] == $_SESSION['name'] && $row['Player2New'] == 1)
                    ++$message_num;
            }
        }
		$conn->close();
    }

    $_SESSION['messagenum'] = $message_num;
?>

<script>
function ErrorHeaderLogin()
{
    document.getElementById("ID_headerlogin").classList.add("headerloginvisable");
}

function ErrorDropdownLogin()
{
    document.getElementById("ID_dropdown").classList.add("dropdown_visible");
    document.getElementById("ID_headertoggle").classList.add("headertogglehighlight");
    document.getElementById("ID_dropdownlogin").classList.add("dropdownloginvisable");
}

function HideHeaderLogin()
{
    document.getElementById("ID_headerlogin").classList.remove("headerloginvisable");
}

</script>

<?php
function headerloginerrorvisable()
{
    if(isset($_SESSION["loginerror"]))
    {
        echo "<script> ErrorHeaderLogin(); </script>";
    }
}

function dropdownloginerrorvisable()
{
	if(isset($_SESSION["name"]))
	{
		echo "<script> HideHeaderLogin(); </script>";
	}
    elseif(isset($_SESSION["loginerror"]))
    {
        echo "<script> ErrorDropdownLogin(); </script>";
    }
}
?>

<div class="header" role="banner" onload='CloseLogins()'>

    <div class="headercontainer">
        <a class="headerlogo" href="index.php">
            <img src="img/logo-rpgff.png"/>
        </a>

        <div class="headermenu">
            <?php if(isset($_SESSION["name"])): ?>
                <div class="headermenuitem">
                    <a class="headerlink headername">
                        <b>Hi <?php echo $_SESSION["name"]; ?></b>
                    </a>
                </div>
                <div class="headermenuitem">
                    <a class="headerlink" href="<?php echo 'messages.php?name=' .  $_SESSION["name"] ?>">
                        <?php if(isset($_SESSION['messagenum']) && $message_num >= 1): ?>
                            <i class="af af_newmessages"></i> Messages
                        <?php else: ?>
                            <i class="af af_nomessages"></i> Messages
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="headermenuitem">
                <a class="headerlink" href="home.php">
                    <i class="af af_home"></i>
                    Home
                </a>
            </div>
            <?php if(isset($_SESSION["name"])): ?>
                <div class="headermenuitem">
                    <a class="headerlink" href="<?php echo 'profile.php?name=' .  $_SESSION["name"] ?>">
                        <i class="af af_profile"></i>
                        Profile
                    </a>
                </div>
            <?php endif; ?>
            <div class="headermenuitem">
                <a class="headerlink" href="games.php">
                    <i class="af af_games"></i>
                    Games
                </a>
            </div>
            <div class="headermenuitem">
                <a class="headerlink" href="players.php">
                    <i class="af af_players"></i>
                    Players
                </a>
            </div>
            <?php if(isset($_SESSION["name"])): ?>
                <div class="headermenuitem" onclick="LogOut()">
                    <a class="headerlink">
                        <b>LOG OUT</b>
                    </a>
                </div>
            <?php else: ?>
                <div class="headermenuitem" onclick="ToggleHeaderLogin()">
                    <a class="headerlink">
                        <b>LOG IN</b>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <button onclick="ToggleDropdown()" type="button" class="headertoggle" id="ID_headertoggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="headerlogin" ID="ID_headerlogin">
        <?php headerloginerrorvisable() ?>
        <form class="login" method="post" action="login.php">
            <div class="logintext">
                Name
            </div>
            <input id="ID_loginname" class="logininput" type="text" name="name" size="15" maxlength="10">
            <div class="logintext">
                Password
            </div>
            <input id="ID_loginname" class="logininput" type="password" name="password" size="15" maxlength="10">
            <input class="loginbutton" type="submit" name="submit" value="OK">
        </form>
        <?php if(isset($_SESSION["loginerror"])): ?>
            <div class="headerloginerror">
                <?php echo $_SESSION["loginerror"]; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="headerdropdown" id="ID_dropdown">
        <?php if(isset($_SESSION["name"])): ?>
            <div class="dropdownbutton">
                <a class="headerlink headername">
                    <b>Hi <?php echo $_SESSION["name"];?></b>
                </a>
            </div>
			<div class="dropdownbutton">
				<a class="headerlink" href="<?php echo 'messages.php?name=' .  $_SESSION["name"] ?>">
					<?php if(isset($_SESSION['messagenum']) && $message_num >= 1): ?>
						<i class="af af_newmessages"></i> Messages
					<?php else: ?>
						<i class="af af_nomessages"></i> Messages
					<?php endif; ?>
				</a>
			</div>
        <?php endif; ?>
        <div class="dropdownbutton">
            <a class="headerlink" href="home.php">
                <i class="af af_home"></i>
                Home
            </a>
        </div>
        <?php if(isset($_SESSION["name"])): ?>
            <div class="dropdownbutton">
                <a class="headerlink" href="<?php echo 'profile.php?name=' .  $_SESSION["name"] ?>" >
                     <i class="af af_profile"></i>
                    Profile
                </a>
            </div>
        <?php endif; ?>
        <div class="dropdownbutton">
             <a class="headerlink" href="games.php">
                 <i class="af af_games"></i>
                Games
            </a>
        </div>
        <div class="dropdownbutton">
            <a class="headerlink" href="players.php">
                <i class="af af_players"></i>
                Players
            </a>
        </div>
        <?php if(isset($_SESSION["name"])): ?>
            <div class="dropdownbutton" onclick="LogOut()">
                <a class="headerlink">
                    <b>LOG OUT</b>
                </a>
            </div>
        <?php else: ?>
        <div class="dropdownbutton">
            <a onclick="ToggleDropdownLogin()" class="headerlink">
                <b>LOG IN</b>
            </a>
        </div>
        <?php endif; ?>
        <form class="dropdownlogin" ID="ID_dropdownlogin" method="post" action="login.php">
            <?php dropdownloginerrorvisable() ?>
            <div class="dropdownlogintext">
                Name
            </div>
            <input class="dropdownlogininput" type="text" name="name" size="15" maxlength="10">
            <div class="dropdownlogintext">
                Password
            </div>
            <input class="dropdownlogininput" type="password" name="password" size="15" maxlength="10">
            <?php if(isset($_SESSION["loginerror"])): ?>
                <div class="dropdownloginerror">
                    <?php echo $_SESSION["loginerror"]; ?>
                </div>
            <?php endif; ?>
            <input class="dropdownloginbutton" type="submit" name="submit" value="OK">
        </form>
    </div>

</div>
<!-- HEADER END -->
