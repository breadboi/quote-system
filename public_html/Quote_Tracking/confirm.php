<?php
require_once('../../resources/library/loginSession.php');
require_once('../../resources/library/bootstrap.php');
require_once('../../resources/library/tableformat.php');
require_once('../../resources/library/legacy.php');
require_once('../../resources/library/devDatabase.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quote Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- Title Screen for Page -->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote Submition</h1>
    </div>
    <!-- Return to Quote Creation Page -->
    <div class="p-1 btn-group d-flex">
        <a href="tracking.php" class="btn btn-success" target="_self">Back To Quote Creation</a>
    </div>

    <!-- Quote Validation -->
    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        return $data;
    }
    //Arrays of line items and prices
    $lineitem = $_POST["lineitem"];
    $price = $_POST["price"];

    //String Of Possible Error Messages
    $quotevalidation = "<br>";
    $valid = true;

    //Testing if Data is correct and not empty
    if (empty($_POST["name"])) {
        $quotevalidation = $quotevalidation . "Customer Name Information Required<br>";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
    }
    if (empty($_POST["contact"])) {
        $quotevalidation = $quotevalidation . "Customer Contact Information Required<br>";
        $valid = false;
    } else {
        $contact = test_input($_POST["contact"]);
    }
    if (empty($_POST["street"])) {
        $quotevalidation = $quotevalidation . "Customer Street Information Required<br>";
        $valid = false;
    } else {
        $street = test_input($_POST["street"]);
    }
    if (empty($_POST["city"])) {
        $quotevalidation = $quotevalidation . "Customer City Information Required<br>";
        $valid = false;
    } else {
        $city = test_input($_POST["city"]);
    }
    if (empty($_POST["email"])) {
        $quotevalidation = $quotevalidation . "Email is required<br>";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $quotevalidation = $quotevalidation . "Invalid email format<br>";
            $valid = false;
        }
    }
    if (empty($_POST["message"])) {
        $message = "";
    } 
    else 
    {
        $message = test_input($_POST["message"]);
    }

    $lineNumber = 1;
    foreach ($lineitem as $L) {
        if (empty($L)) {
            $quotevalidation = $quotevalidation . "Line Item #$lineNumber is Required.<br>";
            $valid = false;
        }
        $lineNumber++;
        $L = test_input($L);
    }

    $lineNumber = 1;
    foreach ($price as $P) {
        if (!preg_match("/^\d+\.?\d\d$/", $P) || empty($P)) {
            $quotevalidation = $quotevalidation . "Price on Line #$lineNumber is Invalid<br>";
            $valid = false;
        }
        $lineNumber++;
        $P = test_input($P);
    }
    //If all lines Are valid then combine Line and Price into associative array
    $Line_Price = array_combine($lineitem, $price);

    //Insert information into database
    if ($valid) 
    {
        try {
            $salesassociate = $_SESSION['user_id'];
            $SA = $devPdo->prepare("SELECT * FROM sales_associates WHERE name = :user");
            $SA->bindParam(':user', $salesassociate);
            $SA->execute();
            $found = $SA->fetch();

            $nullable = 0;

            $insertQuote = $devPdo->prepare("INSERT INTO quotes (customer_name, contact, street, city, email ,secret_notes, status, discount, date_created, sales_associate_id)
        VALUES (:name, :contact, :street, :city, :email, :message, :status, :discount, CURDATE(), :salesassociate)");
            $insertQuote->bindParam(':name', $name);
            $insertQuote->bindParam(':contact', $contact);
            $insertQuote->bindParam(':street', $street);
            $insertQuote->bindParam(':city', $city);
            $insertQuote->bindParam(':email', $email);
            $insertQuote->bindParam(':message', $message);
            $insertQuote->bindParam(':status', $nullable);
            $insertQuote->bindParam(':discount', $nullable);
            $insertQuote->bindParam(':salesassociate', $found[0]);
            $insertQuote->execute();

            $last_id = $devPdo->lastInsertId();

            //Insert Lines with prices into database
            $LineNumber = 1;
            foreach ($Line_Price as $Line => $Price) {
                $insertLine = $devPdo->prepare("INSERT INTO line_item (line_number, description, price, quote_id)
                    VALUES (:linenumber, :line, :price, :id)");
                $insertLine->bindParam(':linenumber', $LineNumber);
                $insertLine->bindParam(':line', $Line);
                $insertLine->bindParam(':price', $Price);
                $insertLine->bindParam(':id', $last_id);
                $insertLine->execute();
                $LineNumber++;
            }
            echo '<div style="text-align:center" class="alert alert-success">';
            echo '<strong>Success!</strong> New Quote Created #' . $last_id;
            echo '</div>';
        } catch (PDOException $e) {
            echo '<div style="text-align:center" class="alert alert-danger">';
            echo "MYSQL Error:<br>" . $e->getMessage();
            echo '</div>';
        }
        $conn = null;
    } else {
        echo '<div style="text-align:center" class="alert alert-danger">';
        echo '<strong>Quote Creation Was Unsuccessful. Read Issues Bellow: </strong>' . $quotevalidation;
        echo '</div>';
    }
    ?>


<!-- Testing For Data Insertion -->
    <table class="table col-4">
        <?php
        /*
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $k) {
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $k;
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>";
            echo $key;
            echo "</td>";
            echo "<td>";
            echo $value;
            echo "</td>";
            echo "</tr>";
        }
    }
    */
        ?>
    </table>

</body>

</html>