<!-- 
    Ajax modal that selects a quote for editing and allows for discount and notes to be changed
parameters:       
        quoteId
        discount
        notes
 -->
<?php
//Imports
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

//Variables
$quoteId = $_POST["quoteId"];
$discount = $_POST["quoteDiscount"];
$notes = $_POST["quoteNotes"];

//Text fields
echo "<div class=\"form-group\">";
echo "<label for=\"quoteDiscount\">Discount</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"quoteDiscount\" id=\"quoteDiscount\" value=\"$discount\">";
echo "<label for=\"quoteNotes\">Notes</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"quoteNotes\" id=\"quoteNotes\" value=\"$notes\">";
echo "</div>";

//Buttons
echo "<div class=\"form-group\">";
echo "<button id=\"editQuoteButton\" type=\"button\" class=\"btn btn-success\" onclick=\"editQuoteItem()\">Save Changes</button>";
echo "</div>";
?>