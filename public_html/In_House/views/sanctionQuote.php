<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");

$quoteId = $_POST["quoteId"];

$sql = "UPDATE quotes
SET status=1
WHERE id=:quoteId;";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':quoteId' => $quoteId)); 
?>