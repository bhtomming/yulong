<?php
define('IN_ECTOUCH', true);
error_reporting(1);
require(dirname(__FILE__) . '/../include/init.php');

require_once(ROOT_PATH . 'include/waf.php');
require('callback-ent.php');
$wechatObj = new wechatCallbackapi();
$ecdb -> prefix = $ecs -> prefix;
$wechatObj -> valid($db,$ecdb);
$base_url = 'http://' . $_SERVER['SERVER_NAME'] . '/';
$db -> prefix = $ecs -> prefix;
$wechatObj -> responseMsg($db, $user, $base_url);

?>