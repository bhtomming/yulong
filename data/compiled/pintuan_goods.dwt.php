<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title><?php echo $this->_var['page_title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!--link href="pt_1.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<!--link href="css/pt_2.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['ectouch_themes']; ?>/css/style.css?v=1.1.1">
 <script>
           //通过window.screen.width获取屏幕的宽度
          var offWidth = window.screen.width / 30; //这里用宽度/30表示1rem取得的px
          document.getElementsByTagName("html")[0].style.fontSize = offWidth + 'px'; //把rem的值复制给顶级标签html的font-size
      </script>

	<link rel="stylesheet" href="<?php echo $this->_var['ectouch_themes']; ?>/css/mui.min.css?v=1.1.1">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['ectouch_themes']; ?>/css/style.css?v=1.1.1">

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,lefttime.js')); ?>
<script type="text/javascript" src="data/static/js/common1.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery-1.4.4.min.js"></script>
<script src="<?php echo $this->_var['ectouch_themes']; ?>/js/TouchSlide.js"></script>
<script type="text/javascript">
// 筛选商品属性
jQuery(function($) {
	$(".info").click(function(){
		$('.goodsBuy .fields').slideToggle("fast");
	});
})

onload = function(){
		<?php $_from = $this->_var['pintuan']['price_ladder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
		document.getElementById('number_<?php echo $this->_var['item']['amount']; ?>').value = 1;//更新数量
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
}

function changenum(diff) {
	var num = parseInt(document.getElementById('goods_number').value);
	var goods_number = num + Number(diff);
	if( goods_number >= 1){
		document.getElementById('goods_number').value = goods_number;//更新数量
		<?php $_from = $this->_var['pintuan']['price_ladder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
		document.getElementById('number_<?php echo $this->_var['item']['amount']; ?>').value = goods_number;//更新数量
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		document.getElementById('number_single_buy').value = goods_number;//更新数量
		changePrice();
	}
}
</script>
<script>
/* PRINCE */
function goBack(){  
   if(history.length > 1 ){  
          history.back(-1);  
    }else{  
          location.href = 'index.php';
    }  
} 
</script>
</head>
<body>
<div id="page" style="right: 0px; left: 0px; display: block;">
<?php if ($this->_var['cat_ad']['ad_code']): ?>
<img src="<?php echo $this->_var['cat_ad']['ad_code']; ?>" style="width: 100%;">
<?php endif; ?>

    <img alt="" src="<?php echo $this->_var['pintuan']['share_img']; ?>" style="width:100%;"/>



<div id="pintuan" class="goodsinfo clearfix">

	<div>
		<h3><?php echo htmlspecialchars($this->_var['pintuan']['act_name']); ?></h3>
		<span class="price">￥88</span>
		 <?php if ($this->_var['pintuan']['status'] == 1): ?>

		<?php $_from = $this->_var['pintuan']['price_ladder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <form action="pintuan.php?act=buy" method="post" name="form_<?php echo $this->_var['item']['amount']; ?>">
              <input type="hidden" name="act_id" value="<?php echo $this->_var['pintuan']['act_id']; ?>" />
              <input type="hidden" name="level" value="<?php echo $this->_var['item']['amount']; ?>" />
              <input type="hidden" id="number_<?php echo $this->_var['item']['amount']; ?>" name="number" value="1" />
            </form>
            <p class="clearfix"><span><?php echo $this->_var['item']['amount']; ?> 人拼团</span>
            <a href="javascript:form_<?php echo $this->_var['item']['amount']; ?>.submit();">去拼团</a> </p>

        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php elseif ($this->_var['pintuan']['status'] == 2): ?>
          <p class="clearfix"><span><?php echo $this->_var['item']['amount']; ?> 人拼团</span> <a href="pintuan.php" >活动已结束</a></p>
        <?php else: ?>
         <p class="clearfix"> <span><?php echo $this->_var['item']['amount']; ?> 人拼团</span><a href="pintuan.php" >活动未开始</a></p>
        <?php endif; ?>
	</div>
	<div>
	    <?php echo $this->_var['pintuan']['pintuan_desc']; ?>
	</div>
</div>
<div class="bottom-log">
    <img src="<?php echo $this->_var['ectouch_themes']; ?>/images/bottom-logo.png" />
    <p>玉泷商城期待您的加入!</p>
</div>



<?php if ($this->_var['new_pintuan']): ?>
<div class="bg2"></div>
<div class="title"><i></i>以下小伙伴正在发起拼团，您可以直接参加</div>
<div id="seller" class="box_two clearfix"  >

 <?php $_from = $this->_var['new_pintuan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pintuan_0_65780100_1545469527');if (count($_from)):
    foreach ($_from AS $this->_var['pintuan_0_65780100_1545469527']):
?>
      <a href="pintuan.php?act=pt_view&pt_id=<?php echo $this->_var['pintuan_0_65780100_1545469527']['pt_id']; ?>&u=<?php echo $this->_var['userid']; ?>&scene_id=<?php echo $this->_var['userid']; ?>" style=" width:100%; padding:0.5rem 0;">
      <table width="98%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
      <tr>
        <td align="left" bgcolor="#ffffff" rowspan="2" width="20%" >
          <?php if ($this->_var['pintuan_0_65780100_1545469527']['user_head']): ?>
         <img src="<?php echo $this->_var['pintuan_0_65780100_1545469527']['user_head']; ?>" style="width:50px;height:auto; margin-left:5px; margin-right:5px; margin-bottom:5px;" >
         <?php else: ?>
         <img src="themes/tianxin100/images/pt_icon_indexn_03.png" style="width:50px;height:auto;margin-left:5px; margin-right:5px;margin-bottom:5px;" >
        <?php endif; ?>
        </td>
        <td align="center" bgcolor="#ffffff" colspan="2">
        <em style="float:left;font-size:10px;  line-height:20px;margin-left:5px;">&nbsp;&nbsp;<?php echo $this->_var['pintuan_0_65780100_1545469527']['user_nickname']; ?></em>
        <em style="float:right;font-size:10px; color:#999; line-height:20px;">发起时间：<?php echo $this->_var['pintuan_0_65780100_1545469527']['create_time']; ?></em></td>
      </tr>
      <tr>
        <td align="left" bgcolor="#ffffff" width="30%" style=" border:solid 1px #D11303;font-size:10px; line-height:20px; margin-left:5px;">&nbsp;&nbsp;<?php echo $this->_var['pintuan_0_65780100_1545469527']['price']; ?>/件</td>
        <td align="left" bgcolor="#D11303" style=" border:solid 1px #D11303; font-size:10px; color:#FFFFFF; line-height:20px;margin-left:5px;">&nbsp;&nbsp;还差<?php echo $this->_var['pintuan_0_65780100_1545469527']['available_people']; ?>人,火速参团>></td>
      </tr>
     </table></a>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

</div>
<?php endif; ?>


<script type="text/javascript" src="themes/tianxin100/js/jquery-1.9.1.min.js"></script>
<script src="js/mui.min.js"></script>

<div class="activity_nav">
 <ul> 
 <li class="activity_bian"><a href="index.php"><em class="goods_nav1"></em><span>首页</span></a> </li>
 <li>
 <a  href="pintuan.php?act=userlist"><em class="goods_nav2"></em><span>我的拼团</span></a>
 </li>
 <li class="flow"><a class="button active_button" onclick="showFDiv();"><em class="goods_nav3"></em><span>分享活动<span></a> </li>
   <?php if ($this->_var['pintuan']['need_login'] && ( $this->_var['userid'] == 0 )): ?>
      <li class="goumai"><a style="display:block;" onclick="showReg();"><em class="goods_nav4"></em><span>发起拼团</span></a> </li>
   <?php else: ?>
      <li class="goumai"><a style="display:block;" href="#pintuan" ><em class="goods_nav4"></em><span>发起拼团</span></a> </li>
   <?php endif; ?>
 </ul>

</div>
 
</div>

    
         
        <script type="text/javascript">
            function showFDiv(){
                document.getElementById('popDiv').style.display = 'block';
				document.getElementById('hidDiv').style.display = 'block';
				document.getElementById('cartNum').innerHTML = document.getElementById('goods_number').value;
				document.getElementById('cartPrice').innerHTML = document.getElementById('ECS_GOODS_AMOUNT').innerHTML;
            }
            function closeFDiv(){
                document.getElementById('popDiv').style.display = 'none';
				document.getElementById('hidDiv').style.display = 'none';

            }
            function showReg(){
                document.getElementById('popReg').style.display = 'block';
				document.getElementById('hidReg').style.display = 'block';
            }
            function closeReg(){
                document.getElementById('popReg').style.display = 'none';
				document.getElementById('hidReg').style.display = 'none';
            }
         </script>
		<script>
        function goTop(){
            $('html,body').animate({'scrollTop':0},600);
        }
        </script>
        <div class="tipMask" id="hidDiv" style="display:none; z-index:9000; background-color:#000; opacity:0.5;" ></div>
        <div class="popGeneral" id="popDiv" style="background:rgba(0,0,0,0.5);position: absolute; top:0px; bottom: 50px; ">
        <img src="<?php echo $this->_var['ectouch_themes']; ?>/images/share_guide.png" onClick="closeFDiv()"  width="100%" height="100%"/>
        </div>
        
        
        <?php if ($this->_var['tips']): ?>
        <div class="popGeneral" id="tipsDiv" style="background:none; bottom:150px; display:block; text-align:center;">
        <div style="line-height:50px; background:#FFF; border:1px solid #F00" onclick="closeFDiv()"> 
        <span style=" font-size:12px; line-height:15px; color:#F00"><?php echo $this->_var['tips']; ?></span>
        <br />
        点击关闭
        </div>
        </div>
        <?php endif; ?>
        
        
        
        <div class="tipMask" id="hidReg" style="display:none; z-index:9000; background-color:#000; opacity:0.5;" ></div>
        <div class="popGeneral" id="popReg"  style=" display:none; background:none; bottom:50px;text-align:center;" onclick="closeReg()">
          <?php if ($this->_var['qr_path']): ?>
         <img src="<?php echo $this->_var['_SERVER']['HTTP_HOST']; ?>/wechat/qrcode/<?php echo $this->_var['qr_path']; ?>" style="width:80%;height:auto" >
         <?php elseif ($this->_var['pintuan']['qrcode_img']): ?>
                <img src="<?php echo $this->_var['pintuan']['qrcode_img']; ?>" style="width:80%;height:auto"  />
         <?php else: ?>
                <img src="<?php echo $this->_var['_SERVER']['HTTP_HOST']; ?>/images/weixin/pt_qrcode.jpg" style="width:80%;height:auto"  />
         <?php endif; ?>
        </div>
        
  



<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
 


<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>

  wx.config({
    debug: false,
    appId: '<?php echo $this->_var['signPackage']['appId']; ?>',
    timestamp: <?php echo $this->_var['signPackage']['timestamp']; ?>,
    nonceStr: '<?php echo $this->_var['signPackage']['nonceStr']; ?>',
    signature: '<?php echo $this->_var['signPackage']['signature']; ?>',
    jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage' 
    ]
  });
 wx.ready(function () {
	//监听“分享给朋友”
    wx.onMenuShareAppMessage({
      title: '<?php if ($this->_var['pintuan']['share_title']): ?><?php echo $this->_var['pintuan']['share_title']; ?><?php else: ?><?php echo $this->_var['pintuan']['act_name']; ?><?php endif; ?>',
      desc: '<?php if ($this->_var['pintuan']['share_brief']): ?><?php echo $this->_var['pintuan']['share_brief']; ?><?php else: ?><?php echo $this->_var['pintuan']['act_name']; ?><?php endif; ?>',
      link: '<?php echo $this->_var['site_url']; ?>mobile/<?php echo $this->_var['pintuan']['share_url']; ?>',
      imgUrl: '<?php if (strpos ( $this->_var['pintuan']['share_img'] , 'ttp' ) > 0): ?><?php else: ?><?php echo $this->_var['site_url']; ?><?php endif; ?><?php echo $this->_var['pintuan']['share_img']; ?>', //--PRINCE 120029121
      trigger: function (res) {		
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
	
	//分享到朋友圈
    wx.onMenuShareTimeline({
      title: '<?php if ($this->_var['pintuan']['share_title']): ?><?php echo $this->_var['pintuan']['share_title']; ?><?php else: ?><?php echo $this->_var['pintuan']['act_name']; ?><?php endif; ?>',
      link: '<?php echo $this->_var['site_url']; ?>mobile/<?php echo $this->_var['pintuan']['share_url']; ?>',
      imgUrl: '<?php if (strpos ( $this->_var['pintuan']['share_img'] , 'ttp' ) > 0): ?><?php else: ?><?php echo $this->_var['site_url']; ?><?php endif; ?><?php echo $this->_var['pintuan']['share_img']; ?>', //--PRINCE 120029121
      trigger: function (res) {		
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
	
});

</script>

</body>
</html>