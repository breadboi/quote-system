<!-- 
    Ajax modal populates with a line item table
parameters:       
        Id
 -->
<?php
//Imports
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/tableformat.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/library/modalTableFormat.php");

//Variables
$sql = "SELECT id AS ID, line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = ".$_REQUEST['id'].";";

//Generate Table
$query = $devPdo->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
modalTableHead($rows);
modalTableBody($rows);

//Buttons
echo "<div class=\"form-group\">";
echo "<button id=\"addLineItemButton\" type=\"button\" class=\"btn btn-success\" onclick=\"loadInsertPage()\">Add Line Item</button>";
echo "</div>";
?>