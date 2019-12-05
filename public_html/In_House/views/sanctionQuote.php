<?php
require_once(__DIR__ . "/../../../resources/library/devDatabase.php");

$quoteId = $_POST["quoteId"];

$sql = "UPDATE quotes
SET status=2
WHERE id=:quoteId;";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':quoteId' => $quoteId)); 
?>