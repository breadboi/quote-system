
    
<?php
    require_once('../../../resources/library/tableformat.php');
    require_once("../../../resources/library/devDatabase.php");

    if (isset($_POST['discount'])) 
    {
        $id = $_POST['id'];
        $discount = $_POST['discount'];
        
        // Set status
        $sql = "UPDATE quotes
                SET status=:status, discount=:discount
                WHERE id=:id;";

        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $success = $prepared->execute(array(':id' => $id,
                                            ':status' => 3,
                                            ':discount' => $discount));

        // Query for getting total price of all line items
        $calculatedQuery = "SELECT quotes.id AS 'Customer ID', sales_associate_id AS 'Associate ID', SUM(price) AS 'Total Price' FROM line_item
                            INNER JOIN quotes ON quotes.id = line_item.quote_id
                            WHERE quotes.id = $id";

        // Query the total amount
        $query = $devPdo->query($calculatedQuery);

        // Total amount of all line items
        $rows = $query->fetch(PDO::FETCH_ASSOC);
        $quoteId = $rows["Customer ID"];
        $customerId = $rows["Associate ID"];
        $calculatedAmount = round($rows["Total Price"], 2);

        $QuoteId = $_POST['id'];
        $url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
        $data = array(
	    'order' => $QuoteId, 
	    'associate' => $customerId,
	    'custid' => $QuoteId, 
	    'amount' => $calculatedAmount);
		
        $options = array(
         'http' => array (
         'header' => array('Content-type: application/json', 'Accept: application/json'),
         'method'  => 'POST',
         'content' => json_encode($data)
         )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

         // Set increment accumaleted by 1
         $sql3 = "UPDATE sales_associates
         SET accumulated_commission=accumulated_commission + 1
         WHERE id=:id;";

         // Prepare pdo
         $prepared1 = $devPdo->prepare($sql3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

         $success1 = $prepared1->execute(array(':id' => $customerId));    
    }

    $sql = "SELECT * FROM quotes
            WHERE status != 3;";
    $AllQuotes = $devPdo->query($sql);
    $rows = $AllQuotes->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";

?>