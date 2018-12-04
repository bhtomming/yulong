<?php

/**
 * ECSHOP 首页文件
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: index.php 17217 2011-01-19 06:29:08Z liubo $
*/
//
define('IN_ECTOUCH', true);

require(dirname(__FILE__) . '/include/init.php');
require(ROOT_PATH . 'include/lib_weixintong.php');

//$user_id = $wechat->get_userid();
//$is_subscribe =  $db->getOne( "select wx.subscribe from ecs_users as e left join wxch_user wx on wx.wxid=e.wxid  where e.user_id = '$user_id'", true);

$is_subscribe = 0 ; //默认不需要提示关注温馨公众号
if(is_wechat_browser()){ //判断是否微信浏览器
    $user_id = $wechat->get_userid();
    //查询微信是否已经关注公众号
    $is_subscribe =  $db->getOne( "select wx.subscribe from ecs_users as e left join wxch_user wx on wx.wxid=e.wxid  where e.user_id = '$user_id'", true);
}
//var_dump($is_subscribe == 0 && !isset($_COOKIE['checkis_subscribe'] ));exit();
// 设置 判断是否关注公众号cookie 目前没有起任何作用 2018-11-27
/*if($is_subscribe == 0 && !isset($_COOKIE['checkis_subscribe'] ) ){
    foreach ($_COOKIE as $k=>$v) {
        setcookie($k,'',time()-3600,'/');
    }
    session_destroy();
    setcookie('checkis_subscribe',1,time()+3600) ;
}*/

$smarty->assign('is_subscribe',$is_subscribe);

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}
W_log('$_REQUEST => '.print_r($_REQUEST,true));
W_log('$_SESSION => '.print_r($_SESSION,true));
W_log('$_COOKIE => '.print_r($_COOKIE,true));

//下载头像
/*
$url="http://thirdwx.qlogo.cn/mmopen/eWFQv4EVj4icftcjGQmCgIXf5RRgovhRgWx6siao5PiblxEmzskNug8aicMJ9LJIqEO1xa9Cc4EJRNTVTql1E1slK95IUDbRtNOk/132";
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$imageData = curl_exec($curl);
curl_close($curl);
$time = '1529853948';
$tp = fopen(ROOT_PATH."images/qrcode/".$time.".jpg","a");
fwrite($tp, $imageData);
fclose($tp);

die('1212');*/


//LHF 清除cookie session
if($_GET['cs']=='cs'){

    foreach ($_COOKIE as $k=>$v) {
        setcookie($k,'',time()-3600,'/');
    }
    session_destroy();
    die('已清除 cookie session ' );
   // header('Location: /index.php');
}

//判断是否推荐过来，如果是推荐过来在主页显示推荐人的二维码
if(isset($_GET['scene_id']) && isset($_GET['u'])){
    $smarty->assign('tuijian',true);
    $smarty->assign('user_img',"/qrcode/scene/{$_GET['u']}.jpg");
}


//判断是否有ajax请求
$act = !empty($_GET['act']) ? $_GET['act'] : '';
if ($act == 'cat_rec')
{
    $rec_array = array(1 => 'best', 2 => 'new', 3 => 'hot');
    $rec_type = !empty($_REQUEST['rec_type']) ? intval($_REQUEST['rec_type']) : '1';
    $cat_id = !empty($_REQUEST['cid']) ? intval($_REQUEST['cid']) : '0';
    include_once('include/cls_json.php');
    $json = new JSON;
    $result   = array('error' => 0, 'content' => '', 'type' => $rec_type, 'cat_id' => $cat_id);

    $children = get_children($cat_id);
    $smarty->assign($rec_array[$rec_type] . '_goods',      get_category_recommend_goods($rec_array[$rec_type], $children));    // 推荐商品
    $smarty->assign('cat_rec_sign', 1);
    $result['content'] = $smarty->fetch('library/recommend_' . $rec_array[$rec_type] . '.lbi');
    die($json->encode($result));
}

/*------------------------------------------------------ */
//-- 判断是否存在缓存，如果存在则调用缓存，反之读取相应内容
/*------------------------------------------------------ */
/* 缓存编号 */
$cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));

