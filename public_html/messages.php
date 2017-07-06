<?php session_start(); ?>

<!DOCTYPE html>

<html>
<head>
    
<?php include 'head.php' ?>
    
</head>
<body class='mobilenegatescroll'
    <?php 
        if(isset($_REQUEST['message']))
            echo " onload='UpdateMessages(" . $_REQUEST['message'] . ", 1)'";
    ?>
>
    
<?php include 'header.php' ?>

<?php
function GetMessages()
{
    if(isset($_REQUEST['name']) && $_REQUEST['name'] == $_SESSION['name'])
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

        $name = test_input($_REQUEST['name']);
        //Create database query
        $sql = "SELECT * FROM messages WHERE " .
            "Player1='" . $name . "'" .
            "OR " .
            "Player2='" . $name . "'";

        //Send query
        $result = $conn->query($sql);

        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $dateformat = strtotime($row['Date']);
                $date = date("M j, Y", $dateformat);
                
                $fromplayer = "";
                $new = "";
				$updateplayer = "";
				$updatenew = "";
				$newmessageid = $row['MessageID'];
                if($row['Player1'] == $_SESSION['name'])
                {
                    $fromplayer = $row['Player2'];
                    $new = $row['Player1New'];
					$updatenew = "Player1New";
                }
                elseif($row['Player2'] == $_SESSION['name'])
                {
                    $fromplayer = $row['Player1'];
                    $new = $row['Player2New'];
					$updatenew = "Player2New";
                }
                
                $currentmessage = "";
                if((isset($_REQUEST['message']))&&($row['MessageID'] == $_REQUEST['message']))
				{
                    $currentmessage = "currentmessage";
					//Create database query
					$newsql = "UPDATE messages SET $updatenew='0' WHERE " . "MessageID='$newmessageid'";
					//Update New Result
					$updatenewresult = $conn->query($newsql);
				}
                
                echo "<a href='messages.php?name=" . $_SESSION['name'] . "&message=" . $row['MessageID'] . "'>";
                    if($new == "1") echo "<div class='newmessageitem $currentmessage'>";
                    else echo "<div class='messageitem $currentmessage'>";
                        echo "<div class='messageitemtext $currentmessage'>" . $fromplayer . "</div>";
                        echo "<div class='messageitemdate $currentmessage'>" . $date . "</div>";
                    echo "</div>";
                echo "</a>";
            }
        }

        $conn->close();
    }
    else
    {
        if(isset($_SESSION['name']))
        {
            $headertext = "location: messages.php?name=" . $_SESSION['name'];
            header($headertext);
            exit();
        }
        else
        {
            header("location: index.php");
            exit();
        }
    }
}
    
