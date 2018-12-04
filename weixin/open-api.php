<?php
//require_once(dirname(__FILE__) . '/include/init.php');
require_once(ROOT_PATH . 'include/kernel/library/Http.class.php');
class Weixin{
    public function get_wx_user_qrcode($scene_id){
        $qr_info = array(
            'action_name' => 'QR_LIMIT_SCENE',
            "action_info"=>array(
                "scene" => array(
                    "scene_id"=> $scene_id
                )
            )
        );
        $token = $this->get_token();
        $qr_url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
        $ticks = HTTP::doPost($qr_url,$qr_info,5,'','json');
        $tick_obj = json_decode($ticks);
        $ticket = $tick_obj->ticket;
        if(!isset($tick_obj->ticket)){
            W_log("{$scene_id}用户获取ticket失败！");
            W_log("错误代码是:{$tick_obj->errcode}");
        }
        $header = "Accept-Ranges:bytes";
        $header .= "Cache-control:max-age=604800";
        $header .= "Connection:keep-alive";
        $header .= "Content-Type:image/jpg";
        $code_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;
        $qr_code = HTTP::doGet($code_url,5,$header);
        if(empty($qr_code)){
            W_log("获取用户推广二维码失败！");
        }
        $img_path = "qrcode/scene/{$scene_id}.jpg";
        $path = ROOT_PATH .$img_path;
        $qr_file = fopen($path,'wb');
        fwrite($qr_file,$qr_code);
        fclose($qr_file);
        return $img_path;
    }

    public function get_token(){ //获取access_token
        $wx = $GLOBALS['db']->getRow("SELECT access_token,updated FROM wxch_config WHERE id=1");
        $access_token = $wx['access_token'];
        if($wx['updated']<= time()){
            $wx = $GLOBALS['db']->getRow("SELECT * FROM wxch_config");
            $wxpay_appid = $wx['appid'];
            $wxpay_appsecret = $wx['appsecret'];
            $url_token1 = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wxpay_appid.'&secret='.$wxpay_appsecret;
            $data_token1 = Http::doGet($url_token1);
            $token1 = json_decode($data_token1);
            $access_token = $token1->access_token;
            if (!isset($token1->access_token)){
                W_log('获取微信token失败');
                W_log("错误代码是:{$token1->errcode}");
            }
            $time = time() + $token1->expires_in;
            $sql = "UPDATE wxch_config SET access_token='{$access_token}', updated = $time WHERE id=1";
            $GLOBALS['db']->query($sql);
        }
        W_log(time());
        return $access_token;
    }
}
?>