<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

$sql = "SELECT line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = ".$_REQUEST['id'].";";

$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
modalTableHead($rows);
modalTableBody($rows);
?>