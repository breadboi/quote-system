<html>

<head>
    <link rel="stylesheet" href="tracking.css">
    <?php
    require_once('../../resources/library/legacy.php');
    require_once('../../resources/library/tableformat.php');
    require_once('../../resources/library/bootstrap.php');
    ?>
</head>

<body>
    <div class="jumbotron">
        <h1>Customer Information List</h1>
        <p>Select a Customer to use for Quote</p>
    </div>

    <a href="tracking.php" class="btn btn-danger" role="button" target="_self">Back To Quote Without Selection</a>
    
    <form class="form-inline" action="tracking.php" method="post">
        <div class="form-group">
            <label for="text">Customer ID to Use for Quote:</label>
            <input type="text" class="form-control" name="id">
            <input class="btn btn-success" type="submit">
        </div>
    </form>

    <form class="form-inline" action="CustomerList.php" method="post">
        <div class="form-group">
            <label for="text">Search for Customer:</label>
            <input type="text" class="form-control" name="search">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <?php
    if (isset($_POST["search"]))
    {
        $searchString = $_POST["search"];
        $sql = "SELECT * FROM customers 
        WHERE (name LIKE '%$searchString%')
        OR (id LIKE '%$searchString%')
        OR (city LIKE '%$searchString%')
        OR (street LIKE '%$searchString%')
        OR (contact LIKE '%$searchString%')
        ";
    }
    else
    {
    $sql = "SELECT * FROM customers";
    }
    $AllCustomers = $legacyPDO->query($sql);
    $rows = $AllCustomers->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";
    ?>

</body>

</html>