function GetMessageContent()
{
    if(isset($_REQUEST['message']))
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
        
        $message = test_input($_REQUEST['message']);
        
        //Create database query
        $sql = "SELECT * FROM messages WHERE MessageID='" . $message . "'";

        //Send query
        $result = $conn->query($sql);

        //If there is more than 0 rows
        if ($result->num_rows > 0)
        {
            //Output data of each row
            while($row = $result->fetch_assoc()) 
            {
                if(($row['Player1'] == $_SESSION['name'])||($row['Player2'] == $_SESSION['name']))
                {
                    $content = nl2br($row['Content']);
                    $fromplayer = "";
                    $toplayer = "";
                    $updatenew = "";
					
					if($row['Player1'] == $_SESSION['name'])
                    {
                        $fromplayer = $row['Player1'];
                        $toplayer = $row['Player2'];
                        $updatenew = "Player1New";
                    }
                    elseif($row['Player2'] == $_SESSION['name'])
                    {
                        $fromplayer = $row['Player2'];
                        $toplayer = $row['Player1'];
                        $updatenew = "Player2New";
                    }
                    
                    echo "<div class='messagecontent' id='ID_messagecontent'>";
                        echo "<div class='replyheader'>" . $toplayer;
                             echo "<div class='closemessagebutton' onclick='CloseMessage()'><b>X</b></div>";
                        echo "</div>";
                        echo "<div class='messagetext' id='ID_messagecontent1' onload='ScrollToReplyBottom('ID_messagecontent1)'></div>";
                        echo "<div class='messagetext' id='ID_messagecontent2'></div>";
						echo "<div class='messagetext' id='ID_messagecontentbuffer' style='display:none;'></div>";
                        echo "<div class='replymessage' id='ID_replymessage'>";
                            echo "<input class='nonvisiblereplyinput' id='ID_from' size='25' maxlength='50' 
                                value=" . $fromplayer . ">";
                            echo "<input class='nonvisiblereplyinput' id='ID_messageid' size='25' maxlength='50' 
                                value=" . $row['MessageID'] . ">";
                            echo "<textarea class='replytextarea' id='ID_sendcontent' rows='4' cols='50' maxlength='500'></textarea>";
                            echo "<div class='sendmessagebutton' onclick='SendMessage()'>Send</div>";
                        echo "</div>";
                    echo "</div>";
                    
                    $sql = "UPDATE Messages SET " . $updatenew . "=0 WHERE MessageID='" . $row['MessageID'] . "'";
                    $conn->query($sql);
                }
                else
                {
                    $conn->close();
                    $headertext = "location: messages.php?name=" . $_SESSION['name'];
                    header($headertext);
                    exit();
                }
            }
        }
        else
        {
            $conn->close();
            echo "<div class='messagecontent nomessagetext'>";
                echo "<div class='messagetext'>No message selected.</div>";
            echo "</div>";
        }

        $conn->close();
    }
    else
    {
        echo "<div class='messagecontent nomessagetext'>";
            echo "<div class='messagetext'><b>No messages selected</b></div>";
        echo "</div>";
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
    
<!-- ABOUT START -->
<div class="messages mobilenegatescroll">
    
    <div class="messagesectiontitle">Messages</div>
    <div class="messagessection">
        <div class="messagelist">
            <?php GetMessages(); ?>
        </div>
        <?php GetMessageContent(); ?>
    </div>

</div>
    
<!-- ABOUT END -->

<script>

function SendMessage()
{
    if (<?php echo isset($_SESSION['name']); ?>) 
	{
		var params = "";
		params += "from=";
		params += document.getElementById("ID_from").value;
		params += '&';
		params += "messageid=";
		params += document.getElementById("ID_messageid").value;
		params += '&';
		params += "content=";
		params += document.getElementById("ID_sendcontent").value;
		
		document.getElementById("ID_sendcontent").value = "";
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "sendmessage.php");
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send(params);
	}
}

function CloseMessage()
{
    document.location.href = "messages.php?name=<?php echo $_SESSION['name']; ?>";
}

function ShowReply()
{
    document.getElementById("ID_replymessage").classList.toggle("showreplymessage");
}

function ScrollToReplyBottom(div)
{
    var objDiv = document.getElementById(div);
    objDiv.scrollTop = objDiv.scrollHeight;
}
    
function UpdateMessages(str, newid)
{    
    if (<?php echo isset($_SESSION['name']); ?>) 
	{ 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = 
			function()
			{
                if (this.readyState == 4 && this.status == 200)
                {
                    var responsetext = this.responseText;

                    var newdiv = "";
                    var olddiv = "";
                    if(newid == 1)
                    {
                        newdiv = "ID_messagecontent1";
                        olddiv = "ID_messagecontent2";
                    }
                    else
                    {
                        newdiv = "ID_messagecontent2";
                        olddiv = "ID_messagecontent1";
                    }
					//alert(document.getElementById(olddiv).innerHTML);
                    document.getElementById(newdiv).innerHTML = responsetext;
					//alert(document.getElementById(newdiv).innerHTML);

                    if(document.getElementById(newdiv).innerHTML != document.getElementById(olddiv).innerHTML)
					{
						document.getElementById(newdiv).innerHTML = responsetext;
						document.getElementById(newdiv).setAttribute("style", "display: block;");
						document.getElementById(olddiv).setAttribute("style", "display: none;");
						ScrollToReplyBottom("ID_messagecontent");
					}
                }
			};
        xmlhttp.open("GET", "getmessage.php?message=" + str, true);
        xmlhttp.send();
    }
    
	if(newid == 1)
		newid = 2;
	else
		newid = 1;
	
    setTimeout("UpdateMessages(" + str + ", " + newid + ")", 2000);
}
    
</script>
    
<?php include 'footer.php' ?>
    
<?php include 'js.php' ?>
        
</body>
</html>