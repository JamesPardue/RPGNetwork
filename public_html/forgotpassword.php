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
            Reset Password
        </div>
		<div class="profilecontents">
			<?php
				if(isset($_SESSION['reseterror']))
				{
					echo "<div class='headerloginerror'>" . $_SESSION['reseterror'] . "</div>";
				}
			?>
            <form class="profileinfo" method="post" action="resetpassword.php">
				<div>
					<div class="profileedittext">
						Name
					</div>
					<input class="signupinput" type="text" name="name" size="10" maxlength="25">
				</div>
				<div>
					<div class="profileedittext">
						Email
					</div>
					<input class="signupinput" type="text" name="email" size="10" maxlength="25">
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