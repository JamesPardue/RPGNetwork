<?php
session_start();

if(isset($_REQUEST["zip"]))
{
    $data = $_REQUEST["zip"];
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    //Save session information
    $_SESSION["searchlocation"] = $data;
    exit();
}
else
{
    header("location: index.php");
    exit();
}

?>