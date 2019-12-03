<!-- <html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body> -->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Conversion Interface</h1>
        <p>Select a Quote to Convert</p>
    </div>


    
    <?php
    //require_once("../../../resources/config.php");
    require_once('../../../resources/library/tableformat.php');
    require_once('../../../resources/library/bootstrap.php');
    require_once("../../../resources/library/devDatabase.php");

    if (isset($_POST['discount'])) 
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $discount = $_POST['discount'];
        //$message = strip_tags($_POST['message']);

        $sql = "UPDATE quotes
                SET status=:status, discount=:discount
                WHERE id=:id;";

        // Prepare pdo
        $prepared = $devPdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $success = $prepared->execute(array(':id' => $id,
                                            ':status' => $status,
                                            ':discount' => $discount));
    }

    $sql = "SELECT * FROM quotes";
    $AllQuotes = $devPdo->query($sql);
    $rows = $AllQuotes->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>", tableHead($rows), tableBody($rows), "</div>";

    ?>

<!-- </body> -->

<!-- JavaScript For Selection of Customer Name -->
<script>
    var previousrow;
    function addRowHandlers() {
        var table = document.getElementsByClassName("datatbl");
        var rows = table[0].getElementsByTagName("tr");
        for (i = 0; i < rows.length; i++) {
            var currentRow = table[0].rows[i];
            var createClickHandler =
                function(row) {
                    return function() {
                        if (previousrow != undefined) {
                            previousrow.setAttribute("style", "");
                        }
                        var cell = row.getElementsByTagName("td")[0];
                        var selection = cell.innerHTML;
                        var selection = row.getElementsByTagName("td")[0].innerHTML
                        document.getElementById("quoteId").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[1].innerHTML
                        document.getElementById("quoteCustomername").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[2].innerHTML
                        document.getElementById("quoteContact").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[3].innerHTML
                        document.getElementById("quoteStreet").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[4].innerHTML
                        document.getElementById("quoteCity").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[5].innerHTML
                        document.getElementById("quoteEmail").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[6].innerHTML
                        document.getElementById("quoteSecretnotes").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[7].innerHTML
                        document.getElementById("quoteStatus").setAttribute("value", selection);
                        var selection = row.getElementsByTagName("td")[8].innerHTML
                        document.getElementById("quoteDiscount").setAttribute("value", selection);
                        this.setAttribute("style", "background-color: #e8e8e8; color: #000000 ");
                        previousrow = row;
                    };
                };
            currentRow.onclick = createClickHandler(currentRow);
        }
    }
    window.onload = addRowHandlers();
</script>

<!-- </html> -->
