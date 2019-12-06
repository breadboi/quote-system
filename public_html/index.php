<html>
    <?php
    require_once('../resources/library/bootstrap.php');
    require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/library/devDatabase.php");
    require_once('../resources/library/tableformat.php');
    session_start();
    //Show if user is logged in or not
    if ( isset( $_SESSION['user_id'] ) ) 
    {
        $loggedIn = '<p style="text-align:center" class="bg-success text-white">Logged In As: ' . $_SESSION["user_id"];
        if($_SESSION['admin'] == true)
        {
            $loggedIn = $loggedIn . ' - Admin' . '</p>';
        }
        else
        {
            $loggedIn = $loggedIn . ' - Standard User' . '</p>';
        }
        echo $loggedIn;
    }
    else 
    {
        $loggedOut = '<p style="text-align:center" class="bg-danger text-white">Please Login To Access System</p>';
        echo $loggedOut;
    }
    ?>
    
<head>
    <title>Home Page</title>
</head>
<body>
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote System</h1>
        <h5>Please Select the Interface to Use</h5>
    </div>

    <nav class="navbar navbar-expand-sm bg-primary navbar-dark p-2 m-1 rounded">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="Admin_System/adminIndex.php">Admin Interface</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Quote_Tracking/tracking.php">Quote Tracking</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="In_House/inhouseindex.php">In House System</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Purchase_Order_Conversion/interface/conversionIndex.php">Purchase Order Conversion</a>
            </li>
        </ul>
    </nav>

    <div>
        <div class="p-1 m-1 btn-group d-flex">
            <a href="login.php" class="btn btn-primary" role="button" target="_self">Click Here To Login</a>
        </div>
        <div class="p-1 m-1 btn-group d-flex">
            <a href="logout.php" class="btn btn-danger" role="button" target="_self">Click Here To Logout</a>
        </div>
    </div>

</body>
</html>