<?php
class wechatCallbackapi {

	public function valid($db) {
		$echoStr = $_GET["echostr"];
		if ($this -> checkSignature($db)) {
			W_log('验证成功: ' .$echoStr);
			ob_clean();
			echo $echoStr;
		} 
	} 
	public function msgError($error) {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (isset($postStr)) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj -> FromUserName;
			$msgType = $postObj -> MsgType;
			$toUsername = $postObj -> ToUserName;
			if($msgType=="voice"){
				$keyword = trim($postObj -> Recognition);
			}else{
				$keyword = trim($postObj -> Content);
			}
			$time = time();
			$textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
			$contentStr = $error;
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		} 
	} 
	public function responseMsg($db, $user, $base_url)
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$debug = 0;
		if ($_GET['debug'] == 1) {
			$debug = 1;
		} 
		if ($_GET['de_base']) {
			$de_base = 1;
		}
		foreach ($_GET as $k=>$v)
        {
            W_log('responseMsg ' .$k .' => '.$v);
       }
       W_log('$postStr length : ' . strlen($postStr) .' ;$debug : '.$debug);


		if (!empty($postStr) or $debug == 1)
		{
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj -> FromUserName;
			$msgType = $postObj -> MsgType;
			$toUsername = $postObj -> ToUserName;
			$keyword = trim($postObj -> Content);

			if (empty($keyword)) {
				$keyword = $_GET['keyword'];
			} 
			if (empty($fromUsername)) {
				if ($_GET['wxid']) {
					$fromUsername = $_GET['wxid'];
				} else {
					$fromUsername = 'oIM-ajhetL3OwUfIm2DNgC1pW9Uk';
				} 
			} 
			$textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
			$time = time();
			$lang = array();
			$setp = $db -> getOne("SELECT `setp` FROM `wxch_user` WHERE `wxid` = '$fromUsername'");
			if ($setp == 2 or $setp == 3 or $setp == 10) {
				$uname = $db -> getOne("SELECT `uname` FROM `wxch_user` WHERE `wxid` = '$fromUsername'");
			} 
			if (empty($uname)) {
				$postfix = '&wxid=' . $fromUsername;
			} else {
				$ret['wxid'] = $db -> getOne("SELECT `wxid` FROM `wxch_user` WHERE `wxid` = '$fromUsername'");
				$postfix = '&wxid=' . $ret['wxid'];
			} 
			//读取配置参数start
			$m_ret = $db -> getRow("SELECT * FROM  `wxch_cfg` WHERE `cfg_name` = 'murl'");
			$base_ret = $db -> getRow("SELECT * FROM  `wxch_cfg` WHERE `cfg_name` = 'baseurl'");
			$imgpath_ret = $db -> getRow("SELECT * FROM  `wxch_cfg` WHERE `cfg_name` = 'imgpath'");
			$plustj_ret = $db -> getRow("SELECT * FROM  `wxch_cfg` WHERE `cfg_name` = 'plustj'");
			$cxbd = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'cxbd'");
			$oauth_state = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'oauth'");
			$goods_is_ret = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'goods'");
			$article_url = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'article'");
			$q_name = $db -> getOne("SELECT `autoreg_name` FROM `wxch_autoreg` WHERE `autoreg_id` = 1");
			//读取配置参数start
			
			
			if(empty($q_name)){
				$q_name="weixin";
			}
			//查找推荐人ID
			$affiliate_id = $db -> getOne("SELECT `affiliate` FROM `wxch_user` WHERE `wxid` = '$fromUsername'");
			if ($affiliate_id >= 1) { //存在推荐人
				$affiliate = '&u=' . $affiliate_id;
			} 
			if ($goods_is_ret == 'false') {
				$goods_is = ' AND is_delete = 0 AND is_on_sale = 1';
			} else {
				$goods_is = '';
			} 
			$plustj = $plustj_ret['cfg_value'];
			//查询网络主体，目前没有使用。
			$wxch_bd = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'bd'");
			if (empty($base_ret['cfg_value'])) {
				$m_url = $base_url . $m_ret['cfg_value'];
			} else {
				$m_url = $base_ret['cfg_value'] . $m_ret['cfg_value'];
				$base_url = $base_ret['cfg_value'];
			} 
			if ($de_base) {
				echo $base_url;
			} 
			$img_path = $imgpath_ret['cfg_value'];
			$base_img_path = $base_url;
			if ($img_path == 'local') {
				$img_murl = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'murl'");
				if (empty($img_murl)) {
					$temp_img_arr = explode('.', $base_ret['cfg_value']);
					$temp_do = array('http://m', 'http://mobile');
					if (in_array($temp_img_arr[0], $temp_do)) {
						$base_img_path = 'http://www.' . $temp_img_arr[1] . '.' . $temp_img_arr[2];
					} 
				}
				W_log('murl是:'.$img_murl);
			}  
			$oauth_location = $base_url . '/wechat/oauth/wxch_oauths.php?uri=';
			$thistable = $db -> prefix . 'users';
			$ret = $db -> getRow("SELECT `user_id` FROM `$thistable` WHERE `user_name` ='$uname'");
			
			//甜 心 新增显示会员账号密码
			$user_name=$db -> getOne("SELECT `user_name` FROM `$thistable` WHERE `wxid` ='$fromUsername'");
			$user_password=$db -> getOne("SELECT `password_tianxin` FROM `$thistable` WHERE `wxid` ='$fromUsername'");
			//甜心    新增绑定多用户ID

			
			if (!empty($ret['user_id'])) {
				$user_id = $ret['user_id'];
			} 
			$ret = $db -> getRow("SELECT `wxid` FROM `wxch_user` WHERE `wxid` = '$fromUsername'");
			if (empty($ret)) {//新用户加入
				if (!empty($fromUsername)) {
					$db -> query("INSERT INTO `wxch_user` (`subscribe`, `wxid` , `dateline`) VALUES ('1','$fromUsername','$time')");
				} 
			} else {//不是新用户就把用户状态改为关注
				$db -> query("UPDATE  `wxch_user` SET  `subscribe` =  '1',`dateline` = '$time' WHERE  `wxch_user`.`wxid` = '$fromUsername';");
			} 
			$subscribe = 1; //关注状态，目前没有使用
            //保存收到的文本消息,可以是关键词回复
			if ($msgType == 'text') {
				$db -> query("INSERT INTO `wxch_message` (`wxid`, `message`, `dateline`) VALUES( '$fromUsername', '$keyword', $time);");
			} 
			$belong = $db -> insert_id();
			$thistable = $db -> prefix . 'users';
			//查找密码
			$ec_pwd = $db -> getOne("SELECT `cfg_value` FROM `wxch_cfg` WHERE `cfg_name` = 'userpwd'");
			//自动注册值为5
			$autoreg_rand = $db -> getOne("SELECT `autoreg_rand` FROM `wxch_autoreg` WHERE `autoreg_id` = 1");
			//生成长度为5的密码
			$s_mima=$this->randomkeys($autoreg_rand);
			$ec_pwd=$ec_pwd.$s_mima;
			$ec_pwd_no=$ec_pwd;
			$ec_pwd = md5($ec_pwd);//密码加密
			$ret_22 = $db -> getRow("SELECT * FROM `$thistable` WHERE `wxid` = '$fromUsername'");
			//用户名长度等于28时,设置用户级别为99
			if (strlen($ret_22['user_name']) == 28) {
				$sql_del = "UPDATE `$thistable` SET `user_rank` = '99',`wxch_bd`='no' WHERE `wxid` ='$fromUsername'";
				$db -> query($sql_del);
			} 
			$zhanghaoinfo="";//账号信息
            //如果用户名是空的,自动注册
			if (empty($uname)) {
			    W_log('准备自动注册账号');
				$wxch_user_name_sql = "SELECT `user_name` FROM `$thistable` WHERE `wxch_bd`='ok' AND `wxid` = '$fromUsername'";
				$wxch_user_name = $db -> getOne($wxch_user_name_sql);
				$wxch_user_wxid_sql = "SELECT `wxid` FROM `$thistable` WHERE `wxid`=`user_name` AND `wxid` = '$fromUsername'";
				$wxch_user_wxid = $db -> getOne($wxch_user_wxid_sql);
				
				/*甜  心  1  00修复开发*/
				$db->query("UPDATE `wxch_user` SET `setp`= 21,`uname`='$wxch_user_name' WHERE `wxid`= '$fromUsername';");
				/*甜  心  1  00修复开发*/
				if (empty($wxch_user_wxid)) {
				    W_log('没有微信号');
					if (empty($wxch_user_name)) {
					    W_log('没有用户名');
						$wxch_nobd_wxid_sql = "SELECT `wxid` FROM `$thistable` WHERE `wxch_bd`='no' AND `wxid` = '$fromUsername'";
						$wxch_nobd_wxid = $db -> getOne($wxch_nobd_wxid_sql);
						if (empty($wxch_nobd_wxid)) {
						    W_log('微信号是空的');
							if (file_exists('uc_state.php')) {
								include('uc_state.php');
								W_log('加载用户状态文件');
                                if ($uc_state) {
                                    $salt = $uc_salt;
                                    $uc_pwd = $uc_pwd;
                                    $uc_sql = "INSERT INTO $uc_table (`username`, `password`, `salt`) VALUES ('$fromUsername', '$uc_pwd', '$salt')";
                                    $db -> query($uc_sql);
                                    $ecs_user_id = $db -> insert_id();
                                    $uc_username = 'wx' . $ecs_user_id;
                                    $uc_update = "UPDATE $uc_table  SET `username` = '$uc_username' WHERE `uid` = '$ecs_user_id'";
                                    $db -> query($uc_update);
                                    $ecs_password = md5($ecs_password);
                                    $wxch_user_sql = "INSERT INTO `$thistable` (`user_id`,`user_name`,`password`,`wxid`,`user_rank`,`wxch_bd`,`reg_time`) VALUES ('$ecs_user_id','$uc_username','$ecs_password','$fromUsername','99','no','$time')";
                                    $db -> query($wxch_user_sql);
                                    W_log('更新用户状态文件');
                                }
							} else {
							W_log('没有用户状态文件');
								$autoreg_state = $db -> getOne("SELECT `state` FROM `wxch_autoreg` WHERE `autoreg_id` = 1");
								if($autoreg_state){
									$wxch_user_sql = "INSERT INTO `$thistable` ( `user_name`,`password`,`wxid`,`user_rank`,`wxch_bd`,`password_tianxin`,`reg_time`) VALUES ('$fromUsername','$ec_pwd','$fromUsername','99','no','$ec_pwd_no','$time')";
									$db -> query($wxch_user_sql);
									$ecs_user_id = $db -> insert_id();
									$ecs_user_name = $q_name . $ecs_user_id;
									$ecs_update = " UPDATE `$thistable` SET `user_name` = '$ecs_user_name'  WHERE `user_id` = '$ecs_user_id'";
									$db -> query($ecs_update);
									//注册后默认绑定
									$db->query("UPDATE `wxch_user` SET `setp`= 3,`uname`='$ecs_user_name' WHERE `wxid`= '$fromUsername';");
                                        $affiliate_p = $db -> getOne("SELECT `affiliate` FROM `wxch_user` WHERE `wxid`= '$fromUsername'");
                                        if(empty($affiliate_p)){
                                            $affiliate_p=0;
                                        }
                                        else
                                            {
                                            $qu_wxid = "SELECT wxid FROM `ecs_users` WHERE `user_id` = '$affiliate_p'";
                                            $parent_wxid = $db -> getOne($qu_wxid);
                                            $qu_name = "SELECT nickname FROM `wxch_user` WHERE `wxid` = '$parent_wxid'";
                                            $parent_name=$db -> getOne($qu_name);
                                            $tianxin100_t="推荐人：".$parent_name;
                                                                                                    /*甜心100新增扫描关注带提醒*/
                                            $up_uid=$affiliate_p;
                                            require(ROOT_PATH . 'wxch_share.php');
                                        }
									$db->query("UPDATE  ecs_users SET `wxch_bd`='ok',`wxid`='$fromUsername' WHERE `user_name`='$ecs_user_name'");
									$zhanghaoinfo="您的账号：".$ecs_user_name."密码：".$ec_pwd_no.$tianxin100_t;
									W_log('自动注册用户:'.$ecs_user_name);
								}else{
									$zhanghaoinfo="自动注册功能未开启！";
								}
							} 
						} 
					} 
				}
				else {
				    W_log('更新用户级别信息');
					$wxch_user_sql = " UPDATE `$thistable` SET `user_rank` = '99',`wxch_bd`='no' WHERE `wxid` ='$fromUsername'";
					$db -> query($wxch_user_sql);
				} 
			}
			
			/*甜心  100  兼容推荐链接成为下线功能Start*/
			//查找上级ID
			$u_parent_id = $db -> getOne("SELECT `parent_id` FROM `ecs_users` WHERE `wxid`= '$fromUsername'");
			//查找上级销售员ID
			$sales1_id = $db -> getOne("SELECT `sales1_id` FROM `ecs_users` WHERE `wxid`= '$fromUsername'");
			//如果没有上级或没有销售员
			if(empty($u_parent_id)||empty($sales1_id)){
			    W_log('查找推荐人当中...');
			    //查找推荐人
				$affiliate_p = $db -> getOne("SELECT `affiliate` FROM `wxch_user` WHERE `wxid`= '$fromUsername'");
				//没有推荐人
				if(empty($affiliate_p)){
					$affiliate_p=0;
                    W_log('没有推荐人');
				}else{
                    W_log('推荐人是:'.$affiliate_p);
				    //有推荐人,查找推荐人微信ID
					$qu_wxid = "SELECT wxid FROM `ecs_users` WHERE `user_id` = '$affiliate_p'";
					//如果存在推荐人微信ID,找出该推荐的4级推荐人,并设置用户的推荐人
					if(!empty($qu_wxid)){
						$sales2_sql="SELECT * FROM `ecs_users` WHERE `user_id` = '$affiliate_p'";
						$sales2info=$db -> getRow($sales2_sql);	
						$sales2_id=$sales2info['sales1_id'];
						$sales3_id=$sales2info['sales2_id'];
						$sales4_id=$sales2info['sales3_id'];
						$sales5_id=$sales2info['sales4_id'];
						$sql ="UPDATE ecs_users SET sales1_id = '$affiliate_p',parent_id = '$affiliate_p',sales2_id = '$sales2_id',sales3_id='$sales3_id',sales4_id='$sales4_id',sales5_id='$sales5_id'   WHERE `wxid` = '$fromUsername';";
						$db -> query($sql);						
					}
				}
			}
			/*甜心  100  兼容推荐链接成为下线功能END*/

			$newsTpl = "<xml>
                         <ToUserName><![CDATA[%s]]></ToUserName>
                         <FromUserName><![CDATA[%s]]></FromUserName>
                         <CreateTime>%s</CreateTime>
                         <MsgType><![CDATA[%s]]></MsgType>
                         <ArticleCount>%s</ArticleCount>
                         <Articles>
                         %s
                         </Articles>
                         <FuncFlag>0</FuncFlag>
                         </xml>";
			$serviceTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        </xml>";
			$imageTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
			$voiceTpl = "<xml>
                            <ToUserName><![CDATA[toUser]]></ToUserName>
                            <FromUserName><![CDATA[fromUser]]></FromUserName>
                            <CreateTime>12345678</CreateTime>
                            <MsgType><![CDATA[voice]]></MsgType>
                            <Voice>
                            <MediaId><![CDATA[media_id]]></MediaId>
                            </Voice>
                            </xml>";
			W_log(__LINE__ .'$postObj -> Event : '. $postObj -> Event );

            W_log(__LINE__ .'$postObj -> EventKey : '. $postObj -> EventKey );


            //如果是关注事件
			if ($postObj -> Event == 'subscribe') {//微信发送过来为关注事件时
			    W_log($fromUsername.'关注公众号事件');
			    //判断微信发来消息没有关键词，没有就设置，有就用关键词.
				if (strlen($postObj -> EventKey) == 0) {
					$ret = $db -> getRow("SELECT `type_id` FROM  `wxch_coupon` WHERE `id` = 1");
					if ($ret['type_id'] >= 1) {
					    //关注送红包
						$postObj -> EventKey = 'gzyhj';
					} else {
						//$postObj -> EventKey = 'subscribe';
						$postObj -> EventKey = 'wifi';
					}
				} else {
					$qrscene = $postObj -> EventKey;
					$scene_id_arr = explode("qrscene_", $qrscene);
					$scene_id = $scene_id_arr[1];
					$db -> query("UPDATE `wxch_qr` SET `subscribe`=`subscribe` + 1 WHERE `scene_id`= '$scene_id';");
					$scan_ret = $db -> getRow("SELECT * FROM `wxch_qr` WHERE scene_id =$scene_id");
					$tianxin_users = $db -> getRow("SELECT * FROM `ecs_users` WHERE user_id =$scene_id");
					if(!empty($tianxin_users)){
						$postObj -> EventKey = 'affiliate_推荐成功_' . $scene_id;
					} else {
						$postObj -> EventKey = $scan_ret['function'];
					} 
				} 
			}
			//取消关注事件
			elseif ($postObj -> Event == 'unsubscribe') {
				$db -> query("UPDATE  `wxch_user` SET  `subscribe` =  '0' WHERE  `wxch_user`.`wxid` = '$fromUsername';");
				//$subscribe = 0; 没有用的变量
				W_log($fromUsername.'取消关注');
				exit();
			}
			//扫码事件
			elseif ($postObj -> Event == 'SCAN') {
                W_log($fromUsername.'扫描推荐码');
                W_log('推荐码的值是:'.$postObj -> EventKey);
				$qrscene = $postObj -> EventKey;
				$scene_id = $qrscene;
				$update_sql = "UPDATE `wxch_qr` SET `scan`=`scan` + 1 WHERE `scene_id`= '$scene_id';";
				$db -> query("$update_sql");				
				$scan_ret = $db -> getRow("SELECT * FROM `wxch_qr` WHERE scene_id =$scene_id");
				if ($scan_ret['affiliate'] >= 1) {
					$postObj -> EventKey = 'affiliate_推荐成功_' . $scan_ret['affiliate'];
				} else {
						$msgType = "text";
						$contentStr = '推荐失败，找不到推荐人ID为'. $scene_id."的推荐人";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						$this -> universal($fromUsername, $base_url);
						$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
						echo $resultStr;
						exit;
				} 
			}

            W_log(__LINE__ .'$postObj -> MsgType : '. $postObj -> MsgType );

			if ($postObj -> MsgType == 'event') {
				$keyword = $postObj -> EventKey;
				$menu_message = 'menu:' . $keyword;
                W_log('进入到事件处理,时$keyword:'.$keyword);
                W_log('进入到事件处理,添加一个menu_message:'.$menu_message);
				$db -> query("INSERT INTO `wxch_message` (`wxid`, `message`, `dateline`) VALUES( '$fromUsername', '$menu_message', $time);");
			}

			if ($postObj -> MsgType == 'voice') {
				$keyword = $postObj -> Recognition;
				$menu_message = 'voice:' . $keyword;
				$db -> query("INSERT INTO `wxch_message` (`wxid`, `message`, `dateline`) VALUES( '$fromUsername', '$menu_message', $time);");
			}

			$wxch_table = 'wxch_msg';
			//查询消息表格，目前这个表格没有值
			$wxch_msg = $db -> getAll("SELECT * FROM  `$wxch_table`");
			foreach($wxch_msg as $k => $v) {
				$commands[$k] = $v;
			} 
			foreach($commands as $kk => $vv) {
				$temp_msg = explode(" ", $vv['command']);
				if (in_array($keyword, $temp_msg)) {
					$keyword = $vv['function'];
				} 
			}
			/*判断关键字，调用系统内置函数End*/
            W_log(__LINE__ .'$keyword: ' . $keyword );
			//用户设置关键字回复，图文或则文本,自动回复功能
			$this -> getauto($db, $keyword, $textTpl, $newsTpl, $base_url, $m_url, $fromUsername, $toUsername, $time, $article_url);
			
			//多客服触发
			if ($keyword == 'kefu') {
				//$access_token = $db->getOne("SELECT `access_token` FROM `wxch_config` ");
                $access_token = $this->access_token($db);
                echo $this->kefureturn($access_token, $fromUsername);
				$msgType = "transfer_customer_service";
				$contentStr = '客服转接';
				$resultStr = sprintf($serviceTpl, $fromUsername, $toUsername, $time, $msgType);
				$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			//甜心100修复绑定上下级关系		
			$aff_arr = explode('_', $keyword);
			if ($aff_arr[0] == 'affiliate') {
				if (!empty($aff_arr[2])) {
					//ID有效
					$aff_query = "SELECT * FROM `ecs_users` WHERE `user_id` = $aff_arr[2]";
					$aff_db = $db -> getRow($aff_query);
					$flagetianxin100=true;
					if($aff_db['wxid']==$fromUsername){
							$flagetianxin100=false;
					}else{
							$flagetianxin100=true;
					}
					//1:上下级关系绑定不能改变
					$aff_query = "SELECT parent_id FROM `ecs_users` WHERE `wxid` = '$fromUsername'";
					$parent_id = $db -> getOne($aff_query);
					//2:验证上下级关系
					//找出自己所有的下级
					$aff_query = "SELECT user_id FROM `ecs_users` WHERE `wxid` = '$fromUsername'";
					$user_id = $db -> getOne($aff_query);
					$sql="SELECT * FROM  ecs_users  WHERE parent_id = '$user_id'";	
					$childinfo=$GLOBALS['db']->GetAll($sql);
					
					$flag=true;
					if(!empty($childinfo)){
						$flag=false;
					}else{
						$flag=true;
					}
					if(empty($parent_id)){
						if (!empty($aff_db)&&$flag&&$flagetianxin100) {
							//绑定会员账号
							$ecs_usertable = $db -> prefix . 'users';
							$aff_update = "UPDATE `$ecs_usertable` SET `parent_id` = '$aff_arr[2]' WHERE `wxid` = '$fromUsername';";
							$db -> query($aff_update);
							
							$sales2_sql="SELECT * FROM `ecs_users` WHERE `user_id` = '$aff_arr[2]'";
							$sales2info=$db -> getRow($sales2_sql);	
							$sales2_id=$sales2info['sales1_id'];
							$sales3_id=$sales2info['sales2_id'];
							$sales4_id=$sales2info['sales3_id'];
							$sales5_id=$sales2info['sales4_id'];
							$sales6_id=$sales2info['sales5_id'];
							$sales7_id=$sales2info['sales6_id'];
							$sales8_id=$sales2info['sales7_id'];
							$sales9_id=$sales2info['sales8_id'];
							$sql ="UPDATE ecs_users SET sales1_id = '$aff_arr[2]',parent_id = '$aff_arr[2]',sales2_id = '$sales2_id',sales3_id='$sales3_id',sales4_id='$sales4_id',sales5_id='$sales5_id'   WHERE `wxid` = '$fromUsername';";
							$db -> query($sql);
							
							//绑定微信账号
							$wxch_usertable = 'wxch_user';
							$aff_update = "UPDATE `$wxch_usertable` SET `affiliate` = '$aff_arr[2]' WHERE `wxid` = '$fromUsername';";
							$db -> query($aff_update);
							
							//查询上级昵称
							$qu_wxid = "SELECT wxid FROM `ecs_users` WHERE `user_id` = '$aff_arr[2]'";
							$parent_wxid = $db -> getOne($qu_wxid);
							$qu_name = "SELECT nickname FROM `wxch_user` WHERE `wxid` = '$parent_wxid'";
							$parent_name=$db -> getOne($qu_name);
							//查询自己的昵称
							$nick_name_sql = "SELECT nickname FROM `wxch_user` WHERE `wxid` = '$fromUsername'";
							$nick_name = $db -> getOne($nick_name_sql);
							//查询网站有多少会员
							$num_sql = "SELECT COUNT(*) FROM `ecs_users`";
							$num_user = $db -> getOne($num_sql);
							//查询店铺名字
							$sql = "SELECT value FROM `ecs_touch_shop_config` ". " WHERE code='shop_name'";
							$shop_name = $db->getOne($sql);
							/*甜心100新增扫描关注带提醒*/
							$up_uid=$aff_arr[2];
							require(ROOT_PATH . 'wxch_share.php');
							$msgType = "text";
							$contentStr=$nick_name."恭喜您由".$parent_name."推荐成为".$shop_name."的会员！目前已经有【".$num_user."】位掌柜！点击左下角“".$shop_name."”立即购买成为".$shop_name."掌柜，裂变你的代理商，让你每天睡觉都能赚大钱！".$zhanghaoinfo;
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
							$this -> universal($fromUsername, $base_url);
							echo $resultStr;
							exit;						
						}else{
							$msgType = "text";
							$contentStr="错误提示：推荐关系不合法可能情况1：自己不能成为自己的下级2：自己有下级后不能成为别人的下级";
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
							$this -> universal($fromUsername, $base_url);
							echo $resultStr;
							exit;	
						}						
					
					}else{
							//查询上级昵称
							$qu_wxid = "SELECT wxid FROM `ecs_users` WHERE `user_id` = '$parent_id'";
							$parent_wxid = $db -> getOne($qu_wxid);
							$qu_name = "SELECT nickname FROM `wxch_user` WHERE `wxid` = '$parent_wxid'";
							$parent_name = $db -> getOne($qu_name);
							$msgType = "text";
							$contentStr="你已经有上级了哦，您的上级是".$parent_name;
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
							$this -> universal($fromUsername, $base_url);
							echo $resultStr;
							exit;	
					}					
				}  
			}

			if ($keyword == 'bd') {
								
						$bd_url = '<a href="' . $m_url . 'user_wxch.php?wxid=' . $fromUsername . '">点击绑定会员</a>';
						$bd_lang = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'bd'");
						$contentStr = $bd_url . $bd_lang . '';
						$contentStr=$contentStr.$m_url;
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						$this -> plusPoint($db, $uname, $keyword, $fromUsername);
						$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
						$this -> universal($fromUsername, $base_url);
						echo $resultStr;
						exit;
					
			}
			elseif ($keyword == 'cxsc') {
				$msgType = "text";
				$re = $db -> query("delete from wxch_qr_tianxin100 where scene = "."(select uname from wxch_user where `wxid`= '$fromUsername')");
				if ($re) {
					$contentStr = '推广二维码重置成功';
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url, $keyword);
					exit;
				} else {
					$contentStr = '推广二维码重置失败';
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url, $keyword);
					exit;
				} 
			}
			elseif ($keyword == 'news') {
				$thistable = $db -> prefix . 'goods';
				$query_sql = "SELECT * FROM  `$thistable` WHERE `is_new` = 1 $goods_is ORDER BY sort_order, last_update DESC  LIMIT 0 , 6 ";
				$ret = $db -> getAll($query_sql);
				$ArticleCount = count($ret);
				$items = '';
				if ($ArticleCount >= 1) {
					foreach($ret as $v) {
						if ($img_path == 'local') {
							$v['thumbnail_pic'] = $base_img_path . $v['goods_img'];
						} elseif ($img_path == 'server') {
							$v['thumbnail_pic'] = $v['goods_img'];
						} 
						if ($oauth_state == 'true') {
							$goods_url = $oauth_location . $m_url . 'goods.php?id=' . $v['goods_id'] . $affiliate;
						} elseif ($oauth_state == 'false') {
							$goods_url = $m_url . 'goods.php?id=' . $v['goods_id'] . $postfix . $affiliate;
						}
						W_log('图片链接:'.$v['thumbnail_pic']);
						$items .= "<item>
                 <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
                 <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
                 <Url><![CDATA[" . $goods_url . "]]></Url>
                 </item>";
					} 
					$msgType = "news";
				} 
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'best') {
				$thistable = $db -> prefix . 'goods';
				$query_sql = "SELECT * FROM  `$thistable` WHERE `is_best` = 1 $goods_is ORDER BY sort_order, last_update DESC  LIMIT 0 , 6 ";
				$ret = $db -> getAll($query_sql);
				$ArticleCount = count($ret);
				$items = '';
				if ($ArticleCount >= 1) {
					foreach($ret as $v) {
						if ($img_path == 'local') {
							$v['thumbnail_pic'] = $base_img_path . $v['goods_img'];
						} elseif ($img_path == 'server') {
							$v['thumbnail_pic'] = $v['goods_img'];
						} 
						if ($oauth_state == 'true') {
							$goods_url = $oauth_location . $m_url . 'goods.php?id=' . $v['goods_id'] . $affiliate;
						} elseif ($oauth_state == 'false') {
							$goods_url = $m_url . 'goods.php?id=' . $v['goods_id'] . $postfix . $affiliate;
						} 
						$items .= "<item>
                 <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
                 <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
                 <Url><![CDATA[" . $goods_url . "]]></Url>
                 </item>";
					} 
					$msgType = "news";
				} 
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'hot') {
				$thistable = $db -> prefix . 'goods';
				$ret = $db -> getAll("SELECT * FROM  `$thistable` WHERE `is_hot` = 1 $goods_is ORDER BY sort_order, last_update DESC  LIMIT 0 , 6 ");
				$ArticleCount = count($ret);
				$items = '';
				if ($ArticleCount >= 1) {
					foreach($ret as $v) {
						if ($img_path == 'local') {
							$v['thumbnail_pic'] = $base_img_path . $v['goods_img'];
						} elseif ($img_path == 'server') {
							$v['thumbnail_pic'] = $v['goods_img'];
						} 
						if ($oauth_state == 'true') {
							$goods_url = $oauth_location . $m_url . 'goods.php?id=' . $v['goods_id'] . $affiliate;
						} elseif ($oauth_state == 'false') {
							$goods_url = $m_url . 'goods.php?id=' . $v['goods_id'] . $postfix . $affiliate;
						}
						W_log('图片链接'.$v['thumbnail_pic']);
						$items .= "<item>
                 <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
                 <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
                 <Url><![CDATA[" . $goods_url . "]]></Url>
                 </item>";
					} 
					$msgType = "news";
				} 
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'tuijian') {
				$thistable = $db -> prefix . 'article';
				$query_sql = "SELECT * FROM  `$thistable` WHERE `is_tuijian` = 1  ORDER BY add_time DESC  LIMIT 0 , 6 ";
				$ret = $db -> getAll($query_sql);
				$ArticleCount = count($ret);
				$items = '';
				if ($ArticleCount >= 1) {
					foreach($ret as $v) {

						if ($oauth_state == 'true') {
							$article_url = $oauth_location . $m_url . 'article.php?id=' . $v['article_id'] . $affiliate;
						} elseif ($oauth_state == 'false') {
							$article_url = $m_url . 'article.php?id=' . $v['article_id'] . $postfix . $affiliate;
						} 
						$items .= "<item>
                 <Title><![CDATA[" . $v['title'] ."]]></Title>
                 <PicUrl><![CDATA[" .$m_url.'../'. $v['file_url'] . "]]></PicUrl>
                 <Url><![CDATA[" . $article_url . "]]></Url>
                 </item>";
					} 
					$msgType = "news";
				} 
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'jfcx') {
				$thistable = $db -> prefix . 'users';
				$sql = "SELECT * FROM `$thistable` WHERE `wxid` = '$fromUsername'";
				$ret = $db -> getAll($sql);
				if (count($ret) >= 2) {
					foreach($ret as $v) {
						if ($v['wxch_bd'] == 'ok') {
							$pay_points = $v['pay_points'];
							$money = $v['user_money'];
						} 
					} 
				} 
				if (empty($pay_points)) {
					$pay_points = $ret[0]['pay_points'];
					$money = $ret[0]['user_money'];
				} 
				$msgType = "text";
				$contentStr = "余额：$money\r\n积分：$pay_points";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'ddlb') {
				$msgType = "text";
				$thistable = $db -> prefix . 'order_info';
				if ($setp == 3) {
					$table2 = $db -> prefix . 'users';
					$user_id = $db -> getOne("SELECT `user_id` FROM `$table2` WHERE `wxch_bd` = 'ok' AND `wxid` ='$fromUsername'");
				}
				else
				{
					$table2 = $db -> prefix . 'users';
					$user_id = $db -> getOne("SELECT `user_id` FROM `$table2` WHERE `wxch_bd` = 'no' AND `wxid` ='$fromUsername'");
				} 
				$orders = $db -> getAll("SELECT * FROM `$thistable` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC LIMIT 0,5");
				$ArticleCount = count($orders);
				if ($ArticleCount >= 1) {
					$order_goods_tb = $db -> prefix . 'order_goods';
					$items = '';
					foreach($orders as $k => $v) {
						$order_id = $v['order_id'];
						$order_goods = $db -> getAll("SELECT * FROM `$order_goods_tb`  WHERE `order_id` = '$order_id'");
						$shopinfo = '';
						foreach($order_goods as $vv) {
							if (empty($v['goods_attr'])) {
								$shopinfo .= $vv['goods_name'] . '(' . $vv['goods_number'] . '),';
							} else {
								$shopinfo .= $vv['goods_name'] . '（' . $vv['goods_attr'] . '）' . '(' . $vv['goods_number'] . '),';
							} 
						} 
						$shopinfo = substr($shopinfo, 0, strlen($shopinfo)-1);
						if ($k != 0) {
							if ($oauth_state == 'true') {
								$title = "\r\n" . '------------------' . "\r\n" . '订单号：<a href="' . $oauth_location . $m_url . 'user.php?act=order_detail&order_id=' . $v['order_id'] . '">' . $v['order_sn'] . "</a>";
							} elseif ($oauth_state == 'false') {
								$title = "\r\n" . '------------------' . "\r\n" . '订单号：<a href="' . $m_url . 'user.php?act=order_detail&order_id=' . $v['order_id'] . '&wxid=' . $fromUsername . '">' . $v['order_sn'] . "</a>";
							} 
						} else {
							if ($oauth_state == 'true') {
								$title = '订单号：<a href="' . $oauth_location . $m_url . 'user.php?act=order_detail&order_id=' . $v['order_id'] . '">' . $v['order_sn'] . "</a>\r\n";
							} elseif ($oauth_state == 'false') {
								$title = '订单号：<a href="' . $m_url . 'user.php?act=order_detail&order_id=' . $v['order_id'] . '&wxid=' . $fromUsername . '">' . $v['order_sn'] . "</a>\r\n";
							} 
						} 
						if ($v['order_amount'] == 0.00) {
							if ($v['money_paid'] > 0) {
								$v['order_amount'] = $v['money_paid'];
							} 
						} 
						$description = "\r" . '商品信息：' . $shopinfo . "\r总金额：" . $v['order_amount'] . "\r物流公司：" . $v['shipping_name'] . ' 物流单号：' . $v['invoice_no'];
						$items .= $title . $description;
					} 
					if ($oauth_state == 'true') {
						$items_oder_list = '<a href="' . $oauth_location . $m_url . 'user.php?act=order_list">"我的订单"</a>';
					} elseif ($oauth_state == 'false') {
						$items_oder_list = '<a href="' . $m_url . 'user.php?act=order_list&wxid=' . $fromUsername . '">"我的订单"</a>';
					} 
					$items_more = "\r\n" . '更多详细信息请点击' . $items_oder_list . '';
					$contentStr = $items . $items_more;
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> plusPoint($db, $uname, $keyword, $fromUsername);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} else {
					$msgType = "text";
					$contentStr = "您还没有订单";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} 
			}
			elseif ($keyword == 'ddcx') {
				$ArticleCount = 1;
				$msgType = "news";
				$thistable = $db -> prefix . 'order_info';
				$order_goods_tb = $db -> prefix . 'order_goods';
				if ($setp == 3) {
					$table2 = $db -> prefix . 'users';
					$ret = $db -> getRow("SELECT `user_id` FROM `$table2` WHERE `wxch_bd`='ok' AND `wxid` ='$fromUsername'");
					$user_id = $ret['user_id'];
					$orders = $db -> getRow("SELECT * FROM `$thistable` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC");
					$order_id = $orders['order_id'];
					$order_goods = $db -> getAll("SELECT * FROM `$order_goods_tb`  WHERE `order_id` = '$order_id'");
				} else {
					$table2 = $db -> prefix . 'users';
					$ret = $db -> getRow("SELECT `user_id` FROM `$table2` WHERE `wxch_bd`='no' AND `wxid` ='$fromUsername'");
					$user_id = $ret['user_id'];
					$orders = $db -> getRow("SELECT * FROM `$thistable` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC");
					$order_id = $orders['order_id'];
					$order_goods = $db -> getAll("SELECT * FROM `$order_goods_tb`  WHERE `order_id` = '$order_id'");
				} 
				$shopinfo = '';
				if (!empty($order_goods)) {
					foreach($order_goods as $v) {
						if (empty($v['goods_attr'])) {
							$shopinfo .= $v['goods_name'] . '(' . $v['goods_number'] . '),';
						} else {
							$v['goods_attr'] = $this -> guolv($v['goods_attr']);
							$shopinfo .= $v['goods_name'] . '（' . $v['goods_attr'] . '）' . '(' . $v['goods_number'] . '),';
						} 
					} 
					$shopinfo = substr($shopinfo, 0, strlen($shopinfo)-1);
					$title = '订单号：' . $orders['order_sn'];
					if ($orders['pay_status'] == 0) {
						$pay_status = '支付状态：未付款';
					} elseif ($orders['pay_status'] == 1) {
						$pay_status = '支付状态：付款中';
					} elseif ($orders['pay_status'] == 2) {
						$pay_status = '支付状态：已付款';
					} 
					if ($oauth_state == 'true') {
						$url = $oauth_location . $m_url . 'user.php?act=order_detail&order_id=' . $orders['order_id'];
					} elseif ($oauth_state == 'false') {
						$url = $m_url . 'user.php?act=order_detail&order_id=' . $orders['order_id'] . $postfix;
					} 
					if ($orders['order_amount'] == 0.00) {
						if ($orders['money_paid'] > 0) {
							$orders['order_amount'] = $orders['money_paid'];
						} 
					} 
					$description = '商品信息：' . $shopinfo . "\r\n总金额：" . $orders['order_amount'] . "\r\n" . $pay_status . "\r\n快递公司：" . $orders['shipping_name'] . ' 物流单号：' . $orders['invoice_no'];
					$items = "<item>
                 <Title><![CDATA[" . $title . "]]></Title>
                 <Description><![CDATA[" . $description . "]]></Description>
                 <PicUrl><![CDATA[]]></PicUrl>
                 <Url><![CDATA[" . $url . "]]></Url>
                 </item>";
					$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
					$w_message = '图文消息';
					$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
					$this -> plusPoint($db, $uname, $keyword, $fromUsername);
					echo $resultStr;
				} else {
					$msgType = "text";
					$contentStr = "您还没有订单";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> universal($fromUsername, $base_url);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					echo $resultStr;
				} 
				exit;
			}
			elseif ($keyword == 'kdcx')
            {
				$thistable = $db -> prefix . 'order_info';
				$table2 = $db -> prefix . 'users';
				if ($setp == 3) {
					$ret = $db -> getRow("SELECT `user_id` FROM `$table2` WHERE `wxch_bd` = 'ok' AND `wxid` ='$fromUsername'");
					$user_id = $ret['user_id'];
					$orders = $db -> getRow("SELECT * FROM `$thistable` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC");
				} else {
					$ret = $db -> getRow("SELECT `user_id` FROM `$table2` WHERE `wxch_bd` = 'no' AND `wxid` ='$fromUsername'");
					$user_id = $ret['user_id'];
					$orders = $db -> getRow("SELECT * FROM `$thistable` WHERE `user_id` = '$user_id' ORDER BY `order_id` DESC");
				} 
				if (empty($orders)) {
					$msgType = "text";
					$contentStr = '您还没有订单，无法查询快递';
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} 
				if (empty($orders['invoice_no'])) {
					$msgType = "text";
					$contentStr = '订单号：' . $orders['order_sn'] . '还没有快递单号，不能查询';
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} 
				$k_arr = $this -> kuaidi($orders['invoice_no'], $orders['shipping_name']);
				$contents = '';
				$msgType = "text";
				if ($k_arr['message'] == 'ok') {
					$count = count($k_arr['data']) - 1;
					for($i = $count;$i >= 0;$i--) {
						$contents .= "\r\n" . $k_arr['data'][$i]['time'] . "\r\n" . $k_arr['data'][$i]['context'];
					} 
					$contentStr = "订单号：$orders[invoice_no]\r\n" . "快递信息" . $contents;
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> plusPoint($db, $uname, $keyword, $fromUsername);
					$this -> universal($fromUsername, $base_url, $keyword);
					exit;
				} else {
					$contentStr = "没有查到订单号：$orders[invoice_no] 的" . "快递信息";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> plusPoint($db, $uname, $keyword, $fromUsername);
					$this -> universal($fromUsername, $base_url, $keyword);
				} 
				exit;
			}
			elseif ($keyword == 'help' or $keyword == 'HELP') {
				$msgType = "text";
				$lang['help'] = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'help'");
				$contentStr = $lang['help'];
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'dzp') {
				$data = $this -> dzp($db, $base_url, $fromUsername);
				$msgType = "news";
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $data['ArticleCount'], $data['items']);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'getback')
            {
			/*甜   心100   修复   新增找回密码功能 关键字getback*/
				$password_tianxin =  $GLOBALS['db']->getOne("SELECT password_tianxin FROM " . $GLOBALS['ecs']->table('users')."WHERE `wxid` = '$fromUsername'");
				$user_name =  $GLOBALS['db']->getOne("SELECT user_name FROM " . $GLOBALS['ecs']->table('users')."WHERE `wxid` = '$fromUsername'");
				$msgType = "text";
				$contentStr = '您的账号密码是：'.$user_name .'/r/n'.$password_tianxin;
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
			}
			elseif ($keyword == 'login') {
						$bd_url = '<a href="' . $m_url . 'user.php?wxid=' . $fromUsername . '">会员中心</a>';
						$contentStr = $bd_url  . ',（点击进入）';
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						$this -> plusPoint($db, $uname, $keyword, $fromUsername);
						$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
						$this -> universal($fromUsername, $base_url);
						echo $resultStr;
						exit;
			}
			elseif ($keyword == 'zjd') {
				$data = $this -> egg($db, $base_url, $fromUsername);
				$msgType = "news";
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $data['ArticleCount'], $data['items']);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'qrcode') {
			    W_log(__LINE__ . '开始 qrcode 生成') ;
				$affiliate = unserialize($GLOBALS['_CFG_MOBILE']['affiliate']);
				$level_register_up = (float)$affiliate['config']['level_register_up'];
				$rank_points =  $GLOBALS['db']->getOne("SELECT rank_points FROM " . $GLOBALS['ecs']->table('users')."where user_id=".$user_id);
				if($rank_points<$level_register_up){
					$msgType = "text";
					$contentStr = "您还不是分销商，暂时不能获取推广二维码";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> universal($fromUsername, $base_url);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					echo $resultStr;
                    W_log(__LINE__ .$resultStr) ;
					exit;
				}
				$ArticleCount = 1;
				$scene_id = $user_id;
				$affiliate=$user_id;
				//$gourl = $base_url . '/wechat/egg/index1.php?scene_id=' . $scene_id;
                $gourl = $base_url . '/index.php?scene_id=' . $scene_id;
				$type = 'tj';
				$qr_path = $db->getOne("SELECT `qr_path` FROM `wxch_qr` WHERE `scene_id`='$scene_id'");
				$user_name = $db->getOne("SELECT `user_name` FROM `ecs_users` WHERE `user_id`='$scene_id'");


				$scene = $user_name;
                W_log(__LINE__ .'$qr_path ' . $qr_path) ;
				if(!empty($qr_path)){
					 $surl=$qr_path;
				}else{
                    $action_name="QR_LIMIT_SCENE";
                    $json_arr = array('action_name'=>$action_name,'action_info'=>array('scene'=>array('scene_id'=>$scene_id)));
                    $data = json_encode($json_arr);
                    $this -> access_token($db);
                    $ret = $db->getRow("SELECT `access_token` FROM `wxch_config`");
                    $access_token = $ret['access_token'];
                    W_log(__LINE__ . '$access_token'.$access_token) ;
                    if(strlen($access_token) >= 64)
                    {
                        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
                        $res_json =$this -> curl_grab_page($url, $data);
                        $json = json_decode($res_json);
                    }
                    $ticket = $json->ticket;
                    W_log(__LINE__ . '$ticket '.$ticket) ;

                    if($ticket)
                    {
                        $ticket_url = urlencode($ticket);
                        $ticket_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket_url;
                        $imageinfo=$this -> downloadimageformweixin($ticket_url);
                        $time = time();
                        $url=$_SERVER['HTTP_HOST'];
                        $path = '../images/qrcode/'.$time.'.jpg';
                        $surl="http://".$url.'/images/qrcode/'.$time.'.jpg';
                        $local_file=fopen($path,'a');
                        W_log(__LINE__ . '$local_file '.$local_file) ;
                        if(false !==$local_file){

                            if(false !==fwrite($local_file,$imageinfo)){
                                fclose($local_file);
                                //将生成的二维码图片的地址放到数据库中
                                $insert_sql = "INSERT INTO `wxch_qr` (`type`,`action_name`,`ticket`, `scene_id`, `scene` ,`qr_path`,`function`,`affiliate`,`endtime`,`dateline`) VALUES
                                ('$type','$action_name', '$ticket','$scene_id', '$scene' ,'$surl','$function','$affiliate','$endtime','$dateline')";
                                $db->query($insert_sql);
                                W_log(__LINE__ . '$insert_sql '.$insert_sql) ;
                            }

                        }
                    }
                }
                W_log(__LINE__ .'$surl ' . $surl) ;
                W_log(__LINE__ .'$gourl ' . $gourl) ;

				$des="扫描二维码可以获得推荐关系！";
				$items = "<item>
				<Title><![CDATA[推荐二维码]]></Title>
				<Description><![CDATA[" . $des . "]]></Description>
				<PicUrl><![CDATA[" . $surl . "]]></PicUrl>
				<Url><![CDATA[" . $gourl . "]]></Url>
				</item>";				
				$msgType = "news";
                W_log(__LINE__ .'$items ' . $items) ;
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';

				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
                W_log(__LINE__ .'11 ' . $uname.' | '. $keyword .' | '. $fromUsername) ;
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
                W_log(__LINE__ .'22 ' . $base_url) ;
				$this -> universal($fromUsername, $base_url);
                W_log(__LINE__ .'33 ' . $base_url) ;
				echo $resultStr;
                W_log(__LINE__ .'$resultStr ' . $resultStr) ;
				exit;
			}
			elseif ($keyword == 'tianxin100') {

                W_log(__LINE__ .'tianxin100 --- ') ;
			
				$access_token = $db->getOne("SELECT `access_token` FROM `wxch_config` ");
                 echo $this->customText($access_token, $fromUsername);
				$affiliate = unserialize($GLOBALS['_CFG_MOBILE']['affiliate']);
				$level_register_up = (float)$affiliate['config']['level_register_up'];
				$rank_points =  $GLOBALS['db']->getOne("SELECT rank_points FROM " . $GLOBALS['ecs']->table('users')."where user_id=".$user_id);
				if($rank_points<$level_register_up){
					$msgType = "text";
					$contentStr = "您还不是分销商，暂时不能获取推广二维码";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> universal($fromUsername, $base_url);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					echo $resultStr;
					exit;
				}
				$ArticleCount = 1;
				$scene_id = $user_id;
				/*甜  心 100  专业   修复*/
				if(empty($scene_id)){
					$msgType = "text";
					$contentStr = "您还未绑定会员账号，请先绑定后进行操作";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> universal($fromUsername, $base_url);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					echo $resultStr;
					exit;
				}
				$affiliate=$user_id;
				$gourl = $base_url . '/wechat/egg/index1.php?scene_id=' . $scene_id;
				$type = 'tj';
				$qr_path = $db->getOne("SELECT `qr_path` FROM `wxch_qr` WHERE `scene_id`='$scene_id'");
				$user_name = $db->getOne("SELECT `user_name` FROM `ecs_users` WHERE `user_id`='$scene_id'");				
				$scene=$user_name;
				$qr_path = $db->getOne("SELECT `qr_path` FROM `wxch_qr_tianxin100` WHERE `scene_id`='$scene_id'");
				
				/*甜  心10 0修复  换域名问题和头像重新生成图片问题*/
				$scene=$user_name;				
				if(!empty($qr_path))
				{
				/*甜  心10 0修复  换域名问题和头像重新生成图片问题*/
					 $surl=$qr_path;
					 $data=dirname(__FILE__)."\qrcode\/".$surl;
                 }
                 else{
                    $action_name="QR_LIMIT_SCENE";
                    $json_arr = array('action_name'=>$action_name,'action_info'=>array('scene'=>array('scene_id'=>$scene_id)));
                    $data = json_encode($json_arr);
                    $this -> access_token($db);
                    $ret = $db->getRow("SELECT `access_token` FROM `wxch_config`");
                    $access_token = $ret['access_token'];
                    if(strlen($access_token) >= 64)
                    {
                        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
                        $res_json =$this -> curl_grab_page($url, $data);
                        $json = json_decode($res_json);
                    }
                    $ticket = $json->ticket;
                    W_log(__LINE__ . '| $ticket | ' . $ticket) ;
                    if($ticket)
                    {
                        $ticket_url = urlencode($ticket);
                        $ticket_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket_url;
                        $imageinfo=$this -> downloadimageformweixin($ticket_url);

                        if(empty($imageinfo)){
                                $msgType = "text";
                                $contentStr = "下载二维码失败，请检查服务器环境后重试";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                $this -> universal($fromUsername, $base_url);
                                $this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
                                echo $resultStr;
                                exit;

                        }
                        W_log(__LINE__ . '| $imageinfo | ' . $imageinfo) ;
                        $time = time();
                        $url=$_SERVER['HTTP_HOST'];
                        $path = '../images/qrcode/'.$time.'.jpg';
                        $surl="http://".$url.'/images/qrcode/'.$time.'.jpg';
                        $local_file=fopen($path,'a');
                        $h_path='../images/qrcode/head/'.$time.'.jpg';
                        $h_local_file=fopen($h_path,'a');
                        $headimgurl = $db->getOne("SELECT `headimgurl` FROM `wxch_user` WHERE `wxid`='$fromUsername'");
                        if(empty($headimgurl)){
                            $msgType = "text";
                            $contentStr = "获取头像失败，请先登录微信商城后重试";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            $this -> universal($fromUsername, $base_url);
                            $this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
                            echo $resultStr;
                            exit;
                        }
                        $h_imageinfo=$this -> downloadimageformweixin($headimgurl);
                        W_log(__LINE__ . '| $local_file | ' . $local_file) ;
                        if(false !==$local_file){

                            if(false !==fwrite($local_file,$imageinfo)&&false !==fwrite($h_local_file,$h_imageinfo))
                            {
                                fclose($local_file);
                                //将生成的二维码图片的地址放到数据库中
                                $insert_sql = "INSERT INTO `wxch_qr` (`type`,`action_name`,`ticket`, `scene_id`, `scene` ,`qr_path`,`function`,`affiliate`,`endtime`,`dateline`) VALUES
                                ('$type','$action_name', '$ticket','$scene_id', '$scene' ,'$surl','$function','$affiliate','$endtime','$dateline')";
                                $db->query($insert_sql);
                                W_log(__LINE__ . '| $insert_sql | ' . $insert_sql) ;
                            }
                            else{
                                $msgType = "text";
                                $contentStr = "保存二维码和头像图片失败,检查fwrite函数是否生效请重试";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                $this -> universal($fromUsername, $base_url);
                                $this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
                                echo $resultStr;
                                exit;

                            }

                        }
                        else
                        {
                            $msgType = "text";
                            $contentStr = "保存二维码图片的路径images/qrcode或images/qrcode/head则没可写权限，请修改！";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            $this -> universal($fromUsername, $base_url);
                            $this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
                            echo $resultStr;
                            exit;

                        }
                    }
                    else
                    {
                        $msgType = "text";
                        $contentStr = "获取ticket失败检查appid和appsecret是否正确";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        $this -> universal($fromUsername, $base_url);
                        $this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
                        echo $resultStr;
                        exit;
                    }

                    $imgsrc = "../images/qrcode/".$time.".jpg";
                    $h_imgsrc="../images/qrcode/head/".$time.".jpg";

                    $ewm_data = $db -> getAll("SELECT * FROM  `wxch_erweima` WHERE  `id` = 1");
                    foreach ($ewm_data as $v)
                    {
                        $qr_width = $v['qr_width']; //是二维码图片宽度
                        $qr_height = $v['qr_hight'];//二维码图片高度
                        $qr_x = $v['qr_x'];
                        $qr_y = $v['qr_y'];
                        $hearimg_width = $v['hearimg_width'];
                        $hearimg_hight = $v['hearimg_hight'];
                        $hearimg_x = $v['hearimg_x'];
                        $hearimg_y = $v['hearimg_y'];
                        $bg_img = $v['bg_img'];
                        $text_red = $v['text_red'];
                        $text_geren = $v['text_geren'];
                        $text_blue = $v['text_blue'];
                    }
                    $time=time();
                    $name=$this->resizejpg($imgsrc,$qr_width,$qr_height,$time);
                    $imgs = $name;
                    //处理头像

				
                    $h_time=$time."_1";
                    $h_name=$this->resizejpg($h_imgsrc,$hearimg_width,$hearimg_hight,$h_time);
                    $h_imgs = $h_name;
                    if(!empty($bg_img))
                    {
                        $target = '../mobile/'.$bg_img;//背景图片 mobile下的qrcode 文件下
                    }
                    else
                    {
                        $target = '../qrcode/tianxin100.jpg';//背景图片
                    }
                    $target_img = Imagecreatefromjpeg($target);
                    $source = Imagecreatefromjpeg($imgs);
                    $h_source = Imagecreatefromjpeg($h_imgs);
                    imagecopy($target_img,$source,$qr_x,$qr_y,0,0,$qr_width,$qr_height);//创建二维码图片大小
                    imagecopy($target_img,$h_source,$hearimg_x,$hearimg_y,0,0,$hearimg_width,$hearimg_hight);//创建头像大小
                    $fontfile = "./simsun.ttf";
                    #水印文字
                    $nickname = $db->getOne("SELECT `nickname` FROM `wxch_user` WHERE `wxid`='$fromUsername'");

                    #打水印
                    $textcolor = imagecolorallocate($target_img, $text_red, $text_geren, $text_blue);
                    imagettftext($target_img,18,0,268,59,$textcolor,$fontfile,$nickname);
                    Imagejpeg($target_img,'qrcode/'.$time.'.jpg');
                    $data=dirname(__FILE__)."\qrcode\/".$time.".jpg";
                    $s_data=$time.".jpg";
                    $insert_sql = "INSERT INTO `wxch_qr_tianxin100` (`qr_path`,`scene`,`scene_id`, `nickname`) VALUES
                    ('$s_data','$scene', '$scene_id','$nickname')";
                    $db->query($insert_sql);
				
				}

                $filedata=array("media"=>"@".$data);
                $this -> access_token($db);
                $ret = $db->getRow("SELECT `access_token` FROM `wxch_config`");
                $access_token = $ret['access_token'];
                W_log( __LINE__ .' $access_token  ---->' .$access_token ) ;
                if(strlen($access_token) >= 64)
                {
                    $url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$access_token.'&type=image';
                    W_log( __LINE__ .  ' $url  ---->' .$url ) ;
                    $res_json =$this -> https_request($url, $filedata);
                    W_log( __LINE__ .  ' $res_json  ---->' .$res_json ) ;
                    $json = json_decode($res_json);
                }
                foreach ($json as $k=>$v)
                {
                    W_log( __LINE__ .  $k.'  ---->' .$v ) ;
                }

				if($json->media_id){
					$msgType = "image";
					$iipp = $_SERVER["REMOTE_ADDR"];
					$phone_state=$_SERVER['HTTP_USER_AGENT'];
					$contentStr = $json->media_id;
					$resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
					exit;
				}else{
					$msgType = "text";
					$contentStr = "请联系玉泷技术修改代码";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> universal($fromUsername, $base_url);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					echo $resultStr;
					exit;
					
				}
			}
			elseif ($keyword == 'map232') {
				$url = 'http://api.map.baidu.com/direction?origin=latlng:34.264642646862,108.95108518068|name:我家&desti
nation=大雁塔&mode=driving&region=西安';
				$name = '地图';
				$PicUrl = '';
				$items = "<item>
             <Title><![CDATA[" . $name . "]]></Title>
             <PicUrl><![CDATA[" . $PicUrl . "]]></PicUrl>
             <Url><![CDATA[" . $url . "]]></Url>
             </item>";
				$ArticleCount = 1;
				$msgType = "news";
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'gzyhj') {
				//关注送红包
                W_log('送红包处理');
				$msgType = "text";
				$contentStr = $this -> coupon($db, $fromUsername);
				if(!empty($zhanghaoinfo)){
					$contentStr .=$zhanghaoinfo;
				}else{
					//$contentStr .= "您已经注册过！账号是".$user_name."默认密码是:".$user_password;
					$user_id = $db -> getOne("select user_id from ". $db -> prefix . 'users'." WHERE `user_name` ='$user_name'");
					$contentStr = "感谢您关注玉泷集团！\r\n恭喜您，成为了玉珑商城第 $user_id 个会员！\r\n全新微商城全新体验，为您提供更好的服务我们一直在努力！\r\n限时抢购不容错过，【".'<a href="'.$base_url.'/group_buy.php">点我抢购</a>】';
				}
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'qiandao') {
				$jf_state = $db -> getOne("SELECT `autoload` FROM `wxch_point` WHERE `point_name` = '$keyword'");
				$msgType = "text";
				if ($jf_state == 'yes') {
					$qd_jf = $db -> getOne("SELECT `point_value` FROM `wxch_point` WHERE `point_name` = '$keyword'");
					$res = $this -> plusPoint($db, $uname, $keyword, $fromUsername);
					if ($res['errmsg'] == 'ok') {
						$contentStr = $res['contentStr'] . $qd_jf;
					} else {
						$contentStr = $res['contentStr'];
					} 
				} elseif ($jf_state == 'no') {
					$qdstop = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'qdstop'");
					if (empty($qdstop)) {
						$qdstop = '签到积送已停止使用';
					} 
					$contentStr = $qdstop;
				} 
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			}
			elseif ($keyword == 'subscribe') {
				/* 甜  心 10 0  新 增修 复  如果是直接关注的则默认分配上级账号避免推荐关系混乱*/
				$affiliate = unserialize($GLOBALS['_CFG_MOBILE']['affiliate']);	
				$parent_id=(float)$affiliate['config']['parent_id'];
				W_log('当前用户上级:'.$parent_id);
				//存在推荐人，查询推荐人ID
				if(!empty($parent_id)){
				    W_log('正在查找推荐人...');
					$user_parent_id = $db -> getOne("SELECT `parent_id` FROM `ecs_users` WHERE `wxid` ='$fromUsername'");
					//如果推荐人为空，则设置推荐人为全局推荐人
					if(empty($user_parent_id)){
					    W_log('设置推荐人是全局推荐人');
						$db->query("UPDATE  ecs_users SET `parent_id`='$parent_id',sales1_id = '$parent_id' WHERE `wxid`='$fromUsername'");
					}
				}
				/* 甜  心 10 0  新 增修 复  如果是直接关注的则默认分配上级账号避免推荐关系混乱*/

                //关键词回复，目前表格没有内容
				$type1 = $db -> getOne("SELECT `type` FROM `wxch_keywords1` WHERE `is_start` = 1");
				if($type1==3){
					$keyword="关注回复文本";
				}else{
					$keyword="关注回复图文";
				}
				$this ->getauto_reg($db, $keyword, $textTpl, $newsTpl, $base_url, $m_url, $fromUsername, $toUsername, $time, $article_url,$user_name,$ec_pwd_no,$zhanghaoinfo,$user_password);
			}

			if (!empty($keyword)) {
				$ck_keyword = strtolower($keyword);
				$ck_ret = stristr($ck_keyword, 'ck');
				if ($ck_ret) {
					$ck_arr = explode('ck', $keyword);
					$ck_sn = $ck_arr[1];
					$ck_table = $db -> prefix . 'goods';
					$ck_ret = $db -> getAll("SELECT * FROM  `$ck_table` WHERE  `goods_sn` LIKE '%$ck_sn%'");
					$msgType = "text";
					$ck_goods = '';
					if (count($ck_ret) > 10) {
						$contentStr = '结果超出十条以上，请您输入更准确的货号，例如：' . $ck_sn . 'AB';
					} elseif (count($ck_ret) > 0) {
						foreach($ck_ret as $v) {
							if ($v['is_on_sale'] == 0) {
								$ck_title = '下架';
							} elseif ($v['goods_number'] > 20) {
								$ck_title = '充足';
							} elseif ($v['goods_number'] >= 5 and $v['goods_number'] <= 20) {
								$ck_title = '紧张';
							} elseif ($v['goods_number'] >= 1 and $v['goods_number'] <= 5) {
								$ck_title = $v['goods_number'];
							} elseif ($v['goods_number'] == 0) {
								$ck_title = '缺货';
							} 
							$ck_goods .= $v['goods_sn'] . ':' . $v['goods_name'] . '--' . $ck_title . "\r\n";
						} 
						$contentStr = $ck_goods;
					} else {
						$contentStr = '没有查询到' . $ck_sn . '货号的商品，建议您输入更简短的货号查询';
					} 
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} 
				$this -> getauto($db, $keyword, $textTpl, $newsTpl, $base_url, $m_url, $fromUsername, $toUsername, $time, $article_url);
				$thistable = $db -> prefix . 'goods';
				$goods_name = $keyword;
				$search_sql = "SELECT * FROM  `$thistable` WHERE  `goods_name` LIKE '%$goods_name%' $goods_is ORDER BY sort_order, last_update DESC LIMIT 0,6";
				$ret = $db -> getAll($search_sql);
				$ArticleCount = count($ret);
				$items = '';
				if ($ArticleCount >= 1) {
					foreach($ret as $v) {
						if ($img_path == 'local') {
							$v['thumbnail_pic'] = $base_img_path . $v['goods_img'];
						} elseif ($img_path == 'server') {
							$v['thumbnail_pic'] = $v['goods_img'];
						} 
						if ($oauth_state == 'true') {
							$goods_url = $oauth_location . $m_url . 'goods.php?id=' . $v['goods_id'] . $affiliate;
						} elseif ($oauth_state == 'false') {
							$goods_url = $m_url . 'goods.php?id=' . $v['goods_id'] . $postfix . $affiliate;
						} 
						$items .= "<item>
                 <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
                 <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
                 <Url><![CDATA[" . $goods_url . "]]></Url>
                 </item>";
					} 
					$msgType = "news";
				} else {
					$msgType = "text";
					$thistable = $db -> prefix . 'goods';
					if ($plustj == 'true') {
						$tj_str = $this -> plusTj($db, $m_url, $postfix, $oauth_location, $oauth_state, $goods_is, $affiliate);
						$contentStr = '没有搜索到"' . $goods_name . '"的商品' . $tj_str;
					} elseif ($plustj == 'false') {
						exit;
					} 
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					$this -> insert_wmessage($db, $fromUsername, $contentStr, $time, $belong);
					$this -> plusPoint($db, $uname, $keyword, $fromUsername);
					$this -> universal($fromUsername, $base_url);
					echo $resultStr;
					exit;
				} 
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
				$w_message = '图文消息';
				$this -> insert_wmessage($db, $fromUsername, $w_message, $time, $belong);
				$this -> plusPoint($db, $uname, $keyword, $fromUsername);
				$this -> universal($fromUsername, $base_url);
				echo $resultStr;
				exit;
			} 
		}
		else
		{

			echo '';
			exit;
		} 
	}

	protected function plusPoint($db, $uname, $keyword, $fromUsername) {
		$res_arr = array();
		$sql = "SELECT * FROM `wxch_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'";
		$record = $db -> getRow($sql);
		//甜心100修复积分赠送次数限制
		$num = $db -> getOne("SELECT `point_num` FROM `wxch_point` WHERE `point_name` = '$keyword'");
		//$lasttime = time();
		$lasttime=strtotime(date('Y-m-d',time())) + 24*60*60;
		if (empty($record)) {
			$dateline = time();
			$insert_sql = "INSERT INTO `wxch_point_record` (`wxid`, `point_name`, `num`, `lasttime`, `datelinie`) VALUES
('$fromUsername', '$keyword' , 1, $lasttime, $dateline);";
			$potin_name = $db -> getOne("SELECT `point_name` FROM `wxch_point` WHERE `point_name` = '$keyword'");
			if (!empty($potin_name)) {
				$db -> query($insert_sql);
			} 
		} else {
			$qdtoday = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'qdtoday'");
			if (empty($qdtoday)) {
				$qdtoday = '今天您已经签到了，明天再来赚积分吧';
			} 
			$time = time();
			//$time=date("y-m-d",$time);
			$lasttime_sql = "SELECT `lasttime` FROM `wxch_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'";
			$db_lasttime = $db -> getOne($lasttime_sql);
			
			if ($time > $db_lasttime) {//($time - $db_lasttime) > (60 * 60 * 24)
				$update_sql = "UPDATE `wxch_point_record` SET `num` = 0,`lasttime` = '$lasttime' WHERE `wxid` ='$fromUsername';";
				$db -> query($update_sql);
			} 
			$record_num = $db -> getOne("SELECT `num` FROM `wxch_point_record` WHERE `point_name` = '$keyword' AND `wxid` = '$fromUsername'");
			if ($record_num < $num) {
				$update_sql = "UPDATE `wxch_point_record` SET `num` = `num`+1,`lasttime` = '$lasttime' WHERE `point_name` = '$keyword' AND `wxid` ='$fromUsername';";
				$db -> query($update_sql);
			} else {
				$qdno = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'qdno'");
				if (empty($qdno)) {
					$qdno = '签到数次已用完';
				} 
				$res_arr['errmsg'] = 'no';
				$res_arr['contentStr'] = $qdno;
				return $res_arr;
			} 
		} 
		$wxch_table = 'wxch_point';
		$wxch_points = $db -> getAll("SELECT * FROM  `$wxch_table`");
		foreach($wxch_points as $k => $v) {
			if ($v['point_name'] == $keyword) {
				if ($v['autoload'] == 'yes') {
					$points = $v['point_value'];
					$thistable = $db -> prefix . 'users';
					if (!empty($uname)) {
						$sql = "UPDATE `$thistable` SET `pay_points` = `pay_points`+$points WHERE `user_name` ='$uname'";
						if($keyword=="qiandao"){
							$user_id = $db -> getOne("SELECT `user_id` FROM `$thistable` WHERE `wxid` ='$fromUsername'");
							$account_log = array(
								'user_id'       => $user_id,
								'user_money'    => 0,
								'frozen_money'  => 0,
								'rank_points'   => 0,
								'pay_points'    => $points,
								'change_time'   => gmtime(),
								'change_desc'   => "微信签到送积分",
								'change_type'   => $change_type
							);						
							$db->autoExecute('ecs_account_log', $account_log, 'INSERT');
						}
					} else {
						if($keyword=="qiandao"){
							$user_id = $db -> getOne("SELECT `user_id` FROM `$thistable` WHERE `wxid` ='$fromUsername'");
							$account_log = array(
								'user_id'       => $user_id,
								'user_money'    => 0,
								'frozen_money'  => 0,
								'rank_points'   => 0,
								'pay_points'    => $points,
								'change_time'   => gmtime(),
								'change_desc'   => "微信签到送积分",
								'change_type'   => $change_type
							);						
							$db->autoExecute('ecs_account_log', $account_log, 'INSERT');
						}					
						$sql = "UPDATE `$thistable` SET `pay_points` = `pay_points`+$points WHERE `wxid` ='$fromUsername'";
					} 
					$db -> query($sql);
				} 
			} 
		} 
		//甜心100添加
		if($keyword=="g_point"){
			
			$g_point=$points;
		}
		//甜心100添加
		$qdok = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'qdok'");
		if (empty($qdok)) {
		
			$qdok = '签到成功,积分+';
		} 
		$res_arr['errmsg'] = 'ok';
		$res_arr['contentStr'] = $qdok;
		$res_arr['g_point']=$g_point;
		return $res_arr;
	} 
	protected function getNews($db, $base_url, $m_url, $postfix, $img_path) {
		$thistable = $db -> prefix . 'goods';
		$ret = $db -> getAll("SELECT * FROM  `$thistable` ORDER BY `add_time` LIMIT 0 , 6");
		$ArticleCount = count($ret);
		$items = '';
		if ($ArticleCount >= 1) {
			foreach($ret as $v) {
				if ($img_path == 'local') {
					$v['thumbnail_pic'] = $base_img_path . $v['goods_img'];
				} elseif ($img_path == 'server') {
					$v['thumbnail_pic'] = $v['goods_img'];
				} 
				$goods_url = $m_url . 'goods.php?id=' . $v['goods_id'] . $postfix;
				$items .= "<item>
             <Title><![CDATA[" . $v['goods_name'] . "]]></Title>
             <PicUrl><![CDATA[" . $v['thumbnail_pic'] . "]]></PicUrl>
             <Url><![CDATA[" . $goods_url . "]]></Url>
             </item>";
			} 
		} 
		$data = array();
		$data['ArticleCount'] = $ArticleCount;
		$data['items'] = $items;
		return $data;
	} 
	protected function insert_wmessage($db, $fromUsername, $w_message, $time, $belong) {
		$w_message = mysql_real_escape_string($w_message);
		$sql = "INSERT INTO `wxch_message` (`wxid`, `w_message`, `belong`, `dateline`) VALUES
('$fromUsername', '$w_message', '$belong', '$time');";
		$db -> query($sql);
	} 
	protected function plusTj($db, $m_url, $postfix, $oauth_location, $oauth_state, $goods_is, $affiliate) {
		$thistable = $db -> prefix . 'goods';
		$ret = $db -> getAll("SELECT * FROM  `$thistable` WHERE  `is_best` =1 $goods_is ");
		$tj_count = count($ret);
		$tj_key = mt_rand(0, $tj_count);
		$tj_goods = $ret[$tj_key];
		if ($tj_goods['goods_id']) {
			if ($oauth_state == 'true') {
				return $tj_str = "\r\n我们为您推荐:" . "<a href='$oauth_location" . "$m_url" . 'goods.php?id=' . $tj_goods['goods_id'] . $affiliate . "'>$tj_goods[goods_name]</a>";
			} elseif ($oauth_state == 'false') {
				return $tj_str = "\r\n我们为您推荐:" . '<a href="' . $m_url . 'goods.php?id=' . $tj_goods[goods_id] . $postfix . $affiliate . '">' . $tj_goods[goods_name] . '</a>';
			} 
		} 
	} 
	protected function get_keywords_articles($kws_id, $db) {
		$sql = "SELECT `article_id` FROM `wxch_keywords_article` WHERE `kws_id` = '$kws_id'";
		$ret = $db -> getAll($sql);
		$articles = '';
		foreach($ret as $v) {
			$articles .= $v['article_id'] . ',';
		} 
		$length = strlen($articles)-1;
		$articles = substr($articles, 0, $length);
		if (!empty($articles)) {
			$sql2 = "SELECT `article_id`,`title`,`file_url`,`description` FROM " . $GLOBALS['ecs'] -> table('article') . " WHERE `article_id` IN ($articles) ORDER BY `add_time` DESC ";
			$res = $db -> getAll($sql2);
		} 
		return $res;
	} 
	protected function coupon($db, $fromUsername) {
		$retc = $db -> getRow("SELECT `coupon` FROM `wxch_user` WHERE `wxid` ='$fromUsername'");
		$lang = $db -> getAll("SELECT * FROM `wxch_lang` WHERE `lang_name` LIKE '%coupon%'");
		if (!empty($retc['coupon'])) {
			$contentStr = $lang[0]['lang_value'] . $retc['coupon'] . $lang[3]['lang_value'];
			return $contentStr;
		} else {
			$ret = $db -> getRow("SELECT * FROM `wxch_coupon` WHERE `id` = 1");
			$type_id = $ret['type_id'];
			$thistable = $db -> prefix . 'bonus_type';
			$ret = $db -> getRow("SELECT * FROM `$thistable` WHERE `type_id` =$type_id ");
			$type_money = $ret['type_money'];
			$use_end_date = date("Y年-m月-d日", $ret['use_end_date']);
			$time = time();
			if (($time >= $ret['send_start_date']) or ($time <= $ret['send_end_date'])) {
				$thistable = $db -> prefix . 'user_bonus';
				$ret = $db -> getRow("SELECT `bonus_sn` FROM `$thistable` WHERE `bonus_type_id` = $type_id AND `used_time` = 0 ");
				if (!empty($ret['bonus_sn'])) {
					$user_bonus = $db -> getAll("SELECT `bonus_sn` FROM  `$thistable` WHERE `bonus_type_id` = $type_id");
					$wx_bonus = $db -> getAll("SELECT `coupon` FROM  `wxch_user` ");
					foreach ($wx_bonus as $k => $v) {
						foreach ($user_bonus as $kk => $vv) {
							if ($v['coupon'] == $vv['bonus_sn']) {
								unset($user_bonus[$kk]);
							} 
						} 
					} 
					$bonus_rand = array_rand($user_bonus);
					$coupon = $user_bonus[$bonus_rand]['bonus_sn'];
					if (!empty($user_bonus[$bonus_rand]['bonus_sn'])) {
						$contentStr = $lang[1]['lang_value'] . $type_money . "元,优惠券：" . $coupon . "\r\n使用结束日期：$use_end_date" . $lang[3]['lang_value'];
						$db -> query("UPDATE `wxch_user` SET `coupon` = '$coupon' WHERE `wxid` ='$fromUsername';");
					} else {
						$contentStr = $lang[2]['lang_value'] . $lang[3]['lang_value'];
					} 
				} else {
					$contentStr = $lang[2]['lang_value'] . $lang[3]['lang_value'];
				} 
			} 
		} 
		return $contentStr;
	} 
	protected function dzp($db, $base_url, $fromUsername) {
		$ret = $db -> getAll("SELECT * FROM `wxch_prize` WHERE `fun` = 'dzp' AND `status` = 1 ORDER BY `dateline` DESC ");
		$temp_count = count($ret);
		$time = time();
		if ($temp_count > 1) {
			foreach($ret as $k => $v) {
				if ($time <= $v['starttime']) {
					unset($ret[$k]);
				} elseif ($time >= $v['endtime']) {
					unset($ret[$k]);
				} 
			} 
		} 
		$ArticleCount = 1;
		$prize_count = count($ret);
		$prize = $ret[array_rand($ret)];
		$wxch_lang = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'prize_dzp'");
		if ($prize_count <= 0) {
			$items = '<item>
                 <Title><![CDATA[大转盘暂时未开放]]></Title>
                 <PicUrl><![CDATA[]]></PicUrl>
                 <Url><![CDATA[]]></Url>
                 </item>';
		} else {
			$gourl = $base_url . '/wechat/dzp/index.php?pid=' . $prize['pid'] . '&wxid=' . $fromUsername;
			$PicUrl = $base_url . '/wechat/dzp/images/wx_bd.jpg';
			$items = "<item>
                 <Title><![CDATA[大转盘]]></Title>
                 <Description><![CDATA[" . $wxch_lang . "]]></Description>
                 <PicUrl><![CDATA[" . $PicUrl . "]]></PicUrl>
                 <Url><![CDATA[" . $gourl . "]]></Url>
                 </item>";
		} 
		$data = array();
		$data['ArticleCount'] = $ArticleCount;
		$data['items'] = $items;
		return $data;
	} 
	protected function egg($db, $base_url, $fromUsername) {
		$ret = $db -> getAll("SELECT * FROM `wxch_prize` WHERE `fun` = 'egg' AND `status` = 1 ORDER BY `dateline` DESC ");
		$temp_count = count($ret);
		$time = time();
		if ($temp_count > 1) {
			foreach($ret as $k => $v) {
				if ($time <= $v['starttime']) {
					unset($ret[$k]);
				} elseif ($time >= $v['endtime']) {
					unset($ret[$k]);
				} 
			} 
		} 
		$ArticleCount = 1;
		$prize_count = count($ret);
		$prize = $ret[array_rand($ret)];
		$wxch_lang = $db -> getOne("SELECT `lang_value` FROM `wxch_lang` WHERE `lang_name` = 'prize_egg'");
		if ($prize_count <= 0) {
			$items = '<item>
             <Title><![CDATA[砸金蛋暂时未开放]]></Title>
             <PicUrl><![CDATA[]]></PicUrl>
             <Url><![CDATA[]]></Url>
             </item>';
		} else {
			$gourl = $base_url . '/wechat/egg/index.php?pid=' . $prize['pid'] . '&wxid=' . $fromUsername;
			$PicUrl = $base_url . '/wechat/egg/images/wx_bd.jpg';
			$items = "<item>
             <Title><![CDATA[砸金蛋]]></Title>
             <Description><![CDATA[" . $wxch_lang . "]]></Description>
             <PicUrl><![CDATA[" . $PicUrl . "]]></PicUrl>
             <Url><![CDATA[" . $gourl . "]]></Url>
             </item>";
		} 
		$data = array();
		$data['ArticleCount'] = $ArticleCount;
		$data['items'] = $items;
		return $data;
	} 
	protected function getauto($db, $keyword, $textTpl, $newsTpl, $base_url, $m_url, $fromUsername, $toUsername, $time, $article_url) {
	    W_log('获取自动注册信息');
	    $this -> universal($fromUsername, $base_url);
		$auto_res = $ret = $db -> getAll("SELECT * FROM `wxch_keywords`");
		if (count($auto_res) > 0) {
			foreach($auto_res as $k => $v) {
				if ($v['status'] == 1) {
					$res_ks = explode(' ', $v['keyword']);
					if ($v['type'] == 1) {
						$msgType = "text";
						foreach($res_ks as $kk => $vv) {
							if ($vv == $keyword) {
								$contentStr = $v['contents'];
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;
								$db -> query("UPDATE `wxch_keywords` SET `count` = `count`+1 WHERE `id` =$v[id]");
								exit;
							} 
						} 
					} elseif ($v['type'] == 2) {
						$msgType = "news";
						$items = '';
						foreach($res_ks as $kk => $vv) {
							if ($vv == $keyword) {
								$res = $this -> get_keywords_articles($v['id'], $db);
								foreach($res as $vvv) {
									if (!empty($vvv['file_url'])) {
										$picurl = $base_url . $vvv['file_url'];
									} else {
										$picurl = $base_url . 'themes/default/images/logo.gif';
										if (!is_null($GLOBALS['_CFG']['template'])) {
											$picurl = $base_url . 'themes/' . $GLOBALS['_CFG']['template'] . '/images/logo.gif';
										} 
									} 
									$gourl = $m_url . $article_url . $vvv['article_id'];
									$ArticleCount = count($res);
                                    W_log('回复链接是:'.$gourl);
                                    W_log('回复图片是:'.$picurl);
                                    W_log('回复描述是:'.$vvv['description']);
                                    W_log('回复标题是:'.$vvv['title']);
									$items .= "<item>
                             <Title><![CDATA[" . $vvv['title'] . "]]></Title>
                             <Description><![CDATA[" . $vvv['description'] . "]]></Description>
                             <PicUrl><![CDATA[" . $picurl . "]]></PicUrl>
                             <Url><![CDATA[" . $gourl . "]]></Url>
                             </item>";
								} 
								$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
								echo $resultStr;
								$db -> query("UPDATE `wxch_keywords` SET `count` = `count`+1 WHERE `id` =$v[id];");
								exit;
							} 
						} 
					} 
				} 
			} 
		} 
	}


	protected function getauto_reg($db, $keyword, $textTpl, $newsTpl, $base_url, $m_url, $fromUsername, $toUsername, $time, $article_url,$user_name,$ec_pwd_no,$zhanghaoinfo,$user_password) {
		W_log('进入到自动注册处理');
	    $this -> universal($fromUsername, $base_url);
		$auto_res = $ret = $db -> getAll("SELECT * FROM `wxch_keywords1`");
		W_log('找到'.count($auto_res).'条信息');
		if (count($auto_res) > 0) {
			foreach($auto_res as $k => $v) {
				if ($v['status'] == 1) {
					$res_ks = explode(' ', $v['keyword']);
					if ($v['type'] == 3) {
						$msgType = "text";
						foreach($res_ks as $kk => $vv) {
							if ($vv == $keyword) {
								$contentStr = $v['contents'];
							if(!empty($zhanghaoinfo)){
								$contentStr .= $zhanghaoinfo;
							}else{
	
								$contentStr .= "您已经注册过！账号是".$user_name."默认密码是:".$user_password;
							}
							$user_id = $db -> getOne("select user_id from ". $db -> prefix . 'users'." WHERE `user_name` ='$user_name'");
							$contentStr = "感谢您关注玉泷集团！\r\n恭喜您，成为了玉珑商城第 $user_id 个会员！\r\n全新微商城全新体验，为您提供更好的服务我们一直在努力！\r\n限时抢购不容错过，【".'<a href="'.$m_url.'/group_buy.php">点我抢购</a>】';

							//增加关注送积分
							 $keyword="g_point";
							 $ret=$this -> plusPoint($db, $uname, $keyword, $fromUsername);
							 //增加关注送积分
							 $g_point=$ret['g_point'];
							 if(!empty($g_point)){
								
									$contentStr.="关注赠送积分:".$g_point;
							 }
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;
								$db -> query("UPDATE `wxch_keywords1` SET `count` = `count`+1 WHERE `id` =$v[id]");
								exit;
							} 
						} 
					} elseif ($v['type'] == 4) {
						$msgType = "news";
						$items = '';
						foreach($res_ks as $kk => $vv) {
							if ($vv == $keyword) {
								$res = $this -> get_keywords_articles($v['id'], $db);
								foreach($res as $vvv) {
									if (!empty($vvv['file_url'])) {
										$picurl = $base_url . $vvv['file_url'];
									} else {
										$picurl = $base_url . '/themes/default/images/logo.gif';
										if (!is_null($GLOBALS['_CFG']['template'])) {
											$picurl = $base_url . '/themes/' . $GLOBALS['_CFG']['template'] . '/images/logo.gif';
										} 
									} 
									$gourl = $m_url . $article_url . $vvv['article_id'];
									$ArticleCount = count($res);
									W_log('回复链接是:'.$gourl);
									W_log('回复图片是:'.$picurl);
									W_log('回复描述是:'.$vvv['description']);
									W_log('回复标题是:'.$vvv['title']);
									$items .= "<item>
                             <Title><![CDATA[" . $vvv['title'] . "]]></Title>
                             <Description><![CDATA[" . $vvv['description'] . "]]></Description>
                             <PicUrl><![CDATA[" . $picurl . "]]></PicUrl>
                             <Url><![CDATA[" . $gourl . "]]></Url>
                             </item>";
								} 
								$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $ArticleCount, $items);
								echo $resultStr;
								$db -> query("UPDATE `wxch_keywords1` SET `count` = `count`+1 WHERE `id` =$v[id];");
								exit;
							} 
						} 
					} 
				} 
			} 
		} 
	} 	 
	public function access_token($db) {
		$ret = $db -> getRow("SELECT * FROM `wxch_config` WHERE `id` = 1");
		$appid = $ret['appid'];
		$appsecret = $ret['appsecret'];
		$dateline = $ret['dateline'];
		$time = time();
		$access_token = $ret['access_token'];
		if (($time - $dateline) > 7200) {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$ret_json = $this ->curl_get_contents($url);
			$ret = json_decode($ret_json);
			if ($ret -> access_token) {
				$db -> query("UPDATE `wxch_config` SET `access_token` = '$ret->access_token',`dateline` = '$time' WHERE `wxch_config`.`id` =1;");
			    $access_token = $ret->access_token;
			}
		}
		return $access_token;
	} 
	public function delete_menu($db) {
		$this -> access_token($db);
		$ret = $db -> getRow("SELECT `access_token` FROM `wxch_config`");
		$access_token = $ret['access_token'];
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $access_token;
		$ret_json = $this -> curl_get_contents($url);
		$ret = json_decode($ret_json);
		return $ret;
	} 
	public function orders($user_id, $size = 10, $start = 0) {
		include_once(ROOT_PATH . 'includes/lib_transaction.php');
		$orders = get_user_orders($user_id, $size, $start);
		return $orders;
	} 
	public function kuaidi($invoice_no, $shipping_name) {
		switch ($shipping_name) {
			case '中国邮政':$logi_type = 'ems';
				break;
			case '申通快递':$logi_type = 'shentong';
				break;
			case '圆通速递':$logi_type = 'yuantong';
				break;
			case '顺丰速运':$logi_type = 'shunfeng';
				break;
			case '韵达快递':$logi_type = 'yunda';
				break;
			case '天天快递':$logi_type = 'tiantian';
				break;
			case '中通速递':$logi_type = 'zhongtong';
				break;
			case '增益速递':$logi_type = 'zengyisudi';
				break;
		} 
		$kurl = 'http://www.kuaidi100.com/query?type=' . $logi_type . '&postid=' . $invoice_no;
		$ret = $this -> curl_get_contents($kurl);
		$k_arr = json_decode($ret, true);
		return $k_arr;
	} 
	public function universal($wxid, $base_url) {
	    W_log('反序列化用户信息，基本链接:'.$base_url);
		$arr = explode("/", $base_url);
		if (count($arr) == 5) {
			$gourl = $arr[2];
			$append = '/' . $arr[3];
			$this -> update_info_url($gourl, $wxid, $append);
		} else {
			$gourl = $arr[2];
			$this -> update_info($gourl, $wxid);
		} 
	} 
	public function mydebug($textTpl, $fromUsername, $toUsername, $time, $contents) {
		if ($fromUsername == 'oXcUzuDVEDbMarygeXUtFCRgbl7s') {
			$msgType = "text";
			$contentStr = $contents;
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		} 
	} 
	public function curl_get_contents($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
		curl_setopt($ch, CURLOPT_REFERER, _REFERER_);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		} 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	} 
	public function curl_grab_page($url, $data, $proxy = '', $proxystatus = '', $ref_url = '') {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if ($proxystatus == 'true') {
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		} 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		if (!empty($ref_url)) {
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_REFERER, $ref_url);
		} 
		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		} 
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		ob_start();
		return curl_exec ($ch);
		ob_end_clean();
		curl_close ($ch);
		unset($ch);
	} 
	public function guolv($str) {
		$str = str_replace("\r", "", $str);
		$str = str_replace("\n", "", $str);
		$str = str_replace("\t", "", $str);
		$str = str_replace("\r\n", "", $str);
		$str = trim($str);
		return $str;
	} 
	private function checkSignature($db) {
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$ret = $db -> getRow("SELECT * FROM `wxch_config` WHERE `id` = 1");
		$token = $ret['token'];
       // W_log('token  => ' .$token ) ;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
      //  W_log('tmpStr: ' .$tmpStr ) ;
      //  W_log('signature : '.$signature ) ;
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		} 
	} 
	private function update_info($host, $wxid) {
	    W_log('调用更新用户信息函数');
		if (function_exists(fsockopen)) {
			$fp = fsockopen("$host", 80, $errno, $errstr, 10);
		} else {
			$fp = pfsockopen("$host", 80, $errno, $errstr, 10);
		} 
		$url = "/wechat/userinfo.php?wxid=$wxid";
		if (!$fp) {
			echo "$errstr $errno <br />\n";
		} else {
			$out = "GET  $url HTTP/1.1\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$inheader = 1;
			$result = '';
			while (!feof($fp)) {
				$line = fgets($fp, 1024);
				if ($inheader && ($line == "\n" || $line == "\r\n")) {
					$inheader = 0;
				} 
				if ($inheader == 0) {
					$result .= trim($line);
				} 
			} 
			fclose($fp);
		} 
	} 
	private function update_info_url($host, $wxid, $append) {
	    W_log('调用更新链接');
		if (function_exists(fsockopen)) {
			$fp = fsockopen("$host", 80, $errno, $errstr, 10);
		} else {
			$fp = pfsockopen("$host", 80, $errno, $errstr, 10);
		} 
		$url = $append . "/wechat/userinfo.php?wxid=$wxid";
		if (!$fp) {
			echo "$errstr $errno <br />\n";
		} else {
			$out = "GET  $url HTTP/1.1\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$inheader = 1;
			$result = '';
			while (!feof($fp)) {
				$line = fgets($fp, 1024);
				if ($inheader && ($line == "\n" || $line == "\r\n")) {
					$inheader = 0;
				} 
				if ($inheader == 0) {
					$result .= trim($line);
				} 
			} 
			fclose($fp);
		} 
	}
	
	private  function resizejpg($imgsrc,$imgwidth,$imgheight,$time) 
	{ 
		//$imgsrc jpg格式图像路径 $imgdst jpg格式图像保存文件名 $imgwidth要改变的宽度 $imgheight要改变的高度 
		//取得图片的宽度,高度值 
		$arr = getimagesize($imgsrc); 
		header("Content-type: image/jpg"); 
		$imgWidth = $imgwidth; 
		$imgHeight = $imgheight; 
		$imgsrc = imagecreatefromjpeg($imgsrc); 
		$image = imagecreatetruecolor($imgWidth, $imgHeight);
		imagecopyresampled($image, $imgsrc, 0, 0, 0, 0,$imgWidth,$imgHeight,$arr[0], $arr[1]);
		$name="../qrcode/".$time.".jpg";  
		Imagejpeg($image,$name);
		return $name;
	}
	//客服接口的实现；
    function customText($access_token, $openid){
                $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
                $data = '{
    "touser":"'.$openid.'",
    "msgtype":"text",
    "text":
    {
         "content":"正在为您生成您的专属推广二维码，如网络原因生成失败请联系在线客服处理！"
    }
}';
                $result = $this->https_request($url, $data);
        }
	
    private function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

    //新增
    function htmltowei($contents)
{
	$contents = strip_tags($contents,'<br>');
	$contents = str_replace('<br />',"\r\n",$contents);
	$contents = str_replace('&quot;','"',$contents);
	$contents = str_replace('&nbsp;','',$contents);
	return $contents;
}

	 /*甜心*/
    function downloadimageformweixin($url) {  
          
        $ch = curl_init ();  
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );  
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );  
        curl_setopt ( $ch, CURLOPT_URL, $url );  
        ob_start ();  
        curl_exec ( $ch );  
        $return_content = ob_get_contents ();  
        ob_end_clean ();  
          
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );  
        return $return_content;  
    }
	/*甜。。心100开发修复生成随机密码*/
	function randomkeys($length)
	{
		$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
		for($i=0;$i<$length;$i++)
		{
			$key .= $pattern{mt_rand(0,35)};    //生成php随机数
		}
		return $key;
	}
    function kefureturn($access_token, $openid){
                $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
                $data = '{
						"touser":"'.$openid.'",
						"msgtype":"text",
						"text":
						{
							 "content":"正在为您转接微信客服！"
						}
					}';
                $result = $this->https_request($url, $data);
        }	
} 
