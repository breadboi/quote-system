<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$quoteId = $_REQUEST['quoteId'];

$sql = "SELECT customer_name AS Name, email AS Email, discount AS Discount, date_created AS 'Date Created'FROM quotes
WHERE id = $quoteId;";

$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
tableHead($rows);
tableBody($rows);

echo "<div class=\"form-group\">";
echo "<button id=\"sanctionQuoteButton\" type=\"button\" class=\"btn btn-success\" onclick=\"sanctionQuote($quoteId)\">Sanction Quote</button>";
echo "</div>";
?>