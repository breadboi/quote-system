<html>

<head>
    <link rel="stylesheet" href="tracking.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/tracking.js"></script>
    <?php
    require_once('../../resources/library/tableformat.php');
    require_once('../../resources/library/legacy.php');
    //require_once('../../resources/library/azure.php');
    ?>
</head>

<body>
    <?php
    $id = $name = $city = $street = $contact = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["id"]);
        if (!is_numeric($id)) $id=0;
        $sql = "SELECT * FROM customers WHERE Id=$id";
        $customer = $legacyPDO->query($sql);
        $info = $customer->fetchAll(PDO::FETCH_ASSOC);
        //tableBody($info);
        $name = $info[0]["name"];
        $city = $info[0]["city"];
        $street = $info[0]["street"];
        $contact = $info[0]["contact"];
    }
    ?>

    <h1>Quote Tracking</h1>

    <a href="CustomerList.php" target="_self">Show Customer Information</a>

    <form action="confirm.php" method="post">
        <fieldset>
            <legend>Create New Quote</legend>
            <h3>Customer Information:</h3><br>
            <div>
                <label for="name">Customer Name</label>
                <input readonly=true class="lineitem" type="text" value="<? echo $name ?>" name="name" placeholder="Customer Name"><br>
                <label for="city">City</label>
                <input readonly=true class="lineitem" type="text" value="<? echo $city ?>" name="city" placeholder="City"><br>
                <label for="street">Street</label>
                <input readonly=true class="lineitem" type="text" value="<? echo $street ?>" name="street" placeholder="Street"><br>
                <label for="contact">Contact</label>
                <input readonly=true class="lineitem" type="text" value="<? echo $contact ?>" name="contact" placeholder="Contact"><br>
            </div>
            <div class="container1">
                <button class="add_form_field">Add New Field+</button>
                <div>
                    <input class="lineitem" placeholder="Line Item" type="text" name="lineitem[]">
                    <input class="price" placeholder="Price" type="text" name="price[]" />
                </div>
            </div>

            <textarea name="message" placeholder="Secret Notes" rows="5" cols="60"></textarea><br>
            <input class="submit" type="submit" value="Submit">


        </fieldset>
    </form>

    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

</body>

</html>