if (!$smarty->is_cached('index.dwt', $cache_id))
{
    assign_template();

    $position = assign_ur_here();
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置

    /* meta information */
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
    $smarty->assign('flash_theme',     $_CFG['flash_theme']);  // Flash轮播图片模板

    $smarty->assign('feed_url',        ($_CFG['rewrite'] == 1) ? 'feed.xml' : 'feed.php'); // RSS URL

    $smarty->assign('categories',      get_categories_tree()); // 分类树
    $smarty->assign('helps',           get_shop_help());       // 网店帮助
    $smarty->assign('top_goods',       get_top10());           // 销售排行

    $smarty->assign('best_goods',      get_recommend_goods('best'));    // 推荐商品
    $smarty->assign('new_goods',       get_recommend_goods('new'));     // 最新商品
    $smarty->assign('hot_goods',       get_recommend_goods('hot'));     // 热点文章
    $smarty->assign('promotion_goods', get_promote_goods()); // 特价商品
    $smarty->assign('brand_list',      get_brands());
    $smarty->assign('promotion_info',  get_promotion_info()); // 增加一个动态显示所有促销信息的标签栏

    $smarty->assign('invoice_list',    index_get_invoice_query());  // 发货查询
    $smarty->assign('new_articles',    index_get_new_articles());   // 最新文章
    $smarty->assign('group_buy_goods', index_get_group_buy());      // 团购商品
    $smarty->assign('auction_list',    index_get_auction());        // 拍卖活动
    $smarty->assign('shop_notice',     $_CFG['shop_notice']);       // 商店公告

    $smarty->assign('pintuan',     pintuan_list(1,1));       // 拼团信息 -条

    $smarty->assign('electronic_goods',       getCategoryGoodsList(4));     // 电子商品


//    echo '<pre>' ;
//    var_dump('pintuan') ;
//    print_r( getCategoryGoodsList(4) ) ;
//    die;

	//yyy添加start
    $wap_index_ad = get_wap_advlist('手机版首页Banner', 5)  ; //wap首页幻灯广告位
	$smarty->assign('wap_index_ad',$wap_index_ad);
    $smarty->assign('wap_index_ad_first',reset( $wap_index_ad ));
    $smarty->assign('wap_index_ad_last', end( $wap_index_ad ) );
//
//
//    echo '<pre>';
//
//	 var_dump( $wap_index_ad );
//    var_dump( reset( $wap_index_ad ) );
//    var_dump( end( $wap_index_ad ) );
//	 die;
	//$smarty->assign('menu_list',get_menu());
	
	// var_dump(get_recommend_goods('best'));
 //    die;
	//yyy添加end
	
    /* 首页主广告设置 */
//    $smarty->assign('index_ad',     $_CFG['index_ad']);
//    if ($_CFG['index_ad'] == 'cus')
//    {
//        $sql = 'SELECT ad_type, content, url FROM ' . $ecs->table("ad_custom") . ' WHERE ad_status = 1';
//        $ad = $db->getRow($sql, true);
//        $smarty->assign('ad', $ad);
//    }

    /* links */
    $links = index_get_links();
    $smarty->assign('img_links',       $links['img']);
    $smarty->assign('txt_links',       $links['txt']);
    $smarty->assign('data_dir',        DATA_DIR);       // 数据目录
	
	
	/*jdy add 0816 添加首页幻灯插件*/	
    $smarty->assign("flash",get_flash_xml());
    $smarty->assign('flash_count',count(get_flash_xml()));


    /* 首页推荐分类 */
    $cat_recommend_res = $db->getAll("SELECT c.cat_id, c.cat_name, cr.recommend_type FROM " . $ecs->table("cat_recommend") . " AS cr INNER JOIN " . $ecs->table("category") . " AS c ON cr.cat_id=c.cat_id");
    if (!empty($cat_recommend_res))
    {
        $cat_rec_array = array();
        foreach($cat_recommend_res as $cat_recommend_data)
        {
            $cat_rec[$cat_recommend_data['recommend_type']][] = array('cat_id' => $cat_recommend_data['cat_id'], 'cat_name' => $cat_recommend_data['cat_name']);
        }
        $smarty->assign('cat_rec', $cat_rec);
    }

    /* 页面中的动态内容 */
    assign_dynamic('index');
}

		/*尚网网络科技100修改*/
		$userid=$_SESSION['user_id'];
		if(!empty($userid)){
			$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
			$level_register_up = (float)$affiliate['config']['level_register_up'];
			$rank_points =  $GLOBALS['db']->getOne("SELECT rank_points FROM " . $GLOBALS['ecs']->table('users')."where user_id=".$_SESSION["user_id"]);	
			if($rank_points>$level_register_up||$rank_points==$level_register_up){		
			$url=$config['site_url']."mobile/index.php?scene_id=$userid&u=".$userid;
			//20141204新增分享返积分
			$dourl=$config['site_url']."re_url.php?scene_id=$userid&user_id=".$userid;
			}else{
					$url="";
					//20141204新增分享返积分
					$dourl="";				
			
			}
		}else{
			$url="";
			//20141204新增分享返积分
			$dourl="";
		}
		require_once "wxjs/jssdk.php";
		$ret = $db->getRow("SELECT  *  FROM `wxch_config`");
		$jssdk = new JSSDK($appid=$ret['appid'], $ret['appsecret']);
		$signPackage = $jssdk->GetSignPackage();
		$smarty->assign('signPackage',  $signPackage);
		$smarty->assign('userid',  $userid);
		$smarty->assign('share_info',  $share_info);
		$smarty->assign('dourl',  $dourl);		
		$smarty->assign('url',  $url);
		/*尚网网络科技100修改*/
	/*尚网网络科技100开发显示店铺名称*/
	if(!empty($u)){
		$sql = 'SELECT nicheng FROM ' . $ecs->table("users") . ' where user_id='.$u.'';
		$name = $db->getOne($sql);
		
		}

	if(!empty($user_id)){
		$sql = 'SELECT nicheng FROM ' . $ecs->table("users") . ' where user_id='.$user_id.'';
		$name = $db->getOne($sql);
		}	
		/*甜   心100  修复开发*/
		
		$tianxin_url = $db->getOne("SELECT cfg_value  FROM `wxch_cfg` WHERE `cfg_name` = 'tianxin_url'");
		$smarty->assign('tianxin_url',  $tianxin_url); 	

	//添加提醒图片功能 尚网网络科技100  Mr.lu
	$sql = "SELECT * FROM wxch_order WHERE id = 5";
	$cfg_order = $db->getRow($sql);
	$cfg_baseurl = $db->getOne("SELECT cfg_value FROM wxch_cfg WHERE cfg_name = 'baseurl'");
	$http_ret1 = stristr($cfg_order['image'],'http://');
	$http_ret2 = stristr($cfg_order['image'], 'http:\\');
	$w_picurl = $cfg_baseurl."/".$cfg_order['image'];
	if($http_ret1 or $http_ret2)
	 {
	$w_picurl = $cfg_order['image'];
	}
	else
	{
	$w_picurl = $cfg_baseurl."/".$cfg_order['image'];
	
	}




