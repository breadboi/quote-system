<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$quoteId = $_POST["quoteId"];

echo "<div class=\"form-group\">";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\"";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\"";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\">";
echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemQuoteId\" id=\"lineItemQuoteId\" value=\"$quoteId\" readonly>";
echo "</div>";

echo "<div class=\"form-group\">";
echo "<button id=\"addItemButtonFinal\" type=\"button\" class=\"btn btn-success\" onclick=\"addLineItem()\">Add Line Item</button>";
echo "</div>";
?>