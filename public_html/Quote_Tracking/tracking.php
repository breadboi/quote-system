<html>
<?php
require_once('../../resources/library/bootstrap.php');
require_once('../../resources/library/tableformat.php');
require_once('../../resources/library/legacy.php');
require_once('../../resources/library/devDatabase.php');
?>

<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
$id = $name = $city = $street = $contact = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["id"] != "") {
        $id = test_input($_POST["id"]);
        if (!is_numeric($id)) $id = 1;
        $sql = "SELECT * FROM customers WHERE Id=$id";
        $customer = $legacyPDO->query($sql);
        $info = $customer->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($info)) {
            $name = $info[0]["name"];
            $city = $info[0]["city"];
            $street = $info[0]["street"];
            $contact = $info[0]["contact"];
        }
    }
}
?>

<head>
    <link rel="stylesheet" href="tracking.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote Tracking</h1>
        <p>Create a new Quote for your Customer</p>
    </div>

    <div id="CustomerSelection">
        <div class="p-1 btn-group d-flex">
            <a href="CustomerList.php" class="btn btn-primary" role="button" id="CustomerSelect" target="_self">Select Customer Info For Quote</a>
        </div>
    </div>
    <form action="confirm.php" class="needs-validation border border-primary rounded mx-1 px-2" method="post">
        <fieldset>
            <h4 class=".bg-info">Create New Quote</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="name">Customer Name</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $name ?>" name="name" id="name" placeholder="Customer Name" required><br>
                    </div>
                    <div class="col">
                        <label for="contact">Contact</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $contact ?>" name="contact" placeholder="Contact"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="street">Street</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $street ?>" name="street" placeholder="Street"><br>
                    </div>
                    <div class="col">
                        <label for="city">City</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $city ?>" name="city" placeholder="City"><br>
                    </div>
                </div>
            </div>

            <div id="QuoteContent">
                <div class="btn-group d-flex">
                    <button type="button" id="addField" class="btn btn-primary m-1">Add New Field+</button>
                </div>
            </div>

            <textarea name="message" class="form-control mt-2" placeholder="Secret Notes" rows="5"></textarea><br>
            <div class="btn-group d-flex">
                <input class="btn btn-success m-1" type="submit" id="QuoteSubmit" value="Submit">
            </div>

        </fieldset>
    </form>
</body>


<script type="text/javascript">
</script>

<script type="text/javascript" src="javascript/tracking.js"></script>

<script>
</script>

</html>