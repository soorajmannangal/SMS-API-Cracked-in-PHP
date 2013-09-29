<?php
$a = set_time_limit(0);
include_once 'class.sms.php';
$sms=new sms();
$msg = $_GET['msg'];
$msg = urldecode($msg);
$m_num = substr($msg, 0, 10);
$msg = substr($msg,10); 
if(isset($m_num) && isset($msg))
   $sms->fullonsms("9037223519", "suith", $m_num, $msg);
sleep(7);

?>
