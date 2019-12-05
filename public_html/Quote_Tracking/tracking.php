<?php
require_once(__DIR__.'/../../resources/library/loginSession.php');
require_once(__DIR__.'/../../resources/library/bootstrap.php');
require_once(__DIR__.'/../../resources/library/tableformat.php');
require_once(__DIR__.'/../../resources/library/legacy.php');
require_once(__DIR__.'/../../resources/library/devDatabase.php');
?>

<!DOCTYPE html>
<html>
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
//Variables For Customer Information
$id = $name = $city = $street = $contact = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if ($_POST["selectCust"] != "") 
    {
        $customerSelection = test_input($_POST["selectCust"]);
        //MySQL Query for retrieving customer data from database
        $sql = "SELECT * FROM customers WHERE name='$customerSelection'";
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
    <!-- Style Sheets For Bootstrap Formating -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Quote Submition</title>
</head>

<body>
    <!-- Return To Index Page -->
    <div class="p-1 btn-group">
        <a href="../index.php" class="btn btn-dark" role="button">Back To Home Page</a>
     </div>
    <!-- Title Of Page -->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote Tracking</h1>
        <h5>Create a new Quote for your Customer</h5>
    </div>

    <!-- Button To Select Customer Information -->
    <div id="CustomerSelection">
        <div class="p-1 btn-group d-flex">
            <a href="CustomerList.php" class="btn btn-primary" role="button" id="CustomerSelect" target="_self">Select Customer Info For Quote</a>
        </div>
    </div>

    <!-- Quote Creation form containing all componenets of the quote -->
    <form id="QuoteForm" action="confirm.php" class="border border-primary rounded mx-1 px-2" method="post">
        <fieldset>
            <h4 class=".bg-info">Create New Quote</h4>
            <!-- Customer Information form group, All data is imported from MySQL -->
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="name">Customer Name</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $name ?>" name="name" id="name" placeholder="Customer Name" required><br>
                    </div>
                    <div class="col">
                        <label for="contact">Contact</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $contact ?>" name="contact" id="contact" placeholder="Contact"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="street">Street</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $street ?>" name="street" id="street" placeholder="Street"><br>
                    </div>
                    <div class="col">
                        <label for="city">City</label>
                        <input onkeydown="event.preventDefault()" class="form-control" type="text" value="<?php echo $city ?>" name="city" id="city" placeholder="City"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input required class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                </div>
            </div>

            <!-- Contains all Line Items for the Quote -->
            <div id="QuoteContent">
                <div class="btn-group d-flex">
                    <button type="button" id="addField" class="btn btn-primary m-1">Add New Field+</button>
                </div>
            </div>

            <!-- Contains any secret Notes for the Quote -->
            <textarea name="message" class="form-control mt-2" placeholder="Secret Notes" rows="5"></textarea><br>
            <div class="btn-group d-flex">
                <button class="btn btn-success m-1" type="submit">Submit Quote</button>
            </div>

        </fieldset>
    </form>
    <!-- Scripts used for the addition of line items -->
    <script type="text/javascript" src="javascript/tracking.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
</body>
</html>
