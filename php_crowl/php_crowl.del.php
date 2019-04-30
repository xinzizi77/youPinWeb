<?php
    require "phpQuery/phpQuery.php";
    require "db_fns.php";
    require_once("../php/SqlAbout/sqlfunction_58city.php");

    class phpcrowl_del{
        function Get_url($url){
            $this->url = $url;
        }

        function find_page($url){
            $context    =   file_get_contents($this->url);
            $document	=	phpQuery::newDocumentHTML($context);
            $doc 		=	phpQuery::pq("");
    
            $text_box	=	$doc->find("div.item_con.pos_info");
            // body > div.con > div.leftCon > div.item_con.pos_info
            // echo $text_box;
            return $text_box;
        }
    }


    select_cAsc("id,href", "job", "findAll");
    // var_dump($rows);die;
    for($i=0;$i<count($rows);$i++){
        // echo $rows[$i][0]."\n";
        $time = rand(10,25);
        echo "wait for ".$time."\n";
        sleep($time);
        $obj = new phpcrowl_del();
        $obj->Get_url($rows[$i][1]);
        $text_box = $obj->find_page($obj->url);
        echo "now is ".$i."\n";
        echo "the id is: ".$rows[$i][0]."\n";
            if(empty($text_box)){
                del_c("job", "id='{$rows[$i][0]}'");
                echo "\ndel success \n";
            }else{
                echo "\nstill have use\n";
            }
    }
?>