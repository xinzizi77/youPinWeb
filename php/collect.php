<?php
require_once("SqlAbout/sqlfunction.php");
//收藏功能的实现

// $_SESSION['emailLogin'] = "admin@admin.com";
// $_GET['l_id'] = 3;
if(isset($_SESSION['emailLogin'])){
    //判断用户是否登陆
    if(isset($_GET['l_id'])){
        //判断是否穿了get变量过来
        selectin("love_id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        // var_dump($row);
        // die;
        if(isset($row) and $row['love_id'] !== ''){
            // echo 1;die;
            $var = $row['love_id'];
            $liked = explode("|",$var);
            //将字符串转换成数组
            for($i=0;$i<count($liked);$i++){
                // echo $liked[$i];
                if($liked[$i] == $_GET['l_id']){
                    unset($liked[$i]);
                    $liked = array_values($liked);
                    //如果被收藏了，取消收藏
                    // var_dump($liked);
                    // echo count($liked);
                    $liked_a = '';
                        for($a=0;$a<count($liked);$a++){
                            if($liked[$a] == ''){break;}
                            $liked_a = $liked_a.$liked[$a].'|';
                        }
                        if(strlen($liked_a) !== 0){
                            $liked_a = substr($liked_a,0,strlen($liked_a)-1);
                        }
                        
                    update("user_table", "love_id = '{$liked_a}'", "email='{$_SESSION['emailLogin']}'");      
                    echo "del success";            
                    // die;
                    // echo "isset";
                    return;
                    //已经被收藏了  收藏按钮常亮  停止执行函数
                }
            }
            $var = $var."|".$_GET['l_id'];
            // echo $var;
            update("user_table", "love_id = '{$var}'", "email='{$_SESSION['emailLogin']}'");
            // echo 2;
            // 添加收藏到数据库
            echo "up success";
        }else{
            //用户名并没有收藏任何招聘信息
            // echo "no_like";
            $var = $_GET['l_id'];
            update("user_table", "love_id = '{$var}'", "email='{$_SESSION['emailLogin']}'");
            echo "success";
        }
    }
    // var_dump($var);
}else{
    echo "warning";
    //用户并没有登陆
}
?>