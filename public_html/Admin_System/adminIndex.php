<html>

<head>
    <title>Admin Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- MDBootstrap Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<!-- CSS for daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Styling for this page -->
<link rel="stylesheet" href="css/admin.css">

<body>

    <form method="POST" name="adminsearch">

        <!-- Search Type -->
        <div class="form-group">
            <input id="salesassociate" type="radio" value="0" name="searchChoice" checked>
            <label for="salesassociate">Sales Associate</label>
            <br>
            <input id="quote" type="radio" value="1" name="searchChoice">
            <label for="quote">Quote</label>
        </div>

        <!-- Quote Search Checkboxes (Display when quote radio is selected) -->
        <div class="form-group quoteFormItems hiddenControl">
            <input id="finalizedstatus" type="checkbox" value="0" name="quoteStatus" />
            <label for="finalizedstatus">Finalized</label>
            <br>
            <input id="sanctionedstatus" type="checkbox" value="1" name="quoteStatus" />
            <label for="sanctionedstatus">Sanctioned</label>
            <br>
            <input id="orderedstatus" type="checkbox" value="2" name="quoteStatus" />
            <label for="orderedstatus">Ordered</label>
            <br>
        </div>

        <!-- Date range Selector -->
        <div class="form-group quoteFormItems hiddenControl">
            <input type="text" name="daterange" />
        </div>

        <!-- Sales Associate Search Field -->
        <div class="form-group">
            <input type="text" class="form-control" name="salesAssociateName" placeholder="Sales Associate Name">

            <!-- Displayed when quote radio is selected -->
            <input type="text" class="form-control quoteFormItems hiddenControl" name="customerName"
                placeholder="Customer Name">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>


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

</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- CDN for Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!-- CDN for DataTables jQuery -->
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<!-- CDN for DataTables javascript -->
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<!-- CDN For moment javascript -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- CDN for daterangepicker javascript -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Javascript for the Forms -->
<script type="text/javascript" src="javascript/admin.js"></script>

</html>