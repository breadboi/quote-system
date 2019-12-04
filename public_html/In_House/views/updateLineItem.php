<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");

$lineItemId = $_POST["lineItemId"];
$lineItemNumber = $_POST["lineItemNumber"];
$lineItemDescription = $_POST["lineItemDescription"];
$lineItemPrice = $_POST["lineItemPrice"];
$lineItemQuoteId = $_POST["lineItemQuoteId"];

$sql = "UPDATE line_item
SET line_number=:lineItemNumber, description=:lineItemDescription, price=:lineItemPrice, quote_id=:lineItemQuoteId
WHERE id=:lineItemId;";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':lineItemId' => $lineItemId,
                        ':lineItemNumber' => $lineItemNumber,
                        ':lineItemDescription' => $lineItemDescription,
                        ':lineItemPrice' => $lineItemPrice,
                        ':lineItemQuoteId' => $lineItemQuoteId)); 

?>