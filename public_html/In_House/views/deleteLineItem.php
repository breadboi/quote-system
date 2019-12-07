<!-- 
Delete line_item
parameters:       
        lineItemId
Delete data from the database based on lineItemId
 -->
<?php
require_once(__DIR__ . "/../../../resources/library/devDatabase.php");

$lineItemId = $_POST["lineItemId"];

$sql = "DELETE FROM line_item
        WHERE id=:lineItemId;";

$prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$prepared->execute(array(':lineItemId' => $lineItemId));

?>