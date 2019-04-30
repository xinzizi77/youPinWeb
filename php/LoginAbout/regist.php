<?php
//注册的php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");
require_once("image_captcha.php");

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$pw_check = $_POST['pw_check'];
$password = md5($password);
$pw_check = md5($pw_check);


if (empty($email)) {
    echo "邮箱不得为空";
} else {
    selectin("email", "user_table", "email='{$email}'", "findOne");

    if (isset($row)) {
        echo "邮箱已经存在";//提示邮箱已经存在，跳转到登陆界面
    } else {
        $findme = '@';
        $findme_a = '.com';
        $findme_b = '.cn';
        $pos = strpos($email, $findme);
        $pos_a = strpos($email, $findme_a);
        $pos_b = strpos($email, $findme_b);
            //邮箱格式的判断
        if ($pos === false and ($pos_a || $pos_b === false)) {
            echo "邮箱格式不正确";
        } else if (strlen($username) > 32) {
            echo "用户名不得大于16个字";
        } else if (strlen($password) < 6) {
            echo "密码不得小于6位";
        } else if (strlen($password) > 32) {
            echo "密码不得大于32位";
        } else if ($password !== $pw_check) {
            echo "密码和确认密码不一致";
        } else {
            upload("user_table", "email,p_id,username,password", "'{$email}','0_version_pictures.jpg','{$username}','{$password}'");
            echo "true";//提示用户注册成功                

            $_SESSION['emailLogin'] = $email;
        }
    }
}
?>