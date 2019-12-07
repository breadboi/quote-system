<!-- 
Update quotes query
parameters:       
        notes
        quoteDiscount
        quoteId

Updates the query based on the quoteId
 -->
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");

$notes = $_POST["quoteNotes"];
$quoteDiscount = $_POST["quoteDiscount"];
$quoteId = $_POST["quoteId"];

$sql = "UPDATE quotes
SET secret_notes=:notes, discount=:quoteDiscount
WHERE id=:quoteId;";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':notes' => $notes,
                         ':quoteDiscount' => $quoteDiscount,
                         ':quoteId' => $quoteId)); 
?>