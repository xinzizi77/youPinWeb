<?php
    header('Content-type:text/json');

    require_once("SqlAbout/sqlfunction.php");
    require_once("SqlAbout/sqlfunction_58city.php");

    // $_SESSION['emailLogin'] = 'admin@admin.com';
    if(isset($_SESSION['emailLogin'])){
        $arrs =[];
        $arr = '';
        selectin("id", "user_table", "email='{$_SESSION['emailLogin']}'", "findOne");
        $u_id = $row['id'];
        selectin("*", "userinfo", "u_id='{$u_id}'", "findOne");
        if(isset($row) && $row !== ''){
            // var_dump($row);
            $jobType = $row['jobType'];
            $WorkPlace = $row['WorkPlace'];
            $MoneyWant = $row['MoneyWant'];
            // select_c("*", "job", 'findOne');
            selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_a LIKE '%{$WorkPlace}%' and monthMoney LIKE '%{$MoneyWant}%'", "findAll");
            $rows_a = $rows;
            // echo 1;
                if(!isset($rows_a) || $rows_a == '' || empty($rows_a)){
                    // echo 2;
                    selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_b LIKE '%{$WorkPlace}%' and monthMoney LIKE '%{$MoneyWant}%'", "findAll");
                    $rows_b = $rows;
                        if(!isset($rows_b) || $rows_b == '' || empty($rows_b)){
                            // echo 3;
                             selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_c LIKE '%{$WorkPlace}%' and monthMoney LIKE '%{$MoneyWant}%'", "findAll");                            
                             $rows_c = $rows;
                                if(!isset($rows_c) || $rows_c == '' || empty($rows_c)){
                                    echo "false";
                                    selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_a LIKE '%{$WorkPlace}%' ", "findAll");
                                    $rows_a = $rows;
                                    // echo 4;
                                        if(!isset($rows_a) || $rows_a == '' || empty($rows_a)){
                                            // echo 5;
                                            selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_b LIKE '%{$WorkPlace}%' ", "findAll");
                                            $rows_b = $rows;
                                                if(!isset($rows_b) || $rows_b == '' || empty($rows_b)){
                                                    // echo 6 ;
                                                     selectin_c("*", "job", "type LIKE '%{$jobType}%' and area_c LIKE '%{$WorkPlace}%'", "findAll");                            
                                                     $rows_c = $rows;
                                                        if(!isset($rows_c) || $rows_c == '' || empty($rows_c)){
                                                            // echo "false_again";
                                                            echo "数据库暂时没有你想要的工作";
                                                            //此条件也不符合
                                                        }else{
                                                            // var_dump($rows_c);
                                                            for($a=0;$a<6;$a++){
                                                                if(!isset($rows_c[$a][2]) || $rows_c[$a][2] == ''){
                                                                    break;
                                                                }
                                                                $arr1 = array(
                                                                    "jobName"       =>      $rows_c[$a][2],
                                                                    "type"          =>      $rows_c[$a][3],
                                                                    "monthMoney"    =>      $rows_c[$a][5],
                                                                    "needPeople"    =>      $rows_c[$a][6],
                                                                    "eduRequire"    =>      $rows_c[$a][7],
                                                                    "expRequire"    =>      $rows_c[$a][8],
                                                                    "area_a"        =>      $rows_c[$a][9],
                                                                    "area_b"        =>      $rows_c[$a][10],
                                                                    "area_c"        =>      $rows_c[$a][11],
                                                                    "place"         =>      $rows_c[$a][12],
                                                                    "conditions"    =>      $rows_c[$a][13],
                                                                    "id"            =>      $rows_c[$a][0]
                                                                );
                                                                array_push( $arrs ,$arr11);
                                                                $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                                                                
                                                            }
                                                            // header('Content-type:text/json');
        
                                                            $json =  json_encode($arrs, JSON_UNESCAPED_UNICODE);
                                                            echo $json;
                                                        }
                                                }else{
                                                    // var_dump($rows_b);
                                                    for($a=0;$a<6;$a++){
                                                        if(!isset($rows_b[$a][2]) || $rows_b[$a][2] == ''){
                                                            break;
                                                        }
                                                        $arr1 = array(
                                                            "jobName"       =>      $rows_b[$a][2],
                                                            "type"          =>      $rows_b[$a][3],
                                                            "monthMoney"    =>      $rows_b[$a][5],
                                                            "needPeople"    =>      $rows_b[$a][6],
                                                            "eduRequire"    =>      $rows_b[$a][7],
                                                            "expRequire"    =>      $rows_b[$a][8],
                                                            "area_a"        =>      $rows_b[$a][9],
                                                            "area_b"        =>      $rows_b[$a][10],
                                                            "area_c"        =>      $rows_b[$a][11],
                                                            "place"         =>      $rows_b[$a][12],
                                                            "conditions"    =>      $rows_b[$a][13],
                                                            "id"            =>      $rows_b[$a][0]                                                            
                                                        );
                                                        array_push( $arrs ,$arr1);
                                                        $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                                                            
                                                    }
                                                    // header('Content-type:text/json');

                                                    $json =  json_encode($arrs, JSON_UNESCAPED_UNICODE);
                                                    echo $json;                            
                                                }
                                        }else{
                                            // var_dump($rows_a);
                                            for($a=0;$a<6;$a++){
                                                if(!isset($rows_c[$a][2]) || $rows_c[$a][2] == ''){
                                                    break;
                                                }
                                                $arr1 = array(
                                                    "jobName"       =>      $rows_a[$a][2],
                                                    "type"          =>      $rows_a[$a][3],
                                                    "monthMoney"    =>      $rows_a[$a][5],
                                                    "needPeople"    =>      $rows_a[$a][6],
                                                    "eduRequire"    =>      $rows_a[$a][7],
                                                    "expRequire"    =>      $rows_a[$a][8],
                                                    "area_a"        =>      $rows_a[$a][9],
                                                    "area_b"        =>      $rows_a[$a][10],
                                                    "area_c"        =>      $rows_a[$a][11],
                                                    "place"         =>      $rows_a[$a][12],
                                                    "conditions"    =>      $rows_a[$a][13],
                                                    "id"            =>      $rows_a[$a][0]
                                                );
                                                array_push( $arrs ,$arr1);
                                                $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                                                
                                            }
                                            // header('Content-type:text/json');

                                            $json = json_encode($arrs, JSON_UNESCAPED_UNICODE);
                                            echo $json;                            
                                        }
                                    //没有匹配到用户需要的工作
                                }else{
                                    // var_dump($rows_c);
                                    for($a=0;$a<6;$a++){
                                        if(!isset($rows_c[$a][2]) || $rows_c[$a][2] == ''){
                                            break;
                                        }
                                        $arr1 = array(
                                            "jobName"       =>      $rows_c[$a][2],
                                            "type"          =>      $rows_c[$a][3],
                                            "monthMoney"    =>      $rows_c[$a][5],
                                            "needPeople"    =>      $rows_c[$a][6],
                                            "eduRequire"    =>      $rows_c[$a][7],
                                            "expRequire"    =>      $rows_c[$a][8],
                                            "area_a"        =>      $rows_c[$a][9],
                                            "area_b"        =>      $rows_c[$a][10],
                                            "area_c"        =>      $rows_c[$a][11],
                                            "place"         =>      $rows_c[$a][12],
                                            "conditions"    =>      $rows_c[$a][13],
                                            "id"            =>      $rows_c[$a][0]                                            
                                        );
                                        array_push( $arrs ,$arr1);
                                        $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                                    }
                                    // header('Content-type:text/json');

                                    $json = json_encode($arrs, JSON_UNESCAPED_UNICODE);
                                    echo $json;
                                    
                                }
                        }else{
                            // var_dump($rows_b);
                            for($a=0;$a<count($rows_b);$a++){
                                if(!isset($rows_b[$a][2]) || $rows_b[$a][2] == ''){
                                    break;
                                }
                                $arr1 = array(
                                    "jobName"       =>      $rows_b[$a][2],
                                    "type"          =>      $rows_b[$a][3],
                                    "monthMoney"    =>      $rows_b[$a][5],
                                    "needPeople"    =>      $rows_b[$a][6],
                                    "eduRequire"    =>      $rows_b[$a][7],
                                    "expRequire"    =>      $rows_b[$a][8],
                                    "area_a"        =>      $rows_b[$a][9],
                                    "area_b"        =>      $rows_b[$a][10],
                                    "area_c"        =>      $rows_b[$a][11],
                                    "place"         =>      $rows_b[$a][12],
                                    "conditions"    =>      $rows_b[$a][13],
                                    "id"            =>      $rows_b[$a][0]                                    
                                );
                                array_push( $arrs ,$arr1);
                                $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                            }
                            // header('Content-type:text/json');

                            $json = json_encode($arrs, JSON_UNESCAPED_UNICODE);
                            echo $json;
                        }
                }else{
                    for($a=0;$a<6;$a++){
                        if(!isset($rows_a[$a][2]) || $rows_a[$a][2] == ''){
                            break;
                        }
                        $arr1 = array(
                            "jobName"       =>      $rows_a[$a][2],
                            "type"          =>      $rows_a[$a][3],
                            "monthMoney"    =>      $rows_a[$a][5],
                            "needPeople"    =>      $rows_a[$a][6],
                            "eduRequire"    =>      $rows_a[$a][7],
                            "expRequire"    =>      $rows_a[$a][8],
                            "area_a"        =>      $rows_a[$a][9],
                            "area_b"        =>      $rows_a[$a][10],
                            "area_c"        =>      $rows_a[$a][11],
                            "place"         =>      $rows_a[$a][12],
                            "conditions"    =>      $rows_a[$a][13],
                            "id"            =>      $rows_a[$a][0]                            
                        );
                        array_push( $arrs ,$arr1);
                        $arr .= "<br>------------------------<br>工作名称:".$rows_a[$a][2]."<br>工作类型:".$rows_a[$a][3]."<br>月薪".$rows_a[$a][5]."<br>招聘人数:".$rows_a[$a][6]."<br>学历要求：".$rows_a[$a][7]."<br>经验要求:".$rows_a[$a][8]."<br>地点:".$rows_a[$a][9].$rows_a[$a][10].$rows_a[$a][11].$rows_a[$a][12]."<br>待遇福利:".$rows_a[$a][13]; 
                    }
                    // header('Content-type:text/json');
                    // echo 1;
                    // $json = var_dump($arrs);

                    $json = json_encode($arrs, JSON_UNESCAPED_UNICODE);
                    echo $json;
                }
            
            
        }else{
            return;
        }
        //从数据库中取出当前用户的信息


    }
?>