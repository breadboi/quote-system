<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

echo "<div class=\"form-group\">";
echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemId\" id=\"lineItemId\">";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\"";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\"";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\">";
echo "</div>";

echo "<div class=\"form-group\">";
echo "<button id=\"addLineItemButton\" type=\"button\" class=\"btn btn-success\" onclick=\"addLineItem()\">Add Line Item</button>";
echo "</div>";
?>