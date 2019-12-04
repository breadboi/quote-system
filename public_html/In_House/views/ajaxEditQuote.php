<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$quoteId = $_POST["quoteId"];
$discount = $_POST["discount"];
$notes = $_POST["notes"];

echo "<div class=\"form-group\">";
echo "<label for=\"quoteDiscount\">Description</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"quoteDiscount\" id=\"quoteDiscount\" value=\"$discount\">";
echo "<label for=\"quoteNotes\">Price</label>";
echo "<input type=\"text\" class=\"form-control\" name=\"quoteNotes\" id=\"quoteNotes\" value=\"$notes\">";
echo "</div>";

echo "<div class=\"form-group\">";
echo "<button id=\"editQuoteButton\" type=\"button\" class=\"btn btn-success\" onclick=\"editQuote($quoteId)\">Save Changes</button>";
echo "</div>";
?>