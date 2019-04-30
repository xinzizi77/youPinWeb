<?php
        require_once("sql.php");
        require_once("function.php");

        // $conn = mysqlConnect();

        // function __Construct(){
        // }

		

        function findOne(){
            global $result;
            global $row;
           $row = mysqli_fetch_assoc($result);
        }
        
        function findAll(){
            global $result;
            global $rows;
            $rows = mysqli_fetch_all($result);
            // echo 2;
        }

        function sqlDo(){
            global $conn;
            global $query;
            global $result;
            $result = mysqlExecute($conn, $query);
            // echo 1;
        }

        function selectin($table_name, $form_name, $require, $way){
            //带条件查找
            global $conn;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name." WHERE ".$require;
            // echo $query;
            sqlDo();
            $way();
        }

        function select($table_name, $form_name, $way){
            //查找所有
            global $conn;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT ".$table_name." FROM ".$form_name;
            sqlDo();
            $way();            
        }

        function upload($form_name, $table_name, $data){
            //上传插入
            global $conn;
            global $query;
            global $result;
            $query = "insert into ".$form_name."(".$table_name.") values(".$data.")";//sql的插入语句  格式：insert into 表(多个字段)values(多个值)
            // echo $query;die;
            sqlDo();
        }

        function update($form_name,$change,$where){
            //更新信息
            global $conn;
            global $query;
            global $result;
            $query = "update ".$form_name." set ".$change." where ".$where;//修改操作 格式 update 表名 set 字段=值 where 条件
            // echo $query;
            // die;
            sqlDo();
        }

        function del($form_name,$where){
            //删除信息
            global $conn;
            global $query;
            global $result;
            $query = "delete from ".$form_name." where ".$where;//删除sql语句 格式：delete from 表名 where 条件
            sqlDo();
        }

        function searchRepeat($table_name, $form_name, $way){
            //查出不同项
            global $conn;
            global $query;
            global $result;
            global $rows;
            global $row;
            $query = "SELECT DISTINCT ".$table_name." FROM ".$form_name;
            sqlDo();
            $way();
        }
?>