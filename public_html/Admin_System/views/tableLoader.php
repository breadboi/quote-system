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
                $sql = "SELECT id AS ID, line_number as 'Line Number', description as 'Description', price as Price, quote_id as 'Quote ID' FROM line_item
                        WHERE line_number LIKE CONCAT('%', :lineItemNumber, '%');";
            break;
            // Quote
            case 1:
                $sql = "SELECT quotes.id AS 'Quote ID', sales_associates.name AS 'Line Item Number', customer_name AS Name, contact AS Contact, street AS Street, city AS City, secret_notes AS Notes, discount AS Discount, line_number AS 'Line Number', description AS Description, price AS Price, status AS Status, date_created AS Date FROM quotes
                        INNER JOIN sales_associates ON sales_associates.id = quotes.sales_associate_id
                        INNER JOIN line_item ON line_item.quote_id = quotes.id
                        WHERE customer_name LIKE CONCAT('%', :customerName, '%')
                        AND sales_associates.name LIKE CONCAT('%', :lineItemNumber, '%')
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
                $lineItemNumber = $_POST["lineItemNumber"];
                $success = $prepared->execute(array(':lineItemNumber' => $lineItemNumber));
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
                $lineItemNumber = $_POST["lineItemNumber"];
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

                $success = $prepared->execute(array(':lineItemNumber' => $lineItemNumber,
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
    if (isset($_POST["lineItemChoice"]))
    {
        $searchChoice = $_POST["lineItemChoice"];            
        $sql = "";

        // 0 = Add, 1 = Edit, 2 = Delete
        switch($searchChoice)
        {
            case 0:
                // $sql = "INSERT INTO sales_associates (name, password, accumulated_commission, address)
                //         VALUES (:lineItemNumber, MD5(:associatePassword), :lineItemPrice, :lineItemQuoteId)";
                $sql = "INSERT INTO line_item (line_number, description, price, quote_id)
                        VALUES (:lineItemNumber, :lineItemDescription, :lineItemPrice, :lineItemQuoteId)";
            break;
            case 1:                
                // $sql = "UPDATE sales_associates
                //         SET name=:lineItemNumber, accumulated_commission=:lineItemPrice, address=:lineItemQuoteId
                //         WHERE id=:lineItemId;";
                $sql = "UPDATE line_item
                        SET line_number=:lineItemNumber, description=:lineItemDescription, price=:lineItemPrice, quote_id=:lineItemQuoteId
                        WHERE id=:lineItemId;";
            break;
            case 2:
                $sql = "DELETE FROM line_item
                        WHERE id=:lineItemId;";
            break;
        }

        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        // 0 = Add, 1 = Edit, 2 = Delete
        switch($searchChoice)
        {
            case 0:
                // Setup variables
                $lineItemNumber = $_POST["lineItemNumber"];
                $lineItemDescription = $_POST["lineItemDescription"];
                $lineItemPrice = $_POST["lineItemPrice"];
                $lineItemQuoteId = $_POST["lineItemQuoteId"];

                $prepared->execute(array(':lineItemNumber' => $lineItemNumber,
                                         ':lineItemDescription' => $lineItemDescription,
                                         ':lineItemPrice' => $lineItemPrice,
                                         ':lineItemQuoteId' => $lineItemQuoteId));
            break;
            case 1:
                // Setup variables
                $lineItemId = $_POST["lineItemId"];
                $lineItemNumber = $_POST["lineItemNumber"];   
                $lineItemDescription = $_POST["lineItemDescription"];             
                $lineItemPrice = $_POST["lineItemPrice"];
                $lineItemQuoteId = $_POST["lineItemQuoteId"];

                $lineItemDescription = $_POST["lineItemDescription"];
                $prepared->execute(array(':lineItemId' => $lineItemId,
                                        ':lineItemNumber' => $lineItemNumber,
                                        ':lineItemDescription' => $lineItemDescription,
                                        ':lineItemPrice' => $lineItemPrice,
                                        ':lineItemQuoteId' => $lineItemQuoteId));           
                
            break;
            case 2:
                // Setup variables
                $lineItemId = $_POST["lineItemId"];
                $prepared->execute(array(':lineItemId' => $lineItemId));
            break;
        }
    }
?>