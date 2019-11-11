<a href="tracking.php" target="_self">Back To Quote Creation</a>
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