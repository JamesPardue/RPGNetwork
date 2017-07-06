<?php
session_start();

if(isset($_SESSION["loginerror"]))
{
	$_SESSION["loginerror"] = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    
<?php include 'head.php' ?>
    
</head>
<body onload="CloseLogins()">
    
<?php include 'header.php' ?>

<div class="profile">
    
    <div class="profilesection">
        <div class="profiletitle">
            Create New Password
        </div>
		<div class="profilecontents">
			<?php
				if(isset($_SESSION['setnewpwerror']))
				{
					echo "<div class='headerloginerror'>" . $_SESSION['setnewpwerror'] . "</div>";
				}
			?>
            <form class="profileinfo" method="post" action="setnewpassword.php">
				<div>
					<div class="profileedittext">
						Name
					</div>
					<input class="signupinput" type="text" name="name" size="10" maxlength="35">
				</div>
				<div>
					<div class="profileedittext">
						Email
					</div>
					<input class="signupinput" type="text" name="email" size="10" maxlength="25">
				<div>
					<div class="profileedittext">
						Password Reset Code
					</div>
					<input class="signupinput" type="text" name="psresetcode" size="10" maxlength="35">
				</div>
				<div>
					<div class="profileedittext">
						New Password
					</div>
					<input class="signupinput" type="password" name="newpw" size="10" maxlength="25">
				</div>
				<div>
					<div class="profileedittext">
						Confirm New Password
					</div>
					<input class="signupinput" type="password" name="confirmnewpw" size="10" maxlength="25">
				</div>
				<input class="profilepicupdatebutton" type="submit" value="Reset Password" name="submit">
			</form>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>

<?php include 'js.php' ?>
    
</body>
</html>