<?php
// header('Content-type:text/json');
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

    // echo $_SESSION['emailLogin']."<br>";
if (isset($_SESSION['emailLogin'])) {
        // echo $_SESSION['emailLogin'];
    selectin("username", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    echo $row['username'];
} else {
    echo "";
}
?>