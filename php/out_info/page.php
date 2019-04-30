<?php
header('Content-type:text/json');
require_once("../SqlAbout/sqlfunction_58city.php");

if (isset($_POST['require']) and isset($_POST['require2'])) {
    $require = $_POST['require'];
    $require2 = $_POST['require2'];
    selectin_c("*", "job", "area_a LIKE '%{$require}%' and type LIKE '%{$require2}%'", "findAll");
} else if (isset($_POST['require'])) {
    $require = $_POST['require'];
    selectin_c("*", "job", "area_a LIKE '%{$require}%'", "findAll");
} else if (isset($_POST['require2'])) {
    $require2 = $_POST['require2'];
    selectin_c("*", "job", "type LIKE '%{$require2}%'", "findAll");
} else {
    select_c("*", "job", "findAll");
}

echo ceil(count($rows) / 10);
    //总共该有多少条数
?>