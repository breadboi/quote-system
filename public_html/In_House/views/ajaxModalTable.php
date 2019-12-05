<?php
require_once(__DIR__ . "/../../../resources/library/devDatabase.php");
require_once(__DIR__ . "/../../../resources/library/tableformat.php");
require_once(__DIR__ . "/../../../resources/library/modalTableFormat.php");

$sql = "SELECT id AS ID, line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = ".$_REQUEST['id'].";";

$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
modalTableHead($rows);
modalTableBody($rows);

echo "<div class=\"form-group\">";
echo "<button id=\"addLineItemButton\" type=\"button\" class=\"btn btn-success\" onclick=\"loadInsertPage()\">Add Line Item</button>";
echo "</div>";
?>