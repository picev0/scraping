<?php
require_once("./phpQuery-onefile.php");
$file = fopen("data.csv", "w");

for($p = 1; $p < 5; $p++){
	$html = file_get_contents("http://www.sej.co.jp/i/products/thisweek/kyushu/");
	$title_num = count(phpQuery::newDocument($html)->find("div")->find(".itemName"));
	var_dump($title_num);
	for($i=0; $i<$title_num; $i++){
		$title[$p][$i] = phpQuery::newDocument($html)->find("div")->find(".itemName:eq($i)")->text();
		$price[$p][$i] = phpQuery::newDocument($html)->find("li")->find(".price:eq($i)")->text();
		var_dump($price);
		fputs($file, $title[$p][$i].", ".$price[$p][$i]."\n");
	}
	sleep(3);
}

fclose($file);