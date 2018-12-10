<?php
error_reporting(0);
function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,($str[1]));
	return $str[0];
}
function getmat($id,$socks){
	$arr = array("\r","	");
	$url = "http://saosdeveloper.club/mtc/intrewardv2.php?id=".$id."&reward=a87ff679a2f3e71d9181a67b7542122c";
	$h = explode("\n",str_replace($arr,"","Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
	User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0
	Accept-Language: id,en-US;q=0.7,en;q=0.3
	Accept-Encoding: gzip, deflate
	Host: saosdeveloper.club
	Connection: Keep-Alive
	Upgrade-Insecure-Requests: 1"));
	return curl($url,$h,$socks);
}
function curl($url,$h,$socks){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_PROXY, $socks);
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$x = curl_exec($ch); 
	curl_close($ch);
	return json_decode($x,true);
	//var_dump($x);
	//exit();
}
echo "#################\n#  @muhtoevill  #\n#   SGB-Team    #\n#################\n";
echo "Socsk File: ";
$file = trim(fgets(STDIN));
echo "Id Code	 :";
$id = trim(fgets(STDIN));
echo "Berapa Kali :";
$loop = trim(fgets(STDIN));
for ($i=1; $i <= $loop; $i++){
$socks = explode("\n",str_replace("\r","",file_get_contents($file))); $a=0;
while($a<count($socks)){
	$proxy = $socks[$a];
	$submit = getmat($id,$proxy);
	$output = json_encode($submit);
	$notif = getStr($output,'"notif":',',');
	$wallet = getStr($output,'"wallet":','}');
	if(strpos($output,"wallet")==true){
                $text = "Use Proxy $proxy Berhasil $notif  Wallet Anda Sekarang : $wallet Credit By:Muhtoevill";
                $text1 = "\033[32m".$text."\033[0m";
            }else{
                $text ="Use Proxy $proxy Socks Die";
                $text1 = "\033[31m".$text."\033[0m";
				$a++;
                
        }
	echo $text1."\n";
}
}