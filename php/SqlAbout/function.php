<?php

session_start();

function skip($info, $url){
    echo "<script>
            alert('$info');
            window.location.href='$url'
            </script>";
}

function onlyskip($info){
    echo "<script>
            alert('$info');
            </script>";
}

function mysqlExecute($conn,$query){
    $result = mysqli_query($conn,$query);
    if(!$result){
		die ('执行失败:'.mysqli_error($conn));
	}
	return $result;
}

function mysqlConnect($host,$user,$password,$db){
    $conn = mysqli_connect($host,$user,$password,$db);

    if(!$conn){
        die ('执行失败:'.mysqli_error($conn));	
    }

    mysqli_set_charset($conn,'utf8');
    return $conn;
}

function decodeUnicode($str){
    //json文件转码
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}


