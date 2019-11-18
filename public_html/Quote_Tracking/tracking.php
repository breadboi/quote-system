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
    if( $_POST["id"] != "")
    {
        $id = test_input($_POST["id"]);
        if (!is_numeric($id)) $id = 1;
        $sql = "SELECT * FROM customers WHERE Id=$id";
        $customer = $legacyPDO->query($sql);
        $info = $customer->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($info))
        {
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
    <div class="jumbotron">
        <h1>Quote Tracking</h1>
        <p>Create a new Quote for your Customer</p>
    </div>

    <a href="CustomerList.php" class="btn btn-info" role="button" target="_self">Select Customer Info For Quote</a>

    <form action="confirm.php" method="post">
        <fieldset>
            <legend>Create New Quote</legend>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="name">Customer Name</label>
                        <input readonly=true class="form-control" type="text" value="<?php echo $name ?>" name="name" placeholder="Customer Name"><br>
                    </div>
                    <div class="col">
                        <label for="contact">Contact</label>
                        <input readonly=true class="form-control" type="text" value="<?php echo $contact ?>" name="contact" placeholder="Contact"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="street">Street</label>
                        <input readonly=true class="form-control" type="text" value="<?php echo $street ?>" name="street" placeholder="Street"><br>
                    </div>
                    <div class="col">
                        <label for="city">City</label>
                        <input readonly=true class="form-control" type="text" value="<?php echo $city ?>" name="city" placeholder="City"><br>
                    </div>
                </div>
            </div>

            <div class="freeform">
                <button type="button" id="addField" class="btn btn-info">Add New Field+</button>
            </div>

            <textarea name="message" class="form-control" placeholder="Secret Notes" rows="5"></textarea><br>
            <input class="btn btn-success" type="submit" value="Submit">


        </fieldset>
    </form>
</body>

<script type="text/javascript" src="javascript/tracking.js"></script>

</html>