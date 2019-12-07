<!-- Import library recourses  -->
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/resources/library/loginSession.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/resources/library/bootstrap.php');
?>
<html>

<!-- Title of project function -->
<head>
    <title>In House Interface</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- MDBootstrap Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<!-- CSS for daterangepicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Styling for this page -->
<link rel="stylesheet" href="css/inhouse.css">

<body>
    <!-- Return To Index Page -->
    <div class="p-1 btn-group">
        <a href="../index.php" class="btn btn-dark" role="button">Back To Home Page</a>
    </div>

    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote Sanction System</h1>
        <h5>Manage Line Items, Quote Notes, and Sanction Quotes</h5>
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
<script type="text/javascript" src="javascript/inhouse.js"></script>

</html>