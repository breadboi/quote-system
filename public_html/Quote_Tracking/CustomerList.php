<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    require_once('../../resources/library/legacy.php');
    require_once('../../resources/library/tableformat.php');
    require_once('../../resources/library/bootstrap.php');
    ?>

</head>

<body>
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Customer Information List</h1>
        <p>Select a Customer to use for Quote</p>
    </div>

    <div class="p-1 btn-group d-flex">
        <a href="tracking.php" class="btn btn-danger" role="button" target="_self">Back To Quote Without Selection</a>
    </div>

    <form action="tracking.php" class="m-2 p-2" method="post">
        <div class="form-row input-group">
            <input onkeydown="event.preventDefault()" type="text" class="form-control" id="selectCust" name="selectCust" required placeholder="Click On Table To Select Customer">
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
        $customerSearch = $legacyPDO->prepare(
        "SELECT name, contact FROM customers 
        WHERE (name LIKE CONCAT('%', :string, '%'))
        OR (id LIKE CONCAT('%', :string, '%'))
        OR (city LIKE CONCAT('%', :string, '%'))
        OR (street LIKE CONCAT('%', :string, '%'))
        OR (contact LIKE CONCAT('%', :string, '%'))"
        );
        $customerSearch->execute(array(':string' => $searchString));
    } 
    else 
    {
        $customerSearch = $legacyPDO->prepare("SELECT name, contact FROM customers");
        $customerSearch->execute();
    }
    $rows = $customerSearch->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="row m-2 p-2">', tableHead($rows), tableBody($rows), "</div>";
    ?>

</body>

<script>
    var previousrow;
    function addRowHandlers() 
    {
        var table = document.getElementsByClassName("datatbl");
        var rows = table[0].getElementsByTagName("tr");
        for (i = 0; i < rows.length; i++) 
        {
            var currentRow = table[0].rows[i];
            var createClickHandler =
                function(row)
                {
                    return function() 
                    {
                        if(previousrow != undefined)
                        {
                            previousrow.setAttribute("style", "");
                        }
                        var cell = row.getElementsByTagName("td")[0];
                        var selection = cell.innerHTML;
                        document.getElementById("selectCust").setAttribute("value", selection);
                        this.setAttribute("style", "background-color: #e8e8e8; color: #000000 ");
                        previousrow = row;
                    };
                };
            currentRow.onclick = createClickHandler(currentRow);
        }
    }
    window.onload = addRowHandlers();

    
</script>

</html>