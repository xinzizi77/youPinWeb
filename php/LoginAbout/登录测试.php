<?php
    require "../SqlAbout/function.php";
    session_start();
    // skip("hello");
    // die;
    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pw_check = $_POST['pw_check'];
        $_SESSION['email'] = $email;

        $username_n = $username;
        $findMail = "@";
        $findMail_1 = ".com";
        $findMail_2 = ".cn";
        $pos = strpos($username_n, $findMail);
        $pos_a = strpos($username_n, $findMail_1);
        $pos_b =strpos($username_n, $findMail_2);
        if(empty($username)){
            skip("用户名不能为空",'login1.php');
        }

        // $query = "SELECT username FROM username WHERE username='$username'";
        // $result = mysqlExecute($conn,$query);
        // $row = mysqli_fetch_assoc($reuslt);
        // if(isset($row)){
        //     skip("该用户名已被注册", 'login1.php');
        // }
        if(empty($email)){
            skip("邮箱不得为空",'login1.php');
        }
        if($pos === false and ($pos_a || $pos_b === false)){
            skip("邮箱格式不正确，请输入正确的邮箱格式", "login1.php");
        }
        if(empty($password) and empty($pw_check)){
            skip("密码不得为空",'login1.php');
        }
        if(strlen($password) < 6){
            skip("密码必须大于6位",'login1.php');
        }
        if(strlen($password) > 32){
            skip("密码不得大于32位",'login1.php');
        }
        if($password !== $pw_check){
            skip("确认密码和密码不一致，请重新输入",'login1.php');
        }
    }

    // session_destroy();
?>

<html>
    <body>
        <form method="post">
            <input type="text" name="username" placeholder="用户名" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>">
            <input type="text" name="email" placeholder="邮箱" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>">
            <input type="password" name="password" placeholder="密码" >
            <input type="password" name="pw_check" placeholder="密码验证">
            <input type="submit" name="submit">
        </form>
    </body>
</html>