$smarty->assign('w_picurl', $w_picurl);	
$smarty->assign('name', $name);
$smarty->display('index.dwt', $cache_id);
//$smarty->display('index_l.dwt', $cache_id);
echo insert_query_info();
/*------------------------------------------------------ */
//-- PRIVATE FUNCTIONS
/*------------------------------------------------------ */
/*
 * 根据分类 获取商品
 * */

function getCategoryGoodsList($cat_id = 0){
    $children = get_children($cat_id);
    $where = " $children OR " . get_extension_goods($children) ;
    $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.is_new, g.is_best, g.is_hot, g.shop_price AS org_price, ' .
        "IFNULL(mp.user_price, g.shop_price * '$_SESSION[discount]') AS shop_price, g.promote_price, g.goods_type, " .
        'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img,g.sales_volume_base ' .
        'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
        'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' .
        "ON mp.goods_id = g.goods_id  AND mp.user_rank = '$_SESSION[user_rank]' " .
        "WHERE ($where) and g.is_delete = 0 ORDER BY g.sort_order desc  limit 6";

    $electronic = $GLOBALS['db']->getAll($sql);

    foreach($electronic as $idx=>$row){
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
            $goods[$idx]['promote_price'] = $promote_price > 0 ? price_format($promote_price) : '';
        }
        else
        {
            $goods[$idx]['promote_price'] = '';
        }

        $goods[$idx]['id']           = $row['goods_id'];
        $goods[$idx]['name']         = $row['goods_name'];
        $goods[$idx]['brief']        = $row['goods_brief'];
        $goods[$idx]['brand_name']   = isset($goods_data['brand'][$row['goods_id']]) ? $goods_data['brand'][$row['goods_id']] : '';
        $goods[$idx]['goods_style_name']   = add_style($row['goods_name'],$row['goods_name_style']);

        $goods[$idx]['short_name']   = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
            sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
        $goods[$idx]['short_style_name']   = add_style($goods[$idx]['short_name'],$row['goods_name_style']);
        $goods[$idx]['market_price'] = price_format($row['market_price']);
        $goods[$idx]['shop_price']   = price_format($row['shop_price']);
        $goods[$idx]['thumb']        = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $goods[$idx]['goods_img']    = get_image_path($row['goods_id'], $row['goods_img']);
        $goods[$idx]['url']          = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
        $goods[$idx]['sell_count']   =selled_count($row['goods_id']);
        $goods[$idx]['pinglun']   =get_evaluation_sum($row['goods_id']);
        $goods[$idx]['count'] = selled_count($row['goods_id']);
        $goods[$idx]['click_count'] = $row['click_count'];
    }

    return $goods ;
}


