<?php
    require_once("../php/SqlAbout/sqlfunction.php");
    require_once("../php/SqlAbout/sqlfunction_58city.php");
    require_once("../php/SqlAbout/sqlfunction_farm.php");    
    require "phpQuery/phpQuery.php";
    require "db_fns.php";
    
    set_time_limit(0);

class HNW{
    function __construct(){
        $this->times    =    [];
        $this->types    =    [];
        $this->places    =    [];
        $this->prices    =    [];
    }

    function Get_url($url){
        $this->url = $url;
    }

    function get_page_info($docin){

    }

    function find_page($url){
        $context    =   file_get_contents($this->url);
        $document	=	phpQuery::newDocumentHTML($context);
        $doc 		=	phpQuery::pq("");

        $text_box	=	$doc->find(".column-other ul.list-con");
        
        foreach($text_box as $key=> $value){
            $time = pq($value)->find("a li:eq(0)")->text();
            $time = str_replace(" ", "",$time);            
            $type = pq($value)->find("a li:eq(1)")->text();
            $type = str_replace(" ", "",$type);
            $place = pq($value)->find("a li:eq(2)")->text();
            $place = str_replace(" ", "",$place);            
            $price = pq($value)->find("a li:eq(3)")->text();
            $price = str_replace(" ", "",$price);
            
            
            array_push($this->times, $time);
            array_push($this->types, $type);
            array_push($this->places, $place);
            array_push($this->prices, $price);

        }
            // print_r($this->times);    
        
        
    }

    function inSql($maintype,$time,$type,$place,$price){
                upload_f("tendency", "maintype,time,type,place,price", "'{$maintype}','{$time}','{$type}','{$place}','{$price}'");       
    }
}

