<?php

/**
 * ECSHOP 后门清除工具
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
require_once(ROOT_PATH . 'include/waf.php');


//LHF 测试 订单
if($_GET['lhf']){

    var_dump($_SERVER);
//    echo ROOT_PATH . DATA_DIR . '/log.txt' ;
    file_put_contents(ROOT_PATH . DATA_DIR . '/log_1.txt', print_r($_GET,true));

    die ;
}

//判断是否有ajax请求
$act = !empty($_GET['act']) ? $_GET['act'] : '';


if ($act == 'removeuser')
{
    /* 检查权限 */

    $wx_user_id = $_GET['uid'];
    if(!$wx_user_id) die("用户ID不能为空");
    $sql = "SELECT user_name FROM " . $ecs->table('users') . " WHERE user_id = '" . $wx_user_id . "'";
    $username = $db->getOne($sql);

    if(!$username) die("用户不存在");

    /* 通过插件来删除用户 */
    $users = &init_users();
    $users->remove_user($username); //已经删除用户所有数据
    //删除 wxch_user wxch_qr wxch_qr_tianxin100
    $sql_wxch = "DELETE FROM wxch_user WHERE wxid = '$wx_user_id' ";  //删除会员表
    $GLOBALS['db']->query($sql_wxch);
    $sql_wxch = "DELETE FROM wxch_qr WHERE scene_id = '$wx_user_id' ";//删除二维码
    $GLOBALS['db']->query($sql_wxch);
    $sql_wxch = "DELETE FROM wxch_qr_tianxin100 WHERE scene_id = '$wx_user_id' ";//删除二维码
    $GLOBALS['db']->query($sql_wxch);
    /* 记录管理员操作 */
  //  admin_log(addslashes($username), 'remove', 'users');

    die( $username ." 用户已经被删除");
}
elseif ($act == 'removesession')
{
    session_destroy();
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, null);
    }
    die('已清除');
}
elseif ($act == 'showsession')
{
    echo "<pre><br>SESSION => ";
    echo print_r($_SESSION,true);
    echo "<br><br>COOKIE =》";
    echo print_r($_COOKIE,true);
    die;
}
elseif ($act == 'login')
{

    die;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<style>
    * {font-size: 20px;}
    li { line-height: 50px; }
</style>
<ul>
    <li><a href="tools.php?act=removeuser&uid=">删除会员</a></li>
    <li><a href="tools.php?act=removesession">清空session cookie</a></li>
    <li><a href="tools.php?act=showsession">显示session cookie</a></li>
    <li><a href="tools.php?act=login&uid=">会员登录</a></li>
    </ul>
</body>
</html>