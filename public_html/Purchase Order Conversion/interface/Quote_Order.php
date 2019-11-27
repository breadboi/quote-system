<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Customer Information List</h1>
        <p>Select a Customer to use for Quote</p>
    </div>

    
    <?php
    //require_once("../../../resources/config.php");
    require_once('../../../resources/library/tableformat.php');
    require_once('../../../resources/library/bootstrap.php');
    include("../../../resources/library/devDatabase.php");

    $sql = "SELECT * FROM quotes";
    $AllQuotes = $devPdo->query($sql);
    $rows = $AllQuotes->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";
    ?>

</body>

<script>
    var previousrow;

    function addRowHandlers() {
        var table = document.getElementsByClassName("datatbl");
        var rows = table[0].getElementsByTagName("tr");
        for (i = 0; i < rows.length; i++) {
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
                        var id = cell.innerHTML;
                        document.getElementById("id").setAttribute("value", id);
                        this.setAttribute("style", "background-color: #4CAF50");
                        previousrow = row;
                    };
                };

            currentRow.onclick = createClickHandler(currentRow);
        }
    }
    window.onload = addRowHandlers();
</script>

</html>



   
   
