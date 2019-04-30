<?php
    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");

    if(isset($_SESSION['emailLogin'])){
        $username   =    $_POST['username'];
        $sex    =    $_POST['sex'];
        $birth  =   $_POST['birth'];

        // $username = "admin";
        // $sex = '2';
        // $birth = "2000/01/01";

        update("user_table", "username='{$username}',sex={$sex},birth='{$birth}'", "email='{$_SESSION['emailLogin']}'");
        echo "success";
    }
?>