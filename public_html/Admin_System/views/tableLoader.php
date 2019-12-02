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
            // Sales Associate
            case 0:
                $sql = "SELECT id AS ID, name AS Name, accumulated_commission AS 'Total Commission', address AS Address FROM sales_associates
                        WHERE name LIKE CONCAT('%', :salesAssociateName, '%');";
            break;
            // Quote
            case 1:
                $sql = "SELECT quotes.id AS 'Quote ID', sales_associates.name AS 'Sales Associate Name', customer_name AS Name, contact AS Contact, street AS Street, city AS City, secret_notes AS Notes, discount AS Discount, line_number AS 'Line Number', description AS Description, price AS Price, status AS Status, date_created AS Date FROM quotes
                        INNER JOIN sales_associates ON sales_associates.id = quotes.sales_associate_id
                        INNER JOIN line_item ON line_item.quote_id = quotes.id
                        WHERE customer_name LIKE CONCAT('%', :customerName, '%')
                        AND sales_associates.name LIKE CONCAT('%', :salesAssociateName, '%')
                        AND (status = :finalizedStatus
                        OR status = :sanctionedStatus
                        OR status = :orderedStatus
                        )
                        AND date_created BETWEEN :startDate AND :endDate;";
            break;
        }
        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        // Perform respective query
        switch($searchChoice)
        {
            // Sales Associate
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
            // Quote
            case 1:
                $salesAssociateName = $_POST["salesAssociateName"];
                $customerName = $_POST["customerName"];

                // Handle date range
                $startDate = date("Y-m-d",strtotime(substr($_POST["daterange"], 0, 10)));
                $endDate = date("Y-m-d",strtotime(substr($_POST["daterange"], 13)));
                // finalizedStatus=0&sanctionedStatus=1&orderedStatus=2

                // Handle all checkbox options
                if(isset($_POST["finalizedStatus"]))
                    $finalizedStatus = $_POST["finalizedStatus"];
                else
                    $finalizedStatus = NULL;
                if(isset($_POST["sanctionedStatus"]))
                    $sanctionedStatus = $_POST["sanctionedStatus"];
                else
                    $sanctionedStatus = NULL;
                if(isset($_POST["orderedStatus"]))
                    $orderedStatus = $_POST["orderedStatus"];
                else
                    $orderedStatus = NULL;

                // If all of the above are NULL, we default to all set to search for all
                if ($finalizedStatus == NULL && $sanctionedStatus == NULL && $orderedStatus == NULL)
                {
                    $finalizedStatus = 0;
                    $sanctionedStatus = 1;
                    $orderedStatus = 2;
                }

                $success = $prepared->execute(array(':salesAssociateName' => $salesAssociateName,
                                                    ':customerName' => $customerName,
                                                    ':startDate' => $startDate,
                                                    ':endDate' => $endDate,
                                                    ':finalizedStatus' => $finalizedStatus,
                                                    ':sanctionedStatus' => $sanctionedStatus,
                                                    ':orderedStatus' => $orderedStatus));
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

    // Logic for Modal Form Submission
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