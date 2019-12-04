<!-- <html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> -->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Conversion Interface</h1>
        <p>Select a Quote to Convert</p>
    </div>


    
    <?php
    //require_once("../../../resources/config.php");
    require_once('../../../resources/library/tableformat.php');
    require_once('../../../resources/library/bootstrap.php');
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
        $calculatedAmount = $rows["Total Price"];
    }

    $sql = "SELECT * FROM quotes
            WHERE status != 3;";
    $AllQuotes = $devPdo->query($sql);
    $rows = $AllQuotes->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";

    ?>

<!-- </body> -->

<!-- </html> -->
