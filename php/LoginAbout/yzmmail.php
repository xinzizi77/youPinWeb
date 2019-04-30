<?php
require_once("../PhpMailer/class.phpmailer.php");
require_once("../PhpMailer/class.smtp.php");
require_once("image_captcha.php");
//点击获取验证码以后请求这个文件

// global $captcha;
// echo $captcha;die;
// echo $_SESSION['emailLogin'];die;
if (isset($captcha) && $captcha !== '') {
    // 实例化PHPMailer核心类
    $mail = new PHPMailer();
    // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;
    // 使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    // smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    // 链接qq域名邮箱的服务器地址
    // $mail->Host = 'smtp.163.com';
    $mail->Host = 'smtp.qq.com';    
    // $mail->Port = '25';
    // $mail->SMTPDebug = 0;//关闭SMTP调试服务  
    // 设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    // 设置ssl连接smtp服务器的远程服务器端口号
    $mail->Port = 465;
    // 设置发送的邮件的编码
    $mail->CharSet = 'UTF-8';
    // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '优聘网';
    // smtp登录的账号 QQ邮箱即可
    // $mail->Username = 'kermisweet@163.com';
    $mail->Username = '2775420550@qq.com';    
    // smtp登录的密码 使用生成的授权码
    // $mail->Password = 'theFirst01';
    $mail->Password = 'dmfzvlsdonrvdeea';    
    // 设置发件人邮箱地址 同登录账号
    // $mail->From = 'kermisweet@163.com';
    $mail->From = '2775420550@qq.com';    
    // 邮件正文是否为html编码 注意此处是一个方法
    $mail->isHTML(true);
    // 设置收件人邮箱地址
    $mail->addAddress($_POST['email']);//注册的时候要把邮箱框中的email地址post过来
    // $mail->addAddress("870534924@qq.com");   
    // 添加多个收件人 则多次调用方法即可
    // $mail->addAddress('87654321@163.com');
    // 添加该邮件的主题
    // $mail->Subject = '{$json}';
    $mail->Subject = '优聘网验证码';
    // 添加邮件正文
    // $body = '<h1>Hello World</h1>asdasdasdsadsdsad';
    $mail->IsHTML(true);
    $mail->Body = "<h1>你收到了优聘网的验证码</h1><br>
    <p>你的验证码为:</p>
    <h1 style='color:#019793;font-size: 35px;'>" . $captcha . "</h1>
    <br><footer style='float:left'> ---优聘网</footer>";
    // 为该邮件添加附件
    // $mail->MsgHTML($body);
    // $mail->addAttachment('./example.pdf');
    // 发送邮件 返回状态
    $status = $mail->send();
    if (isset($status)) {
        echo "发送成功";
    } else {
        echo "发送失败";
    }
}
?>