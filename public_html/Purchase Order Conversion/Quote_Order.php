<HTML>

head>
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