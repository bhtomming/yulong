<?php
//require_once(dirname(__FILE__) . '/include/init.php');
require_once(ROOT_PATH . 'include/kernel/library/Http.class.php');
class Weixin{
    //获取微信二维码
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
        //为了提高用户获得access_token概率必须检查结果并重复执行
        do{
            $qr_url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
            $ticks = HTTP::doPost($qr_url,$qr_info,5,'','json');
            $tick_obj = json_decode($ticks);
            $ticket = $tick_obj->ticket;
            if(!isset($tick_obj->ticket)){
                W_log("{$scene_id}用户获取ticket失败！");
                W_log("错误代码是:{$tick_obj->errcode}");
            }
        }while($tick_obj->errcode == '40001' || $tick_obj->errcode == '42001');
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

        //第一次获取二维码需要插入推荐人信息
        $first_query = $GLOBALS['db']->getOne("SELECT `scene_id` FROM `wxch_qr` WHERE `scene_id`='$scene_id'");
        if(empty($first_query)){
            $type='jt';
            $action_name="QR_LIMIT_SCENE";
            $user_name = $GLOBALS['db']->getOne("SELECT `user_name` FROM `ecs_users` WHERE `user_id`='$scene_id'");
            $scene = $user_name;
            $url=$_SERVER['HTTP_HOST'];
            $surl="http://".$url.'/'.$img_path;
            $affiliate = '&u=' . $scene_id;
            //将生成的二维码图片的地址放到数据库中
            $insert_sql = "INSERT INTO `wxch_qr` (`type`,`action_name`,`ticket`, `scene_id`, `scene` ,`qr_path`,`function`,`affiliate`,`endtime`,`dateline`) VALUES
                                ('$type','$action_name', '$ticket','$scene_id', '$scene' ,'$surl','0','$affiliate',0,0)";
            $GLOBALS['db']->query($insert_sql);
        }

        return $img_path;
    }

    public function get_token(){ //获取access_token
        $wx = $GLOBALS['db']->getRow("SELECT * FROM wxch_config WHERE id= 1");
        $access_token = $wx['access_token'];
        if($wx['updated']<= time()){
            //$wx = $GLOBALS['db']->getRow("SELECT * FROM wxch_config");
            $wxpay_appid = $wx['appid'];
            $wxpay_appsecret = $wx['appsecret'];
            $url_token1 = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$wxpay_appid.'&secret='.$wxpay_appsecret;
            $data_token1 = Http::doGet($url_token1);
            $token1 = json_decode($data_token1);
            if (!isset($token1->access_token)){
                W_log('获取微信token失败');
                W_log("错误代码是:{$token1->errcode}");
            }
            $access_token = $token1->access_token;
            $time = time() + $token1->expires_in - 100;
            $sql = "UPDATE wxch_config SET access_token='$access_token', updated = $time WHERE id=1";
            $GLOBALS['db']->query($sql);
        }
        return $access_token;
    }
}
?>