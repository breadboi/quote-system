<!-- 
Insert line_item
parameters:       
        lineItemNumber
        lineItemDescription
        lineItemPrice
        lineItemQuoteId

Inserts data into the database
 -->
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");

$lineItemNumber = $_POST["lineItemNumber"];
$lineItemDescription = $_POST["lineItemDescription"];
$lineItemPrice = $_POST["lineItemPrice"];
$lineItemQuoteId = $_POST["lineItemQuoteId"];

$sql = "INSERT INTO line_item (line_number, description, price, quote_id)
VALUES (:lineItemNumber, :lineItemDescription, :lineItemPrice, :lineItemQuoteId)";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':lineItemNumber' => $lineItemNumber,
                         ':lineItemDescription' => $lineItemDescription,
                         ':lineItemPrice' => $lineItemPrice,
                         ':lineItemQuoteId' => $lineItemQuoteId));

?>