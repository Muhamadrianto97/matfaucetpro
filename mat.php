<?php
error_reporting(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,($str[1]));
	return $str[0];
}
function getmat($id,$socks){
	$arr = array("\r","	");
	$url = "http://saosdeveloper.club/mtc/irw/";
	$h = explode("\n",str_replace($arr,"","Content-Type: application/json; charset=utf-8
	Connection: Keep-Alive
	Accept-Encoding: gzip
	User-Agent: okhttp/3.10.0"));
	$body = "{\"iduser\": $id,\"reward\": \"45c48cce2e2d7fbdea1afc51c7c6ad2611\"}";
	return curl($url,$h,$body,$socks);
}
function curl($url,$h,$body,$socks){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_PROXY, $socks);
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch);
	curl_close($ch);
	return json_decode($x,true);
}
echo "#################\n#  @muhtoevill  #\n#   SGB-Team    #\n#################\n";
echo "Socks File: ";
$file = trim(fgets(STDIN));
echo "Id Code	 :";
$id = trim(fgets(STDIN));
$socks = explode("\n",str_replace("\r","",file_get_contents($file))); $a=0;
while($a<count($socks)){
	$proxy = $socks[$a];
	sleep(120);
	$submit = getmat($id,$proxy);
	$output = json_encode($submit);
	$notif = getStr($output,'"notif":',',');
	$wallet = getStr($output,'"wallet":','}');
	if(strpos($output,"wallet")==true){
                $text = "Use Proxy $proxy Berhasil $notif  Wallet Anda Sekarang : $wallet Delay 2 menit Credit By:Muhtoevill";
                $text1 = "\033[32m".$text."\033[0m";
            }else{
                $text ="Use Proxy $proxy Socks Die";
                $text1 = "\033[31m".$text."\033[0m";
				$a++;
				}
	echo $text1."\n";
}