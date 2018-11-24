<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23 0023
 * Time: 下午 2:45
 */
define('IN_ECS', true);
define('IN_ECTOUCH', true);



require(dirname(__FILE__) . '/include/init.php');
require(ROOT_PATH . 'include/lib_payment.php');

//LHF start 同步数据  测试回调数据

function log_w($file,$txt){
    $fp =  fopen($file,'a+');
    fwrite($fp,''.local_date('Y-m-d H:i:s').'------'.__FILE__);
    fwrite($fp,$txt);
    fwrite($fp,"\r\n\r\n\r\n");
    fclose($fp);
}
$file = ROOT_PATH.'/data/wx_new_log.txt';


$txt = 'REQUEST 参数：'. print_r($_REQUEST,true);
log_w($file,$txt);

//LHF  end

require_once(ROOT_PATH .'include/modules/payment/wx_new_jspay.php');
//$payment = new wx_new_qrcode();

$payment = new wx_new_jspay();

$txt = __LINE__.' payment 参数：'. print_r($payment,true);
log_w($file,$txt);

$payment->respond();
exit;