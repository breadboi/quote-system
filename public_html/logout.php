<!--
Group 5B
12/07/19
CSCI 467
Quote System

Purpose:
    This is the Logout page for the system.
    It simply ends the users current session and provides link to return to
    the index.
-->
<?php
session_start();
session_destroy();
require_once('../resources/library/bootstrap.php');
require_once(__DIR__ . "/../resources/library/devDatabase.php");
require_once('../resources/library/tableformat.php');
?>

<html>

<head>
    <title>Logout</title>
</head>

<body>
    <!--Page Head Title-->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-danger text-white rounded">
        <h1>Successfully Logged Out</h1>
    </div>
    <!--Back Button-->
    <div class="p-1 btn-group btn-group d-flex">
        <a href="index.php" class="btn btn-dark" role="button">Back To Home Page</a>
    </div>
</body>
<html>
