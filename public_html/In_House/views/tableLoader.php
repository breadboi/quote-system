<?php
    // Load config and functions
    require_once("../../resources/config.php");
    include("../../resources/library/devDatabase.php");
    require_once("../../resources/library/tableformat.php");

    //$searchChoice = $_POST["searchChoice"];                      

    $sql = "SELECT quotes.id as 'Quote ID', quotes.customer_name as 'Customer Name', sales_associates.name AS 'Associate Name', discount as Discount, quotes.secret_notes as 'Notes' FROM quotes
    INNER JOIN sales_associates ON sales_associates.id = quotes.sales_associate_id
    WHERE status=1";

    // Prepare pdo
    $query = $devPdo->query($sql);

    $lineItemNumber = $_POST["lineItemNumber"];
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    tableHead($rows);
    tableBody($rows);

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