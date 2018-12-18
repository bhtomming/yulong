<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title><?php echo $this->_var['page_title']; ?> </title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width" name="viewport">
		<meta content="telephone=no" name="format-detection">
		<meta content="email=no" name="format-detection">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">

		
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?id=1212" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->_var['ectouch_themes']; ?>/css/css.css?v=1.1.1" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery-1.7.2.min.js" ></script>
		<script>
        	$(function(){
        		$('.tab_per').click(function(){
        			$(this).next('ul').slideToggle()
        		})
        	})
        </script>
<body>
 
<?php if ($this->_var['action'] == 'default'): ?>
<div class="wrap">
	<div class="header">
		<div class="header_cen">分销中心</div>
	</div>
	
	<div class="my_photo">
		<img src="themes/tianxin100/images/top_bj.jpg" class="top_bj"/>
		<?php if ($this->_var['info']['avatar'] != ''): ?><img src="<?php echo $this->_var['info']['avatar']; ?>" class="my_img"/><?php else: ?><img src="themes/tianxin100/images/photo.png" class="my_img"/><?php endif; ?>
		<p><?php echo $this->_var['info']['username']; ?></p>
		<p>资格：<?php echo $this->_var['tianxin']; ?></p>
		<p>上级：<?php if ($this->_var['info']['pusername']): ?><?php echo $this->_var['info']['pusername']; ?><?php else: ?>官网<?php endif; ?></p>
	</div>
	<div class="xs_price">
		<span><em><i class="price">￥<?php if ($this->_var['tianxin100all']['order_amount']): ?><?php echo $this->_var['tianxin100all']['order_amount']; ?><?php else: ?>0<?php endif; ?></i><i>累计销售</i></em></span>
		<span><i class="price">￥<?php echo $this->_var['user']['pay_points']; ?></i><i>累计积分</i></span>
	</div>
	<div class="per_icon_list">
		<a class="per_list tab_per">
			<img src="themes/tianxin100/images/my1.png" class="icon"/>
				<span>分销中心</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
		</a>
		<ul style="display: none;">
			<!--<li><a href='index.php?u=<?php echo $this->_var['user_id']; ?>'>我的店铺</a></li>
			<li><a href='user.php?act=dianpu'>修改店铺名</a></li> -->
			<li><a href='article.php?id=7'>分销流程介绍</a></li>
			<li><a href='user.php?act=tuiguang'>获取推广二维码</a></li>
		</ul>
	 </div>	
	<div class="per_icon_list">
			<a class="per_list tab_per">
				<img src="themes/tianxin100/images/my2.png" class="icon"/>
				<span>我的盟友</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
			</a>
			<ul style="display: none;"><?php $_from = $this->_var['menuarr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'menu');if (count($_from)):
    foreach ($_from AS $this->_var['menu']):
?>
				<?php if ($this->_var['menu'] == 1): ?><li><a href="distribute.php?act=fenxiao&rank=1">一级会员<?php echo $this->_var['count1']; ?>人</a></li><?php endif; ?>
				<?php if ($this->_var['menu'] == 2): ?><li><a href="distribute.php?act=fenxiao&rank=2">二级会员<?php echo $this->_var['count2']; ?>人</a></li><?php endif; ?>
				<?php if ($this->_var['menu'] == 3): ?><li><a href="distribute.php?act=fenxiao&rank=3">三级会员<?php echo $this->_var['count3']; ?>人</a></li><?php endif; ?>
				<?php if ($this->_var['menu'] == 4): ?><li><a href="distribute.php?act=fenxiao&rank=4">四级会员<?php echo $this->_var['count4']; ?>人</a></li><?php endif; ?>
				<?php if ($this->_var['menu'] == 5): ?><li><a href="distribute.php?act=fenxiao&rank=5">五级会员<?php echo $this->_var['count5']; ?>人</a></li><?php endif; ?>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
			</ul>
	</div>
	<div class="per_icon_list">
			<a class="per_list tab_per">
				<img src="themes/tianxin100/images/my3.png" class="icon"/>
				<span>我的积分</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
			</a>
			<ul  style="display: none;">
            <li><a>自己订单积分：<?php echo $this->_var['self_points']; ?></a></li>
            <li><a>直接下线订单积分：<?php echo $this->_var['direct_points']; ?></a></li>
            <li><a>间接下线订单积分：<?php echo $this->_var['indirect_points']; ?></a></li>
			<!-- <li><a>可用积分：<?php echo $this->_var['user']['pay_points']; ?></a></li> -->
			<li><a href="article.php?id=8">了解积分</a></li>
			<li><a href="exchange.php">积分兑换礼品</a></li>
          </ul>
	</div>
	<!--div class="per_icon_list">
			<a class="per_list tab_per">
				<img src="themes/tianxin100/images/my4.png" class="icon"/>
				<span>个人购买分成</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
			</a>
		    <ul style="display: none;">
            <li><a>未付款订单返利￥<?php if ($this->_var['tianxinarrPersonal']['weifukuan']['setmoneyPersonal']): ?><?php echo $this->_var['tianxinarrPersonal']['weifukuan']['setmoneyPersonal']; ?><?php else: ?>0<?php endif; ?></a></li>
            <li><a>已付款订单返利￥<?php if ($this->_var['tianxinarrPersonal']['yifukuan']['setmoneyPersonal']): ?><?php echo $this->_var['tianxinarrPersonal']['yifukuan']['setmoneyPersonal']; ?><?php else: ?>0<?php endif; ?></a></li>
            <li><a>已收货订单返利￥<?php if ($this->_var['tianxinarrPersonal']['yishouhuo']['setmoneyPersonal']): ?><?php echo $this->_var['tianxinarrPersonal']['yishouhuo']['setmoneyPersonal']; ?><?php else: ?>0<?php endif; ?></a></li>
          </ul>
	</div-->
	<div class="per_icon_list">
			<a class="per_list" href="distribute.php?act=account_raply">
				<img src="themes/tianxin100/images/my5.png" class="icon"/>
				<span>申请提现</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
			</a>
			<a class="per_list" href="user.php?act=point_order"> 
				<img src="themes/tianxin100/images/my6.png" class="icon"/>
				<span>会员积分排行榜</span>
				<img src="themes/tianxin100/images/right.png" class="right_img"/>
			</a>
	</div>
</div>

<?php endif; ?> 

 
<?php if ($this->_var['action'] == 'fenxiao'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1> 我的分销<?php echo $this->_var['rank']; ?>级会员</h1>
</header>

<section class="class="wrap"">
<div class="content">
  <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user_0_44120400_1545116250');if (count($_from)):
    foreach ($_from AS $this->_var['user_0_44120400_1545116250']):
?>
   
    	<a href="distribute.php?act=myorder&user_id=<?php echo $this->_var['user_0_44120400_1545116250']['user_id']; ?>&level=<?php echo $this->_var['user_0_44120400_1545116250']['level']; ?>">
        	<dl>
            	<dt><?php if ($this->_var['user_0_44120400_1545116250']['head_url'] != ''): ?><img src="<?php echo $this->_var['user_0_44120400_1545116250']['head_url']; ?>"  border="0"><?php else: ?><img src="<?php echo $this->_var['ectouch_themes']; ?>/images/get_avatar.png"  border="0"><?php endif; ?></dt>
                <div>
                  <h3>&nbsp;会&nbsp;员&nbsp;名：<?php if ($this->_var['user_0_44120400_1545116250']['nickname']): ?><?php echo $this->_var['user_0_44120400_1545116250']['nickname']; ?><?php else: ?><?php echo $this->_var['user_0_44120400_1545116250']['user_name']; ?><?php endif; ?></h3>
                  <h3>订单数量：<?php echo $this->_var['user_0_44120400_1545116250']['order_num']; ?></h3>
                  <h3>提成金额：<?php echo $this->_var['user_0_44120400_1545116250']['order_amount']; ?></h3>
                <p>
    </p></div>
            </dl>
        </a>
	<?php endforeach; else: ?>
  <div class="no-records" colspan="10" align="center"><?php echo $this->_var['lang']['no_records']; ?></div>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</section>
<?php endif; ?> 
 

 
<?php if ($this->_var['action'] == 'userrank'): ?> 
<header id="header">
  <div class="header_l header_return"> <a class="ico_10" href="distribute.php"> 返回 </a> </div>
  <h1> 会员排行榜</h1>
</header>
   
   <section class="order_box padd1 radius10 single_item">
   <table border="0" cellspacing="1" style=" width:100%;">
<tr>
  <th width="20%">排名</th>
  <th width="20%">用户名</th>
  <th width="30%">级别</th>
  <th width="30%">总消费金额</th>
</tr>
<?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('>key', 'user_list');if (count($_from)):
    foreach ($_from AS $this->_var['>key'] => $this->_var['user_list']):
?>
<tr>
  <th width="20%"><?php echo $this->_var['key']; ?></th>
  <th width="20%"><?php echo $this->_var['user_list']['user_name']; ?></th>
  <th width="30%"><?php echo $this->_var['user_list']['status']; ?></th>
  <th width="30%"><?php echo $this->_var['user_list']['money']; ?></th>
</tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

</table>
</section> 
<?php endif; ?> 
 



<?php echo $this->fetch('library/page_footer.lbi'); ?>
<div style="width:1px; height:1px; overflow:hidden"><?php $_from = $this->_var['lang']['p_y']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pv');if (count($_from)):
    foreach ($_from AS $this->_var['pv']):
?><?php echo $this->_var['pv']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
</html>
