<!-- 
    Ajax modal adds a new line item for selected quote
parameters:       
        quoteId
 -->
<?php
require_once(__DIR__ . "/../../../resources/library/devDatabase.php");
require_once(__DIR__ . "/../../../resources/library/tableformat.php");
require_once(__DIR__ . "/../../../resources/library/modalTableFormat.php");

//Variables
$quoteId = $_POST["quoteId"];

//Text Fields
echo "<div class=\"form-group\">";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\"";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\"";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\">";
echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemQuoteId\" id=\"lineItemQuoteId\" value=\"$quoteId\" readonly>";
echo "</div>";

//Buttons
echo "<div class=\"form-group\">";
echo "<button id=\"addItemButtonFinal\" type=\"button\" class=\"btn btn-success\" onclick=\"addLineItem()\">Add Line Item</button>";
echo "</div>";
?>