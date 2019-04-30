<?php
    function connect_db(&$db){
        $db = mysqli_connect("localhost","root","","58city");
        mysqli_query($db, "set names 'utf8'");
    }
?>