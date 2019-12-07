<!-- 
    Ajax modal that selects line item for editing from a quote
parameters:       
        lineItemId
        lineNumber
        description
        price
 -->
<?php
//Imports
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

//Variables
$lineItemId = $_POST["lineId"];
$lineNumber = $_POST["lineNumber"];
$description = $_POST["description"];
$price = $_POST["price"];

//Text fields
echo "<div class=\"form-group\">";
echo "<input type=\"text\" class=\"form-control hiddenControl\" name=\"lineItemId\" id=\"lineItemId\" value=\"$lineItemId\" readonly>";
echo "<label for=\"lineItemNumber\">Line Number</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemNumber\" id=\"lineItemNumber\" value=\"$lineNumber\">";
echo "<label for=\"lineItemDescription\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemDescription\" id=\"lineItemDescription\" value=\"$description\">";
echo "<label for=\"lineItemPrice\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"lineItemPrice\" id=\"lineItemPrice\" value=\"$price\">";
echo "</div>";

//Buttons
echo "<div class=\"form-group\">";
echo "<button id=\"deleteLineItemButton\" type=\"button\" class=\"btn btn-danger\" onclick=\"deleteLineItem($lineItemId)\">Delete Line Item</button>";
echo "<button id=\"editLineItemButton\" type=\"button\" class=\"btn btn-success\" onclick=\"editLineItem($lineItemId)\">Save Changes</button>";
echo "</div>";
?>