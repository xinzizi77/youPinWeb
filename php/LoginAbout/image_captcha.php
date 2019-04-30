<?php

require_once("../SqlAbout/sqlfunction.php");
/**
 * 字母+数字的验证码生成
 */
// 开启session
// session_start();
//4.1 定义验证码的内容
$content = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
    $captcha .= $fontcontent;
}
// echo $captcha;
$_SESSION["captcha"] = $captcha;
// echo $_SESSION['captcha'];
?>