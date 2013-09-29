<?php

class sms {

// private portion

private $sms_handle;

private function post($url, $data, $r=false) {

$this->sms_handle=curl_init($url);

if( ! file_exists("cookie.txt")) {
$file=fopen("cookie.txt", 'w'); fclose($file);
}

curl_setopt($this->sms_handle, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($this->sms_handle, CURLOPT_COOKIEJAR, "cookie.txt");

curl_setopt($this->sms_handle, CURLOPT_ENCODING, "gzip");

curl_setopt($this->sms_handle, CURLOPT_FOLLOWLOCATION, true);

curl_setopt($this->sms_handle, CURLOPT_HEADER, true);
curl_setopt($this->sms_handle, CURLOPT_HTTPHEADER, array("Connection: Keep-Alive", "Content-type: application/x-www-form-urlencoded", "Keep-Alive: 300"));

curl_setopt($this->sms_handle, CURLOPT_POST, true);
curl_setopt($this->sms_handle, CURLOPT_POSTFIELDS, $data);

if($r) curl_setopt($this->sms_handle, CURLOPT_REFERER, $r);

curl_setopt($this->sms_handle, CURLOPT_RETURNTRANSFER, true);

curl_setopt($this->sms_handle, CURLOPT_SSL_VERIFYHOST, 2);

curl_setopt($this->sms_handle, CURLOPT_USERAGENT, "iPhone 4.0");

$return=curl_exec($this->sms_handle);

curl_close($this->sms_handle);

return $return;

}

// public portion

public function fullonsms($id, $password, $m_number, $data) {

if(is_numeric($id) && strlen($id)==10)
$out=$this->post("http://www.fullonsms.com/login.php", "MobileNoLogin=".$id."&LoginPassword=".$password);

if(is_numeric($m_number) && strlen($m_number)==10 && strlen($data)<=160)
$out=$this->post("http://www.fullonsms.com/home.php", "MobileNos=".$m_number."&Message=".urlencode($data));

if(file_exists('cookie.txt')) unlink('cookie.txt');

}

}

?>