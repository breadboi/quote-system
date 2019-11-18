<?php
// File responsible for setting up our DEV database PDO

// Include our configuration file
require_once("../../resources/config.php");

// Get our connection info from the config file
$dbname = $config['db']['dev']['dbname'];
$username = $config['db']['dev']['username'];
$password = $config['db']['dev']['password'];
$host = $config['db']['dev']['host'];

try 
{
    $dsn = "mysql:host={$host};dbname={$dbname}";
    $devPdo = new PDO($dsn, $username, $password);
    $devPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}		
catch(PDOexception $e)
{
    echo "<div class=\"sqlFailure\">Connection to database failed: ".$e->getMessage();
}

?>