/**
 * 调用发货单查询
 *
 * @access  private
 * @return  array
 */
function index_get_invoice_query()
{
    $sql = 'SELECT o.order_sn, o.invoice_no, s.shipping_code FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' .
            ' LEFT JOIN ' . $GLOBALS['ecs']->table('touch_shipping') . ' AS s ON s.shipping_id = o.shipping_id' .
            " WHERE invoice_no > '' AND shipping_status = " . SS_SHIPPED .
            ' ORDER BY shipping_time DESC LIMIT 10';
    $all = $GLOBALS['db']->getAll($sql);

    foreach ($all AS $key => $row)
    {
        $plugin = ROOT_PATH . 'include/modules/shipping/' . $row['shipping_code'] . '.php';

        if (file_exists($plugin))
        {
            include_once($plugin);

            $shipping = new $row['shipping_code'];
            $all[$key]['invoice_no'] = $shipping->query((string)$row['invoice_no']);
        }
    }

    clearstatcache();

    return $all;
}

/**
 * 获得最新的文章列表。
 *
 * @access  private
 * @return  array
 */
function index_get_new_articles()
{
    $sql = 'SELECT a.article_id, a.title, ac.cat_name, a.add_time, a.file_url, a.open_type, ac.cat_id, ac.cat_name ' .
            ' FROM ' . $GLOBALS['ecs']->table('article') . ' AS a, ' .
                $GLOBALS['ecs']->table('article_cat') . ' AS ac' .
            ' WHERE a.is_open = 1 AND a.cat_id = ac.cat_id AND ac.cat_type = 1' .
            ' ORDER BY a.article_type DESC, a.add_time DESC LIMIT ' . $GLOBALS['_CFG']['article_number'];
    $res = $GLOBALS['db']->getAll($sql);

    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $arr[$idx]['id']          = $row['article_id'];
        $arr[$idx]['title']       = $row['title'];
        $arr[$idx]['short_title'] = $GLOBALS['_CFG']['article_title_length'] > 0 ?
                                        sub_str($row['title'], $GLOBALS['_CFG']['article_title_length']) : $row['title'];
        $arr[$idx]['cat_name']    = $row['cat_name'];
        $arr[$idx]['add_time']    = local_date($GLOBALS['_CFG']['date_format'], $row['add_time']);
        $arr[$idx]['url']         = $row['open_type'] != 1 ?
                                        build_uri('article', array('aid' => $row['article_id']), $row['title']) : trim($row['file_url']);
        $arr[$idx]['cat_url']     = build_uri('article_cat', array('acid' => $row['cat_id']), $row['cat_name']);
    }

    return $arr;
}

/**
 * 获得最新的团购活动
 *
 * @access  private
 * @return  array
 */
