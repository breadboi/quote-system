<!--
Group 5B
12/07/19
CSCI 467
Quote System

Purpose:
    This is the landing page for the system.
    This page has links for all the components of the system and
a login page for accessing the components.
    All components are locked untill the user enters in their passoword.
-->
<html>
    <?php
    /**
     * Requires all nessesary files for the page
     */
    require_once('../resources/library/bootstrap.php');
    require_once('../resources/library/devDatabase.php');
    require_once('../resources/library/tableformat.php');
    session_start();
    //Show if user is logged in or not
    if ( isset( $_SESSION['user_id'] ) ) 
    {
        /** Displays wether or not a user is logged in and if they are an admin */
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
        /**Message that the user is signed out of system. */
        $loggedOut = '<p style="text-align:center" class="bg-danger text-white">Please Login To Access System</p>';
        echo $loggedOut;
    }
    ?>
    
<head>
    <title>Home Page</title>
</head>
<body>
<!--Page Head Title-->
    <div style="text-align:center" class="jumbotron jumbotron-fluid p-2 m-1 bg-info text-white rounded">
        <h1>Quote System</h1>
        <h5>Please Select the Interface to Use</h5>
    </div>
    <!-- Navabar to select interface-->
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
    <!--Login and Logout Buttons-->
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
