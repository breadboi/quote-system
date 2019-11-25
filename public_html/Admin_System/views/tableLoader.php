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

    if (isset($_POST["associateChoice"]))
    {
        $searchChoice = $_POST["associateChoice"];            
        $sql = "";

        // 0 = Add, 1 = Edit, 2 = Delete
        switch($searchChoice)
        {
            case 0:
                $sql = "INSERT INTO sales_associates (name, password, accumulated_commission, address)
                        VALUES (:associateName, MD5(:associatePassword), :associateCommission, :associateAddress)";
            break;
            case 1:                
                if($_POST["associatePassword"] != "")
                {
                    $sql = "UPDATE sales_associates
                            SET name=:associateName, password=:associatePassword, accumulated_commission=:associateCommission, address=:associateAddress
                            WHERE id=:associateId;";
                }
                else
                {
                    $sql = "UPDATE sales_associates
                            SET name=:associateName, accumulated_commission=:associateCommission, address=:associateAddress
                            WHERE id=:associateId;";
                }
                
            break;
            case 2:
                $sql = "DELETE FROM sales_associates
                        WHERE id=:associateId;";
            break;
        }

        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        // 0 = Add, 1 = Edit, 2 = Delete
        switch($searchChoice)
        {
            case 0:
                // Setup variables
                $associateName = $_POST["associateName"];
                $associatePassword = $_POST["associatePassword"];
                $associateCommission = $_POST["associateCommission"];
                $associateAddress = $_POST["associateAddress"];

                $prepared->execute(array(':associateName' => $associateName,
                                         ':associatePassword' => $associatePassword,
                                         ':associateCommission' => $associateCommission,
                                         ':associateAddress' => $associateAddress));
            break;
            case 1:
                // Setup variables
                $associateId = $_POST["associateId"];
                $associateName = $_POST["associateName"];                
                $associateCommission = $_POST["associateCommission"];
                $associateAddress = $_POST["associateAddress"];

                // Execute based on if password is provided
                if($_POST["associatePassword"] != "")
                {
                    $associatePassword = $_POST["associatePassword"];
                    $prepared->execute(array(':associateId' => $associateId,
                                         ':associateName' => $associateName,
                                         ':password' => $associatePassword,
                                         ':associateCommission' => $associateCommission,
                                         ':associateAddress' => $associateAddress));
                }
                else
                {
                    $prepared->execute(array(':associateId' => $associateId,
                                         ':associateName' => $associateName,
                                         ':associateCommission' => $associateCommission,
                                         ':associateAddress' => $associateAddress));
                }                
                
            break;
            case 2:
                // Setup variables
                $associateId = $_POST["associateId"];
                $prepared->execute(array(':associateId' => $associateId));
            break;
        }
    }
?>