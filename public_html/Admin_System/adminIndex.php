<html>

<head>
    <title>Karaoke</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- MDBootstrap Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

<!-- Styling for this page -->
<link rel="stylesheet" href="css/admin.css">

<body>
    <?php
include('sql.php');
include('djsql.php');
    
    $sql="SELECT CustomerID, SongName, FileName, CustomerName, Time FROM Customer
            JOIN KaraokeFile ON KaraokeFile.KaraokeFileID = Customer.KaraokeFileID
            JOIN Song ON Song.SongID = KaraokeFile.SongID
            WHERE Paid = 0
            AND Played = 0";
    $sql2="SELECT CustomerID, SongName, FileName, CustomerName, Time, Amount FROM Customer
            JOIN KaraokeFile ON KaraokeFile.KaraokeFileID = Customer.KaraokeFileID
            JOIN Song ON Song.SongID = KaraokeFile.SongID
            WHERE Paid = 1
            AND Played = 0";
    $rs = $pdo->query($sql);
    $rs2 = $pdo->query($sql2);
    $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
    $rows2 = $rs2->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", djtableHead($rows, "Free Queue"), djtableBody($rows), "</div>";
    echo "<div>", djtableHead($rows2, "Paid Queue"), djtableBody($rows2), "</div>";
    // Update the played flag based on selected queue item
    if (isset($_POST["played"]) && $_POST["played"] != "")
    {
        $songToRemove = $_POST["played"];
        $sql="UPDATE Customer
                SET Played = 1
                WHERE CustomerID = \"$songToRemove\"";
        $rows3 = $pdo->query($sql);
        echo "<meta http-equiv='refresh' content='0'>";
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

<!-- Javascript for this page -->
<script type="text/javascript" src="javascript/admin.js"></script>

</html>