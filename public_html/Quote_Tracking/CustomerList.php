<html>

<head>
    <link rel="stylesheet" href="tracking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    require_once('../../resources/library/legacy.php');
    require_once('../../resources/library/tableformat.php');
    require_once('../../resources/library/bootstrap.php');
    ?>

</head>

<body>
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-dark text-white rounded">
        <h1>Customer Information List</h1>
        <p>Select a Customer to use for Quote</p>
    </div>

    <div class="p-1 btn-group d-flex">
        <a href="tracking.php" class="btn btn-danger" role="button" target="_self">Back To Quote Without Selection</a>
    </div>

    <form action="tracking.php" class="m-2 p-2" method="post">
        <div class="form-row input-group">
            <input type="text" class="form-control" name="id" placeholder="Customer ID to Use for Quote:">
            <input class="btn btn-success" type="submit">
        </div>
    </form>

    <form action="CustomerList.php" class=" m-2 p-2" method="post">
        <div class="form-row input-group">
             <input type="text" class="form-control" placeholder="Search Customers" name="search">
            <button class="btn btn-primary" type="submit" class="">Search</button>
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
    echo '<div class="m-2 p-2">', tableHead($rows), tableBody($rows), "</div>";
    ?> 

</body>

</html>