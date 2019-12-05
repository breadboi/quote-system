<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$quoteId = $_REQUEST['id'];

$sql = "SELECT quotes.id AS 'Quote ID', customer_name AS Name, contact AS Contact, street AS Street, city AS City, discount AS Discount, line_number AS 'Line Number', description AS Description, price AS Price, status AS Status, date_created AS Date FROM quotes
WHERE id = ".$_REQUEST['id'].";";

$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
modalTableHead($rows);
modalTableBody($rows);

echo "<div class=\"form-group\">";
echo "<button id=\"sanctionQuoteButton\" type=\"button\" class=\"btn btn-success\" onclick=\"sanctionQuote($quoteId)\">Sanction Quote</button>";
echo "</div>";
?>