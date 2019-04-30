<?php
require_once("../SqlAbout/sqlfunction.php");
require_once("../SqlAbout/sqlfunction_58city.php");

session_unset(); // 清空session变量

if (isset($_COOKIE[session_name()])) {
	setCookie(session_name(), '', time() - 3600, '/');
}

session_destroy(); // 销毁一个会话中的全部数据

echo "退出成功";// 退出后跳到主页面
?>