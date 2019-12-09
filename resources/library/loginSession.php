<?php
/**
 * Group 5B
 * 12/07/19
 * CSCI 467
 * Quote System
 *  Purpose:
 *  Processes login verification for every page in the program
 */
session_start();
//If User is signed in.
if ( isset( $_SESSION['user_id'] ) ) 
{
    $loggedIn = '<p style="text-align:center" class="bg-success text-white">Logged In As: ' . $_SESSION["user_id"];
    /**Print out wether user is admin or not. */
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
    //Redirect to the login page.
    header("Location: http://students.cs.niu.edu/~z1860518/Quote_System/public_html/login.php");
}
?>