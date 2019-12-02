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

    <!-- Search Form -->
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
            <input id="finalizedStatus" type="checkbox" value="0" name="finalizedStatus" />
            <label for="finalizedStatus">Finalized</label>
            <br>
            <input id="sanctionedStatus" type="checkbox" value="1" name="sanctionedStatus" />
            <label for="sanctionedStatus">Sanctioned</label>
            <br>
            <input id="orderedStatus" type="checkbox" value="2" name="orderedStatus" />
            <label for="orderedStatus">Ordered</label>
            <br>
        </div>

        <!-- Date range Selector -->
        <div class="form-group quoteFormItems hiddenControl">
            <input type="text" name="daterange" id="daterange">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
            </input>
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