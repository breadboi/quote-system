<?php
// File responsible for setting up our legacy database PDO

// Include our configuration file
require_once("/resources/config.php");

// Get our connection info from the config file
$dbname = $config['db']['legacy']['dbname'];
$username = $config['db']['legacy']['username'];
$password = $config['db']['legacy']['password'];
$host = $config['db']['legacy']['host'];

// PHP Data Objects(PDO)
try 
{
    $legacyPDO = new PDO("mysql:host={$host};dbname={$dbname}", "{$username}", "{$password}");
	$legacyPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
    print("Error connecting to SQL Server.");
    die(print_r($e));
}		

?>