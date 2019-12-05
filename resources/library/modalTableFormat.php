<?php
    /**
     * Function used for modal tables dynamically generated
     * through ajax, so that on click events can be registered
     */
    function modalTableHead($rows)
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
    
    /**
     * Function used for modal tables dynamically generated
     * through ajax, so that on click events can be registered
     */
    function modalTableBody($rows)
    {
        echo "<tbody>";
        foreach($rows as $x)
        {
            echo "<tr>";
            foreach($x as $y)
            {
                echo "<td onclick=\"highlightModalRow(this);\">" . $y . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
    }
?>