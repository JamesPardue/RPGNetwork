<?php
session_start();

if(isset($_REQUEST["q"]))
{
    $data = $_REQUEST["q"];
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    //Save session information
    $_SESSION["gamesearchtab"] = $data;
    exit();
}
else
{
    header("location: index.php");
    exit();
}

?>