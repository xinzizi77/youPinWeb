    <?php
    require("class.phpmailer.php");
    function smtp_mail( $sendto_email, $subject, $body, $extra_hdrs, $user_name){
        $mail = new PHPMailer();
        $mail->IsSMTP();                  // send via SMTP
        $mail->Host = "smtp.qq.com";   // SMTP servers
        $mail->SMTPAuth = true;           // turn on SMTP authentication
        $mail->Username = "";     // SMTP username  ע�⣺��ͨ�ʼ���֤����Ҫ�� @����
        $mail->Password = ""; // SMTP password
        $mail->From = "";      // ����������
        $mail->FromName =  "9k-admin";  // ������

        $mail->CharSet = "utf-8";   // ����ָ���ַ�����
        $mail->Encoding = "base64";
        $mail->AddAddress($sendto_email,"username");  // �ռ������������
        $mail->AddReplyTo("851978548@qq.com","qq.com");
        //$mail->WordWrap = 50; // set word wrap ��������
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment ����
        //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
        $mail->IsHTML(true);  // send as HTML
        // �ʼ�����
        $mail->Subject = $subject;
        // �ʼ�����
        $mail->Body = "
    I love php��
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
    // ����˵��(���͵�, �ʼ�����, �ʼ�����, ������Ϣ, �û���)
    smtp_mail("284906466@qq.com", "phpmailer��", "test", "yourdomain.com", "zhouyi");
