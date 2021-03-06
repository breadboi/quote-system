<!-- 
Update line_item
parameters:       
        lineItemId
        lineItemNumber
        lineItemDescription
        lineItemPrice
        lineItemQuoteId

Updates the query based on the lineItemId
 -->
<?php
require_once(__DIR__ . "/../../../resources/library/devDatabase.php");

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