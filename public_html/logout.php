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
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-danger text-white rounded">
        <h1>Successfully Logged Out</h1>
    </div>

    <div class="p-1 btn-group btn-group d-flex">
        <a href="index.php" class="btn btn-dark" role="button">Back To Home Page</a>
    </div>
</body>
<html>
