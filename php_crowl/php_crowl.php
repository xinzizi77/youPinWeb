<?php
	require "phpQuery/phpQuery.php";
	require "db_fns.php";
	set_time_limit(0);
	class GetHTML{
		public function __construct($url){
			$this->url = $url;
			$this->city = ['bj','sh','gz','sz','tj','hz','nj','jn','cq','qd','dl','nb','xm','cd','wh','hrb','sy','xa','cc','cs','fz','zz','sjz','su','fs','dg','wx','yt','ty','hf','nc','nn','km','wz','ts'];
			$this->type = ['zpshengchankaifa','zplvyoujiudian','chaoshishangye','siji','zpwuliucangchu','jiazhengbaojiexin','kefu'];
			$this->db = "";
			// $this->i = 10;
			// $this->j = 0;
			// $this->pagenum = 28;
			$json_string = file_get_contents("./member.json");
			// echo $json_string;die;
			$data = json_decode($json_string, true);
			$this->i = (int)$data['i'];
			$this->j = (int)$data['j'];
			$this->pagenum = (int)$data['p'];
		}
		public function islink(){
			connect_db($this->db);
			for(;$this->i < count($this->city);$this->i++){
				for(;$this->j < count($this->type);$this->j++){
					// sleep(1);
					// $url = sprintf($this->url,$this->city[$this->i],$this->type[$this->j],1);
					// $page = file_get_contents($url);
					// $pagedata = phpQuery::newDocumentHTML($page);
					// $doc = phpQuery::pq("");
					// $page_max = $doc->find("i.total_page")->text();
					// if($page_max == ""){
					// 	echo "页码验证码\n";
					// 	$data = '{"i":"'.$this->i.'","j":"'.$this->j.'","p":"'.$this->pagenum.'"}';
					// 	file_put_contents('./member.json', $data);
					// 	echo "断点存档\n";
					// 	die;
					// }
					for(;$this->pagenum <= 30;$this->pagenum++){
					// for(;$this->pagenum <= $page_max;$this->pagenum++){
						$time = rand(2,10);
						sleep($time);
						$url = sprintf($this->url,$this->city[$this->i],$this->type[$this->j],$this->pagenum);
						// echo $url."<br>";die;
						$page = file_get_contents($url);
						$pagedata = phpQuery::newDocumentHTML($page);
						$doc = phpQuery::pq("");
						$text_box = $doc->find("div.leftCon > ul > li");
						if($text_box == ""){
							echo "验证码\n";
							$data = '{"i":"'.$this->i.'","j":"'.$this->j.'","p":"'.$this->pagenum.'"}';
							file_put_contents('./member.json', $data);
							echo "断点存档\n";
							die;
						}
						echo "下一页\n";
						foreach($text_box as $value){
							echo $this->i."|".$this->j."|".$this->pagenum."页\n";
							echo $this->pagenum."页\n";
							$xueli = pq($value)->find("span.xueli")->text();
							$date = pq($value)->find(".sign")->text();
							if($date == "精准" || $date == "优选" || $date == "置顶"){
								echo "条件不符\n";
								continue;
							}
							$title = pq($value)->find("div:eq(0) > div:eq(0) > a > span:eq(1)")->text();
							$title = str_replace(" ","",$title);
							$link = pq($value)->find("div:eq(0) > div:eq(0) > a")->attr("href");
							$link = str_replace(" ","",$link);
							$company = pq($value)->find("div.comp_name > a")->attr("title");
							$company = str_replace(" ","",$company);
							$money = pq($value)->find("p.job_salary")->text();
							$money = str_replace(" ","",$money);
							if($money == "面议")$money = "薪资面议";
							if(strpos($title,'…')){
								$title = str_replace("…","%",$title);
								$result = mysqli_query($this->db,"SELECT * FROM job WHERE jobName LIKE '{$title}' and company_name LIKE '%{$company}%' and monthMoney='{$money}' ORDER BY id DESC");
								$row=mysqli_fetch_assoc($result);
								if(isset($row)){
									echo "省略号已有数据\n";
									continue;
								}
							}

							$result = mysqli_query($this->db,"SELECT * FROM job WHERE jobName='{$title}' and company_name LIKE '%{$company}%' and monthMoney='{$money}' ORDER BY id DESC");
							$row=mysqli_fetch_assoc($result);
							if(isset($row)){
								echo "已有数据\n";
								continue;
							}
							// else{
							// 	echo "SELECT * FROM job WHERE jobName='{$title}' and company_name LIKE '%{$company}%' and monthMoney='{$money}' ORDER BY id DESC";
							// 	echo "新数据\n";
							// 	continue;
							// }
							$time = rand(2,30);
							sleep($time);
							$this->get_info($link);
						}
						// sleep(10);
						$data = '{"i":"'.$this->i.'","j":"'.$this->j.'","p":"'.$this->pagenum.'"}';
						file_put_contents('./member.json', $data);
						echo $data;
					}
					$this->pagenum = 1;
				}
				$this->j = 0;
			}
			// $this->i = 0;
		}
		public function get_info($url){
			echo "数据抓取\n";
			$page = file_get_contents($url);
			$pagedata = phpQuery::newDocumentHTML($page);
			$doc = phpQuery::pq("");
			$type = $doc->find("span.pos_title")->text();
			$type = str_replace(" ","",$type);
			$title = $doc->find("span.pos_name")->text();
			$title = str_replace(" ","",$title);
			$money = $doc->find("span.pos_salary")->text();
			$money = str_replace(" ","",$money);
			$fuli = $doc->find("div.pos_welfare")->text();
			$quantity = $doc->find("div.pos_base_condition > span:eq(0)")->text();
			$quantity = str_replace(" ","",$quantity);
			$xueli = $doc->find("div.pos_base_condition > span:eq(1)")->text();
			$xueli = str_replace(" ","",$xueli);
			$jingyan = $doc->find("div.pos_base_condition > span:eq(2)")->text();
			$jingyan = str_replace(" ","",$jingyan);

			$area_a = $doc->find("div.pos-area > span:eq(0) > span:eq(0)")->text();
			$area_a = str_replace(" ","",$area_a);
			$area_b = $doc->find("div.pos-area > span:eq(0) > span:eq(1)")->text();
			$area_b = str_replace(" ","",$area_b);
			$area_c = $doc->find("div.pos-area > span:eq(0) > span:eq(2)")->text();
			$area_c = str_replace(" ","",$area_c);
			$address = $doc->find("div.pos-area > span:eq(1)")->text();
			$introduce = $doc->find("div.posDes > div.des")->html();
			$comp_introd = $doc->find("div.shiji")->html();
			$company = $doc->find("div.comp_baseInfo_title > div > a")->text();
			$comp_link = $doc->find("div.comp_baseInfo_title > div:eq(0) > a")->attr("href");
			$renzheng1 = $doc->find("div.identify_title > span")->text();
			$renzheng2 = $doc->find("div.identify_con.clearfix > span:eq(0) > span")->text();
			$renzheng3 = $doc->find("div.identify_con.clearfix > span:eq(1) > span")->text();
			if($type == ""){
				echo "验证码\n";
				$data = '{"i":"'.$this->i.'","j":"'.$this->j.'","p":"'.$this->pagenum.'"}';
				file_put_contents('./member.json', $data);
				echo "断点存档\n";
				die;
			}
			sleep(2);
			$this->get_comp($manager,$phone,$comp_link);
			$city = $this->save($this->city[$this->i]);
			if($city == false){
				echo $this->i.$this->city[$this->i].$city."其他城市<br>";
				return;
			}
			echo "写入\n";
			$sql = "INSERT INTO `{$city}`(`jobName`,`type`,`href`,`monthMoney`,`needPeople`,`eduRequire`,`expRequire`,`area_a`,`area_b`,`area_c`,`place`,`conditions`,`manager_name`,`phoneNumber`,`main`,`info_main`,`company_name`,`company_href`,`company_info1`,`company_info2`,`company_info3`)values('{$title}','{$type}','{$url}','{$money}','{$quantity}','{$xueli}','{$jingyan}','{$area_a}','{$area_b}','{$area_c}','{$address}','{$fuli}','{$manager}','{$phone}','{$introduce}','{$comp_introd}','{$company}','{$comp_link}','{$renzheng1}','{$renzheng2}','{$renzheng3}')";
			mysqli_query($this->db,$sql);

			$sql = "INSERT INTO `job`(`jobName`,`type`,`href`,`monthMoney`,`needPeople`,`eduRequire`,`expRequire`,`area_a`,`area_b`,`area_c`,`place`,`conditions`,`manager_name`,`phoneNumber`,`main`,`info_main`,`company_name`,`company_href`,`company_info1`,`company_info2`,`company_info3`)values('{$title}','{$type}','{$url}','{$money}','{$quantity}','{$xueli}','{$jingyan}','{$area_a}','{$area_b}','{$area_c}','{$address}','{$fuli}','{$manager}','{$phone}','{$introduce}','{$comp_introd}','{$company}','{$comp_link}','{$renzheng1}','{$renzheng2}','{$renzheng3}')";
			mysqli_query($this->db,$sql);
			// echo $type."<br>";
			echo $title."\n";
			// echo $money."<br>";
			// echo $fuli."<br>";
			// echo $quantity."<br>";
			// echo $xueli."<br>";
			// echo $jingyan."<br>";
			// echo $area_a."<br>";
			// echo $area_b."<br>";
			// echo $area_c."<br>";
			// echo $address."<br>";
			// echo $introduce."<br>";
			// echo $comp_introd."<br>";
			// echo $company."<br>";
			// echo $comp_link."<br>";
			// echo $renzheng1."<br>";
			// echo $renzheng2."<br>";
			// echo $renzheng3."<br>";
			// echo "联系人".$manager;
			// echo "电话".$phone."<br>";
			// echo "<br>";
			// echo $sql."\n";
		}
		public function save($city){
			if($city == "bj")return "北京";
			else if($city == "sh")return "上海";
			else if($city == "gz")return "广州";
			else if($city == "sz")return "深圳";
			else if($city == "tj")return "天津";
			else if($city == "hz")return "杭州";
			else if($city == "nj")return "南京";
			else if($city == "jn")return "济南";
			else if($city == "cq")return "重庆";
			else if($city == "qd")return "青岛";
			else if($city == "dl")return "大连";
			else if($city == "nb")return "宁波";
			else if($city == "wh")return "武汉";
			else if($city == "hrb")return "哈尔滨";
			else if($city == "sy")return "沈阳";
			else if($city == "xa")return "西安";
			else if($city == "cc")return "长春";
			else if($city == "fz")return "福州";
			else if($city == "zz")return "郑州";
			else if($city == "sjz")return "石家庄";
			else if($city == "su")return "苏州";
			else if($city == "fs")return "佛山";
			else if($city == "dg")return "东莞";
			else if($city == "wx")return "无锡";
			else if($city == "yt")return "烟台";
			else if($city == "ty")return "太原";
			else if($city == "hf")return "合肥";
			else if($city == "nc")return "南昌";
			else if($city == "nn")return "南宁";
			else if($city == "km")return "昆明";
			else if($city == "wz")return "温州";
			else if($city == "ts")return "唐山";
			else return false;
		}
		public function get_comp(&$manager,&$phone,$url){
			echo "电话抓取\n";
			$page = file_get_contents($url);
			$pagedata = phpQuery::newDocumentHTML($page);
			$doc = phpQuery::pq("");
			$manager = $doc->find("tr.tr_l4 > td.td_c2")->text();
			$phone = $doc->find("tr.tr_l4 > td.td_c3 > img")->attr("src");
			if($phone == ""){
				$manager = $doc->find("ul.basicMsgListo.basicMsgList.clearfix > li:eq(1)")->text();
				$manager = str_replace("联系人：","",$manager);
				$phone = $doc->find("ul.basicMsgListo.basicMsgList.clearfix > li:eq(3) > img")->attr("src");
				if($phone == ""){
					sleep(3);
					$url = $doc->find("ul.basicMsgListo.basicMsgList.clearfix > li:eq(5) > a")->attr("href");
					if($url == ""){
						echo "公司链接丢失\n";
						return;
					}
					$page = file_get_contents($url);
					$pagedata = phpQuery::newDocumentHTML($page);
					$doc = phpQuery::pq("");
					$phone = $doc->find("div.hotline > em")->text();
				}
				$manager = str_replace(" ","",$manager);
				$phone = str_replace(" ","",$phone);
				$manager = str_replace("
","",$manager);
				$phone = str_replace("
","",$phone);
			}
		}
	}
	$html = new GetHTML("http://%s.58.com/%s/pn%d/");
	$html->islink();
	// $html->get_info("http://bj.58.com/zplvyoujiudian/32854787353798x.shtml?psid=109130452198897266029267413&entinfo=32854787353798_j&ytdzwdetaildj=0&finalCp=000001250000000000000000000000000000_109130452198897266029267413&iuType=j_2&PGTID=0d3025ac-0000-131a-387a-fd0a1e2540c0&ClickID=3");
?>