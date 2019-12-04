<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/tableformat.php");

$pages = $devPdo->query("select line_number as 'Line Number', description as 'Description', price as 'Price' FROM line_item
WHERE line_item.quote_id = ".$_REQUEST['id'].";");
$pages->fetchAll(PDO::FETCH_ASSOC);

if(!empty($pages)) {
?>
<h3><?php echo $pages[0]['title'];?></h3>
<div><?php echo $pages[0]['content'];?></p>
<?php } ?>