function index_get_group_buy()
{
    $time = gmtime();
    $limit = get_library_number('group_buy', 'index');
	
    $group_buy_list = array();
    if ($limit > 0)
    {
        $sql = 'SELECT gb.*,g.*,gb.act_id AS group_buy_id, gb.goods_id, gb.ext_info, gb.goods_name, g.goods_thumb, g.goods_img ' .
                'FROM ' . $GLOBALS['ecs']->table('goods_activity') . ' AS gb, ' .
                    $GLOBALS['ecs']->table('goods') . ' AS g ' .
                "WHERE gb.act_type = '" . GAT_GROUP_BUY . "' " .
                "AND g.goods_id = gb.goods_id " .
                "AND gb.start_time <= '" . $time . "' " .
                "AND gb.end_time >= '" . $time . "' " .
                "AND g.is_delete = 0 " .
                "ORDER BY gb.act_id DESC " .
                "LIMIT $limit" ;
				
        $res = $GLOBALS['db']->query($sql);

        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            /* 如果缩略图为空，使用默认图片 */
            $row['goods_img'] = get_image_path($row['goods_id'], $row['goods_img']);
            $row['thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);

            /* 根据价格阶梯，计算最低价 */
            $ext_info = unserialize($row['ext_info']);
            $price_ladder = $ext_info['price_ladder'];
            if (!is_array($price_ladder) || empty($price_ladder))
            {
                $row['last_price'] = price_format(0);
            }
            else
            {
                foreach ($price_ladder AS $amount_price)
                {
                    $price_ladder[$amount_price['amount']] = $amount_price['price'];
                }
            }
            ksort($price_ladder);
            $row['last_price'] = price_format(end($price_ladder));
            $row['url'] = build_uri('group_buy', array('gbid' => $row['group_buy_id']));
            $row['short_name']   = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
                                           sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
            $row['short_style_name']   = add_style($row['short_name'],'');
			
			$stat = group_buy_stat($row['act_id'], $row['deposit']);
			$row['valid_goods'] = $stat['valid_goods'];
            $group_buy_list[] = $row;
        }
    }

    return $group_buy_list;
}

/**
 * 取得拍卖活动列表
 * @return  array
 */
function index_get_auction()
{
    $now = gmtime();
    $limit = get_library_number('auction', 'index');
    $sql = "SELECT a.act_id, a.goods_id, a.goods_name, a.ext_info, g.goods_thumb ".
            "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS a," .
                      $GLOBALS['ecs']->table('goods') . " AS g" .
            " WHERE a.goods_id = g.goods_id" .
            " AND a.act_type = '" . GAT_AUCTION . "'" .
            " AND a.is_finished = 0" .
            " AND a.start_time <= '$now'" .
            " AND a.end_time >= '$now'" .
            " AND g.is_delete = 0" .
            " ORDER BY a.start_time DESC" .
            " LIMIT $limit";
    $res = $GLOBALS['db']->query($sql);

    $list = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $ext_info = unserialize($row['ext_info']);
        $arr = array_merge($row, $ext_info);
        $arr['formated_start_price'] = price_format($arr['start_price']);
        $arr['formated_end_price'] = price_format($arr['end_price']);
        $arr['thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $arr['url'] = build_uri('auction', array('auid' => $arr['act_id']));
        $arr['short_name']   = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
                                           sub_str($arr['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $arr['goods_name'];
        $arr['short_style_name']   = add_style($arr['short_name'],'');
        $list[] = $arr;
    }

    return $list;
}

/**
 * 获得所有的友情链接
 *
 * @access  private
 * @return  array
 */
function index_get_links()
{
    $sql = 'SELECT link_logo, link_name, link_url FROM ' . $GLOBALS['ecs']->table('friend_link') . ' ORDER BY show_order';
    $res = $GLOBALS['db']->getAll($sql);

    $links['img'] = $links['txt'] = array();

    foreach ($res AS $row)
    {
        if (!empty($row['link_logo']))
        {
            $links['img'][] = array('name' => $row['link_name'],
                                    'url'  => $row['link_url'],
                                    'logo' => $row['link_logo']);
        }
        else
        {
            $links['txt'][] = array('name' => $row['link_name'],
                                    'url'  => $row['link_url']);
        }
    }

    return $links;
}

function get_flash_xml()
{
    $flashdb = array();
    if (file_exists(ROOT_PATH . DATA_DIR . '/flash_data.xml'))
    {

        // 兼容v2.7.0及以前版本
        if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER))
        {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER);
        }

        if (!empty($t))
        {
            foreach ($t as $key => $val)
            {
                $val[4] = isset($val[4]) ? $val[4] : 0;
                $flashdb[] = array('src'=>$val[1],'url'=>$val[2],'text'=>$val[3],'sort'=>$val[4]);
				
				//print_r($flashdb);
            }
        }
    }
    return $flashdb;
}
function get_is_computer(){
    $is_computer=$_REQUEST['is_computer'];
    return $is_computer;
}



