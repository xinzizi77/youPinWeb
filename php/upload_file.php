<?php
require_once("SqlAbout/sqlfunction.php");
require_once("SqlAbout/sqlfunction_58city.php");
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
// echo $_FILES["file"]["size"];
// onlyskip("当前上传文件的大小为：".$_FILES['file']['size']);
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2097152)   // 小于 200 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        // echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        skip($_FILES['file']['error'], "person_info.html");
    }
    else
    {
        // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777

        for($i=0;;$i++){
            $_FILES["file"]["name"] = $i."_version_pictures.".$extension;
			$name = $_FILES['file']['name'];
			$src = "../upload/".$_FILES['file']['name'];
            file_put_contents('picture.json',$name);
            if (file_exists("../upload/" . $_FILES["file"]["name"]))
            {
                continue;
                // echo " 文件已经存在。 ";
                // echo $_FILES["file"]["name"];
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
                upload("picture", "src", "'{$src}'");
                update("user_table", "p_id='{$name}'", "email='{$_SESSION['emailLogin']}'");                
                // update("user_table", "p_id='{$name}'", "email='{$_SESSION['emailLogin']}'");
                echo "upload/".$_FILES["file"]["name"];
                // echo "success";
                // skip("上传成功", "person_info.html");
                break;
            }
        }
    }
}
else
{
    skip("非法的文件格式", "person_info.html");
}
?>