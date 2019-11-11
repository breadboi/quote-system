<html>

<head>
    <link rel="stylesheet" href="tracking.css">
    <?php
    require_once('../../resources/library/legacy.php');
    require_once('../../resources/library/tableformat.php');
    ?>
</head>

<body>
    <div>
        <h1>Customer Information List</h1>
        <a href="tracking.php" target="_self">Back To Quote Without Selection</a>
        <form action="tracking.php" method="post">
        Select Customer ID for Quote: <input type="text" name="id">
        <input type="submit">
        </form>
    </div>

    <form action="CustomerList.php" method="post">
        Search: <input type="text" name="search">
        <input type="submit">
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