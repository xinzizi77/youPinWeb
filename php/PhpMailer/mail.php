    <?php
    require("class.phpmailer.php");
    function smtp_mail( $sendto_email, $subject, $body, $extra_hdrs, $user_name){
        $mail = new PHPMailer();
        $mail->IsSMTP();                  // send via SMTP
        $mail->Host = "smtp.qq.com";   // SMTP servers
        $mail->SMTPAuth = true;           // turn on SMTP authentication
        $mail->Username = "";     // SMTP username  注意：普通邮件认证不需要加 @域名
        $mail->Password = ""; // SMTP password
        $mail->From = "";      // 发件人邮箱
        $mail->FromName =  "9k-admin";  // 发件人

        $mail->CharSet = "utf-8";   // 这里指定字符集！
        $mail->Encoding = "base64";
        $mail->AddAddress($sendto_email,"username");  // 收件人邮箱和姓名
        $mail->AddReplyTo("851978548@qq.com","qq.com");
        //$mail->WordWrap = 50; // set word wrap 换行字数
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 附件
        //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
        $mail->IsHTML(true);  // send as HTML
        // 邮件主题
        $mail->Subject = $subject;
        // 邮件内容
        $mail->Body = "
    I love php。
    ";
        $mail->AltBody ="text/html";
        if(!$mail->Send())
        {
            echo "error: " . $mail->ErrorInfo;
            exit;
        }
        else {
            echo "$user_name send success!<br />";
        }
    }
    // 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)
    smtp_mail("284906466@qq.com", "phpmailer！", "test", "yourdomain.com", "zhouyi");
