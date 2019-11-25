<?php    
  // Load config and functions
    require_once("resources\config.php");
    include("../../resources/library/devDatabase.php");
    require_once("../../resources/library/tableformat.php");


    $sql = "SELECT * FROM `prod`.`quotes`";
    $AllQuotes = $devPdo->query($sql);
    $rows = $AllQuotes->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";
?>
   
   