$obj = new HNW();
// $type = ["mangguo","lizhi","longyan","songsj","yuanm","shanhj","lurg","sum","longzg","helg","haixg","maojg","jig","zhuj","zihg","xiuzg","bailg","baij","fenwg","dagqg","hongmg","huangjg","songl","songm","yinpg","songrg","zhudg","huanzg","zhenm","qinggj","jiyj","heifzj","edj","qingtj","ganbj","hung","hongg","jizj","yangdj",];菌类
// $type = ["mangguo","lizhi","longyan","boluo","hng","xiangj","liulian","mugua","lianwu","shanzhuo","yezi","ganzhe","blm","nyg","ganlan","yangtao","ningmeng","dhg","yugangguo","rxg","nuoliguo","llm","xrm","ganju","jinju","qicheng","youzi","putao","caomei","shumei","slg","sangshen","lanmei","mht","shizi","bxg","heimei","spt","ldg","suanjiao","shajg","mati","guniangguo","chapg","niunaiguo","xigua","tiangua","hmg","diaogua","bayuegua","jiuyuegua","dsg","pingguo","liz","xianzao","xin","yangmei","qinmei","tao","maotao","pt","huangtao","youtao","shiliu","whg","fsl","hpg","rsg","hmd","sjg","hlh","lhg","mtg","xuelianguo","hsg","hhg","gaizao","goutao","yingtao","pipa","ximei","jincili","wumei","gaiguo","xcy","douya","yamc","cly","yuya","hongshuye","ciqin","hul","jhc","mlt","zbtk","juecai","zisu","dlh","bingcao","kuju","syec","ngt","facai","chuncai","xbh","hhcai","yxc","dpc","mzx","btc","xyac","jxc","gongcai","ssc","shc","mdx","diaoc","zsb","yuns","lagen","yelian","yelh","mddlan","kuzhuguo","ciwujiacai","yangji","lajiao","xhs","qiezi","qiukui","xyumi","maodou","daodou","sijidou","doujiao","biandou","wandouo","hld","sld","baiyudou","qcd","jiaobai","lianou","lusun","shuiqin","lingjiao","cigu","poudai","xianqs","lianpeng","jiuhuang","suanmiao","dasuan","shengjiang","dacong","xiaocong","suantai","yangcong","jct","jiaotou","yangjiang","congz","yesuan","nangua","sigua","donggua","huanggua","kugua","fsg","xhl","jsjg","hugua","dipu","qtsyj","shuangbg","muer","jzg","pinggu","songrong","yiner","xbg","huagu","mogu","luobo","hlb","dongsu","gegen","jcg","moy","mushu","liangshu","shanyao","hongshu","zishu","tudou","tutou","bans","pancai","hyc","xlh","baocai","bc","xbc","shengcai","xianc","wawacai","jiucai","mec","xiangcai","ymc","youcai","kxco","baocai","tiancai","hxcai","lbc","qincai","wosun","jicai","jiecaio","caigai","ercai","tonggao","doubanc","lihao","siguajian"];
$type=["pingguo","pipa","ximei","yingtao","xianzao","xuelianguo","lhg","sjg","rsg","hmd","hpg","fsl","whg","yangtao","caomei","putao","xigua","liz","mangguo","lizhi","longyan","lizi","buoluo","hng","xiangj","liulian","mugua","shanzhuo","yezi","ganzhe","blm","ganju","jinju","qicheng","youzi","douya","qiezi","xhs","nangua","dasuan","shengjiang","xlh","sigua","donggua","huanggua","kugua","bc","xbc","shengcai","fsg","xhl","luobo","hugua","dipu","ji","ya","e","gezi","niu","yang","zhu","ma","gou","tuzi","mao","zhegu","yeya","anchun","shanji","huoji","zzj","wgji","yezhu","haozhu","xiangzhu"];
$typename = ["苹果","枇杷","西梅","樱桃","鲜枣","雪莲果","罗汉果","释迦果","人参果","红毛丹","黄皮果","番石榴","无花果","杨桃","草莓","葡萄","西瓜","梨","芒果","荔枝","龙眼","李子","菠萝","火龙果","香蕉","榴莲","木瓜","山竹","椰子","甘蔗","菠萝蜜","柑桔","金桔","脐橙","柚子","豆芽","茄子","西红柿","南瓜","大蒜","生姜","西兰花","丝瓜","冬瓜","黄瓜","苦瓜","白菜","小白菜","生菜","佛手瓜","西葫芦","萝卜","瓠瓜","地蒲","鸡","鸭","鹅","鸽子","牛","羊","猪","马","狗","兔子","猫","鹧鸪","野鸭","鹌鹑","山鸡","火鸡","珍珠鸡","乌骨鸡","野猪","豪猪","香猪"];
// $arrs[1] = $type;
// $arrs[2] = $typename;
// var_dump($arrs);die;
for($i=0;$i<count($type);$i++){
    $newUrl = "http://www.cnhnb.com/hangqing/%s";
    $newUrl = sprintf($newUrl, $type[$i]);
    // echo $newUrl;
    $obj->Get_url($newUrl);
    $obj->find_page($obj->url);
    $maintype = $typename[$i];
    for($a=0;$a<count($obj->times);$a++){
        // echo "\n".count($obj->times)."\n";
        // print_r($obj->types);        
        echo $i.$type[$i]." ".$a."\n";
        selectin_f("*","tendency","time='{$obj->times[$a]}' and type='{$obj->types[$a]}' and place='{$obj->places[$a]}' and price='{$obj->prices[$a]}'", "findOne_f");
        if(!isset($row)){
            echo $obj->places[$a].$obj->types[$a]."\n";
            echo $maintype;
            $obj->inSql($maintype,$obj->times[$a],$obj->types[$a],$obj->places[$a],$obj->prices[$a]);
            echo "存取成功\n";                   
        }else{
            echo $obj->places[$a].$obj->types[$a]."\n";            
            echo "已经存在\n";
        }
    }
        sleep(3);            
    $obj->times = [];
    $obj->types = [];
    $obj->places = [];
    $obj->prices = [];        
}
?>