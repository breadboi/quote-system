<?php
require_once('../../resources/library/bootstrap.php');
require_once('../../resources/library/tableformat.php');
require_once('../../resources/library/legacy.php');
require_once('../../resources/library/devDatabase.php');

echo '<a href="tracking.php" class="btn btn-info" target="_self">Back To Quote Creation</a><br/>';

$name = $_POST["name"];
$contact = $_POST["contact"];
$street = $_POST["street"];
$city = $_POST["city"];
$message = $_POST["message"];
$lineitem = $_POST["lineitem"];
$price = $_POST["price"];
$Line_Price = array_combine($lineitem, $price);

try 
{
    $sql = "INSERT INTO quotes (customer_name, contact, street, city, secret_notes, status, discount)
    VALUES ('$name', '$contact', '$street', '$city', '$message', '0', '0')";
    $devPdo->exec($sql);

    $last_id = $devPdo->lastInsertId();

    $LineNumber = 1;
    foreach ($Line_Price as $Line => $Price) 
    {
        $sql = "INSERT INTO line_item (line_number, description, price, quote_id)
                VALUES ($LineNumber, '$Line', $Price, $last_id)";
        $devPdo->exec($sql);
        $LineNumber++;
    }

    echo "<strong>New Quote created successfully #<strong>" . $last_id . "<br/>";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;


?>

<table>
<?php 
    foreach ($_POST as $key => $value) {
        if(is_array($value))
        {
            foreach ($value as $k)
            {
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $k;
                echo "</td>";
                echo "</tr>";
            }
        }
        else{
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
?>
</table>