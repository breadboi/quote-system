<?php
require_once(__DIR__ . '/../../resources/library/loginSession.php');
require_once(__DIR__ . '/../../resources/library/bootstrap.php');

// Ensure user is logged in as admin
if ($_SESSION['admin'] == false) 
{
    header("Location: ../index.php");
}
?>
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
    <!-- Return To Index Page -->
    <div class="p-1 btn-group">
        <a href="../index.php" class="btn btn-dark" role="button">Back To Home Page</a>
    </div>

    <!-- Banner for top of page -->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Admin Interface</h1>
        <h5>Manage Sales Associates and View Quotes/Line Items</h5>
    </div>

    <!-- Search Form -->
    <div class="container">
        <form method="POST" class="form border border-primary rounded col-md-12 col-lg-12" name="adminsearch">

            <!-- Search Type -->
            <div class="form-group">                
                <label><input id="salesassociate" type="radio" value="0" name="searchChoice" checked>Sales Associate</label>
                
                <label><input id="quote" type="radio" value="1" name="searchChoice">Quote</label>

                <!-- Sales Associate Search Field -->
                <input type="text" class="form-control" name="salesAssociateName" placeholder="Sales Associate Name">
                <br>
                <!-- Displayed when quote radio is selected -->
                <input type="text" class="form-control quoteFormItems hiddenControl" name="customerName" placeholder="Customer Name">
            </div>

            <!-- Quote Search Checkboxes (Display when quote radio is selected) -->
            <div class="form-group quoteFormItems hiddenControl">
                <input id="unresolvedStatus" type="checkbox" value="0" name="unresolvedStatus" />
                <label for="unresolvedStatus">Unresolved</label>
                <input id="finalizedStatus" type="checkbox" value="1" name="finalizedStatus" />
                <label for="finalizedStatus">Finalized</label>
            </div>

            <!-- Quote Search Checkboxes (Display when quote radio is selected) -->
            <div class="form-group quoteFormItems hiddenControl">
                <input id="sanctionedStatus" type="checkbox" value="2" name="sanctionedStatus" />
                <label for="sanctionedStatus">Sanctioned</label>
                <input id="orderedStatus" type="checkbox" value="3" name="orderedStatus" />
                <label for="orderedStatus">Ordered</label>
            </div>

            <!-- Date range Selector -->
            <div class="form-group quoteFormItems hiddenControl">
                <input type="text" name="daterange" id="daterange">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
                </input>
            </div>

            <!-- Submit -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>

        </form>
    </div>
    <!-- Table Loader -->
    <?php
        require_once("views/tableLoader.php");
        require_once("views/modalForm.html");
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
