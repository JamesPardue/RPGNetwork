<?php

//Create connection
$servername = "localhost";
$username = "protoj18_dbuser";
$dbpassword = "Kobe08jpx";
$dbname = "protoj18_RPGFF";
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

//Player 1
//Create database query
$sql = "SELECT * FROM messages WHERE " .
	"Player1New='1' AND Player1Reminded='0'";
	
//Send query
$result = $conn->query($sql);

//If there is more than 0 rows
if ($result->num_rows > 0)
{
	//Output data of each row
	while($row = $result->fetch_assoc()) 
	{
		$messagedate = strtotime($row['Date']);
		$currenttime = strtotime(date('Y-m-d H:i:s'));
		$diff = $currenttime - $messagedate;
		//3 Days is about 300000 seconds
		if($diff > 300000)
		{
			//Create database query
			$sql = "SELECT * FROM players WHERE " .
				"name='" . $row['Player1'] . "'";
				
			//Send query
			$result_1 = $conn->query($sql);
			if ($result_1->num_rows > 0)
			{
				//Output data of each row
				while($row_1 = $result_1->fetch_assoc()) 
				{
					if(isset($row_1[Email]) && $row_1[Email] != "")
					{
						//Create Message
						$to = $row_1[Email];
						$subject = "You Have New Message At RPGFriendFinder";
						$message = 
							"You Have New Message At www.RPGFriendFinder.com. Follow the link and log in to see them. If you hate getting this message, edit your profile to turn off Email Updates.";
						$headers = "From: emailupdate@rpgfriendfinder.com" . " " .
								   "Reply-To: emailupdate@rpgfriendfinder.com" . " " .
								   "X-Mailer: PHP/" . phpversion();
						//Send Email
						$sentmail = mail($to,$subject,$message,null,'-femailupdate@rpgfriendfinder.com');
					}
				}
			}
			$sql = "UPDATE messages SET Player1Reminded='1' WHERE MessageID='" . $row["MessageID"] . "'";
			//Send query
			$result_2 = $conn->query($sql);
		}
	}
}

//Player 2
//Create database query
$sql = "SELECT * FROM messages WHERE " .
	"Player2New='1' AND Player2Reminded='0'";
	
//Send query
$result = $conn->query($sql);

//If there is more than 0 rows
if ($result->num_rows > 0)
{
	//Output data of each row
	while($row = $result->fetch_assoc()) 
	{
		$messagedate = strtotime($row['Date']);
		$currenttime = strtotime(date('Y-m-d H:i:s'));
		$diff = $currenttime - $messagedate;
		//3 Days is about 300000 seconds
		if($diff > 300000)
		{
			//Create database query
			$sql = "SELECT * FROM players WHERE " .
				"name='" . $row['Player2'] . "'";
				
			//Send query
			$result_1 = $conn->query($sql);
			if ($result_1->num_rows > 0)
			{
				//Output data of each row
				while($row_1 = $result_1->fetch_assoc()) 
				{
					if(isset($row_1[Email]) && $row_1[Email] != "")
					{
						//Create Message
						$to = $row_1[Email];
						$subject = "You Have New Message At RPGFriendFinder";
						$message = 
							"You Have New Message At www.RPGFriendFinder.com. Follow the link and log in to see them. If you hate getting this message, edit your profile to turn off Email Updates.";
						$headers = "From: emailupdate@rpgfriendfinder.com" . " " .
								   "Reply-To: emailupdate@rpgfriendfinder.com" . " " .
								   "X-Mailer: PHP/" . phpversion();
						//Send Email
						$sentmail = mail($to,$subject,$message,null,'-femailupdate@rpgfriendfinder.com');
					}
				}
			}
			$sql = "UPDATE messages SET Player2Reminded='1' WHERE MessageID='" . $row["MessageID"] . "'";
			//Send query
			$result_2 = $conn->query($sql);
		}
	}
}

//Close connection
$conn->close();

/*
Test Email Code
//Create Message
$to = "protoj18@yahoo.com";
$subject = "CRON TEST$$$";
$message = "CRON TEST:" . $diff;
$headers = "From: emailupdate@rpgfriendfinder.com" . "\r\n" .
	   "Reply-To: emailupdate@rpgfriendfinder.com" . "\r\n" .
	   "X-Mailer: PHP/" . phpversion();
//Send Email
$sentmail = mail($to,$subject,$message,null,'-femailupdate@rpgfriendfinder.com');
*/
?>