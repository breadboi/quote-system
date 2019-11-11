
<link rel="stylesheet" href="karaoke.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<?php
    function tableHead($rows)
    {
        echo "<table class=\"table table-dark table-bordered table-sm datatbl\">
                <thead>";
        foreach($rows as $x)
        {
            echo "<tr class=\"cellfill\">";
            foreach($x as $k => $y)
            {
                echo "<th>" . ucfirst($k) . "</th>";   // ucfirst($k) to capitilize the first char
            }
            echo "</tr>";
            break;
        }
        echo "</thead>";
    }

    function tableBody($rows)
    {
        echo "<tbody>";
        foreach($rows as $x)
        {
            echo "<tr>";
            foreach($x as $y)
            {
                echo "<td>" . $y . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
    }
?>