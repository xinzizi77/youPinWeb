<?php
require_once("../SqlAbout/function.php");
//验证码的判断
$captcha = $_POST["captcha"];
if (strtolower($_SESSION["captcha"]) == strtolower($captcha)) {
    echo 'true';
    $_SESSION["captcha"] = "";
} else {
    echo 'false';
}