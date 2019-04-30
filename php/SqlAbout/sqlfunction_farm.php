<?php
require_once("sql.php");
require_once("function.php");

        // $conn = mysqlConnect();

        // function __Construct(){
        // }



function findOne_f()
{
        global $result;
        global $row;
        $row = mysqli_fetch_assoc($result);
}

function findAll_f()
{
        global $result;
        global $rows;
        $rows = mysqli_fetch_all($result);
            // echo 2;
}

function sqlDo_f()
{
        global $conn_f;
        global $query;
        global $result;
        $result = mysqlExecute($conn_f, $query);
            // echo 1;
}

function selectin_f($table_name, $form_name, $require, $way)
{
            //带条件查找
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "SELECT " . $table_name . " FROM " . $form_name . " WHERE " . $require . " order by id desc";
            // echo $query;die;
        sqlDo_f();
        $way();
}

function selectin_fl($table_name, $form_name, $require, $way)
{
            //带条件查找
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "SELECT " . $table_name . " FROM " . $form_name . " WHERE " . $require;
        // echo $query;
        sqlDo_f();
        $way();
}

function select_theSame_out_f($table_name, $form_name, $type, $way)
{
    //查询哪个值重复
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "select " . $table_name . " from " . $form_name . " where maintype='".$type."' group by " . $table_name . " having count(" . $table_name . ")>1 ";
    // echo $query;
        sqlDo_f();
        $way();
}

function select_theSame_f($table_name, $form_name, $table_name_same,$things,$way)
    //把重复的数据呈现出来
{
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "select " . $table_name . " from " . $form_name . " where " . $table_name_same . " in (select " . $table_name_same . " from " . $form_name . " where maintype='".$things."' group by " . $table_name_same . " having count(" . $table_name_same . ") > 1)";
        // echo $query;die;
        sqlDo_f();
        $way();
}

function select_f($table_name, $form_name, $way)
{
            //查找所有倒序输出
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "SELECT " . $table_name . " FROM " . $form_name . " order by id desc";
        sqlDo_f();
        $way();
}

function select_fl($table_name, $form_name, $way)
{
            //查找所有正序输出
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "SELECT " . $table_name . " FROM " . $form_name;
        sqlDo_f();
        $way();
}

function upload_f($form_name, $table_name, $data)
{
            //上传插入
        global $conn_f;
        global $query;
        global $result;
        $query = "insert into " . $form_name . "(" . $table_name . ") values(" . $data . ")";//sql的插入语句  格式：insert into 表(多个字段)values(多个值)
            // echo $query;die;
        sqlDo_f();
}

function update_f($form_name, $change, $where)
{
            //更新信息
        global $conn_f;
        global $query;
        global $result;
        $query = "update " . $form_name . " set " . $change . " where " . $where;//修改操作 格式 update 表名 set 字段=值 where 条件
            // echo $query;die;
        sqlDo_f();
}

function del_f($form_name, $where)
{
            //删除信息
        global $conn_f;
        global $query;
        global $result;
        $query = "delete from " . $form_name . " where " . $where;//删除sql语句 格式：delete from 表名 where 条件
            // echo $query;die;
        sqlDo_f();
}

function searchRepeat_f($table_name, $form_name, $way)
{
            //查出不同项
        global $conn_f;
        global $query;
        global $result;
        global $rows;
        global $row;
        $query = "SELECT DISTINCT " . $table_name . " FROM " . $form_name;
        echo $query;
        die;
        sqlDo_f();
        $way();
}
?>