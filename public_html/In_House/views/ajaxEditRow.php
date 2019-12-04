<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$lineItemId = $_POST["lineId"];
$lineNumber = $_POST["lineNumber"];
$description = $_POST["description"];
$price = $_POST["price"];

echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemId\" id=\"lineItemId\" value=\"$lineItemId\" readonly>";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\" value=\"$lineNumber\">";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\" value=\"$description\">";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\" value=\"$price\">";

/* $sql = "SELECT line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = ".$_REQUEST['id'].";";

$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
modalTableHead($rows);
modalTableBody($rows); */
?>