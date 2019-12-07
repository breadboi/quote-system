<!-- 
    Ajax modal that selects a quote for sanctioning
parameters:       
        quoteId
 -->
<?php
//Imports
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

//Variables
$quoteId = $_REQUEST['quoteId'];

//Query
$sql = "SELECT customer_name AS Name, email AS Email, discount AS Discount, date_created AS 'Date Created'FROM quotes
WHERE id = $quoteId;";

//Table Constructor
$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
tableHead($rows);
tableBody($rows);

//Button
echo "<div class=\"form-group\">";
echo "<button id=\"sanctionQuoteButton\" type=\"button\" class=\"btn btn-success\" onclick=\"sanctionQuote($quoteId)\">Sanction Quote</button>";
echo "</div>";
?>