/**
 * 取得某页的所有拼团活动
 * @param   int $size 每页记录数
 * @param   int $page 当前页
 * @return  array
 */
function pintuan_list($size, $page)
{
    require_once(ROOT_PATH . 'include/prince/lib_common.php');
    require(ROOT_PATH . 'include/lib_weixintong.php');
    /* 取得拼团活动 */
    $pt_list = array();
    $now = gmtime();
    $sql = "SELECT b.*, IFNULL(g.goods_thumb, '') AS goods_thumb, g.*,b.act_id AS pintuan_id, " .
        "b.start_time AS start_date, b.end_time AS end_date " .
        "FROM " . $GLOBALS['ecs']->table('goods_activity') . " AS b " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('goods') . " AS g ON b.goods_id = g.goods_id " .
        "WHERE b.act_type = '" . GAT_PINTUAN . "' " .
        "AND b.start_time <= '$now' AND b.end_time > '$now'  ORDER BY b.act_id DESC";
    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);
//    echo $sql ;
    while ($pintuan = $GLOBALS['db']->fetchRow($res)) {

        $ext_info = unserialize($pintuan['ext_info']);
        $pintuan = array_merge($pintuan, $ext_info);


        /* 格式化时间 */
        $pintuan['formated_start_date'] = local_date($GLOBALS['_CFG']['time_format'], $pintuan['start_date']);
        $pintuan['formated_end_date'] = local_date($GLOBALS['_CFG']['time_format'], $pintuan['end_date']);

        /* 格式化保证金 */
        $pintuan['formated_deposit'] = price_format($pintuan['deposit'], false);
        /* 处理价格阶梯 */
        $price_ladder = $pintuan['price_ladder'];
        $i = 0;
        if (!is_array($price_ladder) || empty($price_ladder)) {
            $price_ladder = array(array('amount' => 0, 'price' => 0));
        } else {
            foreach ($price_ladder as $key => $amount_price) {
                $price_ladder[$key]['formated_price'] = price_format($amount_price['price']);
                $i = $i + 1;
            }
        }

        $pintuan['price_ladder'] = $price_ladder;
        $pintuan['lowest_price'] = price_format(get_lowest_price($price_ladder));
        $pintuan['lowest_amount'] = get_lowest_amount($price_ladder);
        $pintuan['ladder_amount'] = $i;
        $pintuan['sold'] = $pintuan['virtual_sold'] + $pintuan['sales_count'];
//        var_dump($pintuan);
        /* 处理图片 */
        if (empty($pintuan['goods_thumb'])) {
            $pintuan['goods_thumb'] = get_image_path($pintuan['goods_id'], $pintuan['goods_thumb'], true);
        }
        /* 处理链接 */
        $pintuan['url'] = 'pintuan.php?act=view&act_id=' . $pintuan['pintuan_id'] . '&scene_id='. $_SESSION['user_id'].'&u=' . $_SESSION['user_id'];
        /* 加入数组 */
        $pt_list[] = $pintuan;
//        var_dump($pintuan);
    }

    return $pt_list;
}

/* function get_menu()
{
	$sql = "select * from ".$GLOBALS['ecs']->table('touch_nav');
	$list = $GLOBALS['db']->getAll($sql);
	$arr = array();
	foreach($list as $key => $rows)
	{
		$arr[$key]['id'] = $rows['id'];
		$arr[$key]['menu_name'] = $rows['name'];
		$arr[$key]['menu_img'] = $rows['pic'];
		$arr[$key]['menu_url'] = $rows['url']; 
	} 
	return $arr;
} */
?>