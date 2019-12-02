<?php
session_start();
session_destroy();
require_once('../resources/library/bootstrap.php');
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once('../resources/library/tableformat.php');
?>

<div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-danger text-white rounded">
    <h1>Successfully Logged Out</h1>
</div>

<div class="p-1 btn-group">
    <a href="index.php" class="btn btn-dark" role="button">Back To Home Page</a>
</div>