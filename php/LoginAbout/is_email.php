<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

$email = $_POST['email'];

selectin("email", "user_table", "email='{$email}'", "findOne");
if (isset($row)) {
    echo "true";//提示邮箱已经存在，跳转到登陆界面
} else {
    echo "false";
}
?>
