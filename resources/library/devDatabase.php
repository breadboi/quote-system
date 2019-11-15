<?php
// File responsible for setting up our DEV database PDO

// Include our configuration file
require_once("../../resources/config.php");

// Get our connection info from the config file
$dbname = $config['db']['dev']['dbname'];
$username = $config['db']['dev']['username'];
$password = $config['db']['dev']['password'];
$host = $config['db']['dev']['host'];

// PHP Data Objects(PDO)
try 
{
    $devPDO = new PDO("mysql:host={$host};dbname={$dbname}", "{$username}", "{$password}");
	$devPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

?>