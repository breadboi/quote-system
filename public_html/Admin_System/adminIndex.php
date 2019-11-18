<html>

<head>
    <title>Admin Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- MDBootstrap Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<!-- Styling for this page -->
<link rel="stylesheet" href="css/admin.css">

<body>

    <form method="POST" name="adminsearch">

        <!-- Search Type -->
        <div class="form-group">
            <input id="salesassociate" type="radio" value="1" name="searchchoice" checked>
            <label for="salesassociate">Sales Associate</label>
            <br>
            <input id="quote" type="radio" value="2" name="searchchoice">
            <label for="quote">Quote</label>
        </div>
        
        <!-- Search Field -->
        <div class="form-group">
            <input type="text" class="form-control adminsearch" name="searchstring" placeholder="Search Here...">
        </div>        

        <button type="submit" class="btn btn-primary">Search</button>
    </form>


    <?php
        // Load config and functions
        require_once("../../resources/config.php");
        include("../../resources/library/devDatabase.php");
        require_once("../../resources/library/tableformat.php");
        
        if (isset($_POST["searchstring"]) && isset($_POST["searchchoice"]))
        {
            $searchString = $_POST["searchstring"];
            $searchChoice = $_POST["searchchoice"];

            switch($searchChoice)
            {
                case 1:
                    $sql = "SELECT id AS ID, name AS Name, accumulated_commission AS 'Total Commission', address AS Address FROM sales_associates
                            WHERE id LIKE CONCAT('%', :searchString, '%')
                            OR name LIKE CONCAT('%', :searchString, '%');";
                    break;
                case 2:
                    $sql = "SELECT 
                            WHERE SongName LIKE CONCAT('%', :searchString, '%');";
                    break;
            }

            $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $success = $prepared->execute(array(':searchString' => $searchString));

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
        }
    ?>

</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!-- CDN for DataTables jQuery -->
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<!-- CDN for DataTables javascript -->
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<!-- Javascript for the Forms -->
<script type="text/javascript" src="javascript/admin.js"></script>

</html>