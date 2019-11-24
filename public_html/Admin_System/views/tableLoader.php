<?php
    // Load config and functions
    require_once("../../resources/config.php");
    include("../../resources/library/devDatabase.php");
    require_once("../../resources/library/tableformat.php");

    if (isset($_POST["searchChoice"]))
    {
        $searchChoice = $_POST["searchChoice"];            
        $sql = "";            

        // Set sql string
        switch($searchChoice)
        {
            case 0:
                $sql = "SELECT id AS ID, name AS Name, accumulated_commission AS 'Total Commission', address AS Address FROM sales_associates
                        WHERE name LIKE CONCAT('%', :salesAssociateName, '%');";
                break;
            case 1:
                $sql = "SELECT id AS ID, customer_name AS Name, contact AS Contact, street AS Street, city AS City, secret_notes AS Notes, discount AS Discount
                        WHERE customer_name LIKE CONCAT('%', :customerName, '%');";
                break;
        }
        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        // Perform respective query
        switch($searchChoice)
        {
            case 0:
                $salesAssociateName = $_POST["salesAssociateName"];
                $success = $prepared->execute(array(':salesAssociateName' => $salesAssociateName));
                if ($success)
                {
                    $rows = $prepared->fetchAll(PDO::FETCH_ASSOC);
                    tableHead($rows);
                    tableBody($rows);
                }
                else
                {
                    echo "<div class=\"failure\">An Error Occured... Please double check your search text</div>";
                }
            break;
            case 1:
                $customerName = $_POST["customerName"];
                $success = $prepared->execute(array(':customerName' => $customerName));
                if ($success)
                {
                    $rows = $prepared->fetchAll(PDO::FETCH_ASSOC);
                    tableHead($rows);
                    tableBody($rows);
                }
                else
                {
                    echo "<div class=\"failure\">An Error Occured... Please double check your search text</div>";
                }
            break;
        }
    }
?>