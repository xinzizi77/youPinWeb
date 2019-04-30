<?php
require_once("SqlAbout/sqlfunction.php");

$_POST['feedback'] = "helloworld";
if (isset($_SESSION['emailLogin'])) {
    $email = $_SESSION['emailLogin'];
    // echo $email;/
    selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
    $u_id = $row['id'];
    // if (isset($_POST['submit'])) {
        $feedback = $_POST['feedback'];
        upload("feedback", "u_id,up_user,container" ,"'{$u_id}','{$email}','{$feedback}'");
        echo "ture";
    // }
}else{
        echo "login First";
    }