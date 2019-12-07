<?php
session_start();

if ( isset( $_SESSION['user_id'] ) ) 
{
    $loggedIn = '<p style="text-align:center" class="bg-success text-white">Logged In As: ' . $_SESSION["user_id"];
    if($_SESSION['admin'] == true)
    {
        $loggedIn = $loggedIn . ' - Admin' . '</p>';
    }
    else
    {
        $loggedIn = $loggedIn . ' - Standard User' . '</p>';
    }
    echo $loggedIn;
}
else 
{
    header("Location: /public_html/login.php");
}
?>