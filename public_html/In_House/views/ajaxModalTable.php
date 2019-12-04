<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");

$pages = $devPdo->query("select line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = 1");
// ".$_REQUEST['id'].";");
$pages->fetchAll(PDO::FETCH_ASSOC);
echo "<h1>" . $pages . "</h1>";
tableHead($pages);
echo tableBody($pages);
?>