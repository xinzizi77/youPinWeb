<?php
        require_once("sql.php");
        require_once("function.php");

        // $conn = mysqlConnect();

        // function __Construct(){
        // }

		

        function findOne_c(){
            global $result;
            global $row;
           $row = mysqli_fetch_assoc($result);
        }
        
        function findAll_c(){
            global $result;
            global $rows;
            $rows = mysqli_fetch_all($result);
            // echo 2;
        }

        function sqlDo_c(){
            global $conn_c;
            global $query;
            global $result;
            $result = mysqlExecute($conn_c, $query);
            // echo 1;
        }

        function selectin_c($table_name, $form_name, $require, $way){
            //带条件查找
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name." WHERE ".$require." order by id desc";
            sqlDo_c();
            $way();
        }

        function selectin_cl($table_name, $form_name, $require, $way){
            //带条件查找
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name." WHERE ".$require;
            sqlDo_c();
            $way();
        }

        function select_c($table_name, $form_name, $way){
            //查找所有倒序输出
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name." order by id desc";
            sqlDo_c();
            $way();            
        }

        function select_cAsc($table_name, $form_name, $way){
            //查找所有正序输出
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name." order by id asc";
            sqlDo_c();
            $way();            
        }

        function select_cl($table_name, $form_name, $way){
            //查找所有正序输出
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name;
            sqlDo_c();
            $way();  
        }

        function upload_c($form_name, $table_name, $data){
            //上传插入
            global $conn_c;
            global $query;
            global $result;
            $query = "insert into ".$form_name."(".$table_name.") values(".$data.")";//sql的插入语句  格式：insert into 表(多个字段)values(多个值)
            // echo $query;die;
            sqlDo_c();
        }

        function update_c($form_name,$change,$where){
            //更新信息
            global $conn_c;
            global $query;
            global $result;
            $query = "update ".$form_name." set ".$change." where ".$where;//修改操作 格式 update 表名 set 字段=值 where 条件
            // echo $query;die;
            sqlDo_c();
        }

        function del_c($form_name,$where){
            //删除信息
            global $conn_c;
            global $query;
            global $result;
            $query = "delete from ".$form_name." where ".$where;//删除sql语句 格式：delete from 表名 where 条件
            // echo $query;die;
            sqlDo_c();
        }

        function searchRepeat_c($table_name, $form_name, $way){
            //查出不同项
            global $conn_c;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT DISTINCT ".$table_name." FROM ".$form_name;
            echo $query;die;
            sqlDo_c();
            $way();
        }
?>