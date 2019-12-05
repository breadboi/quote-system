<?php
    // Load config and functions
    require_once("../../resources/config.php");
    include("../../resources/library/devDatabase.php");
    require_once("../../resources/library/tableformat.php");

    //$searchChoice = $_POST["searchChoice"];                      

    $sql = "SELECT quotes.id as 'Quote ID', quotes.customer_name as 'Customer Name', sales_associates.name AS 'Associate Name', discount as Discount, quotes.secret_notes as 'Notes' FROM quotes
    INNER JOIN sales_associates ON sales_associates.id = quotes.sales_associate_id
    WHERE status=0";

    // Prepare pdo
    $query = $devPdo->query($sql);

    //$lineItemNumber = $_POST["lineItemNumber"];
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    tableHead($rows);
    tableBody($rows);

?>