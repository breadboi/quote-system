<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$lineItemId = $_POST["lineId"];
$lineNumber = $_POST["lineNumber"];
$description = $_POST["description"];
$price = $_POST["price"];

echo "<div class=\"form-group\">";
echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemId\" id=\"lineItemId\" value=\"$lineItemId\" readonly>";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\" value=\"$lineNumber\">";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\" value=\"$description\">";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\" value=\"$price\">";
echo "</div>";

echo "<div class=\"form-group\">";
echo "<button id=\"deleteLineItemButton\" type=\"button\" class=\"btn btn-danger\" >Delete Line Item</button>";
echo "</div>";
?>