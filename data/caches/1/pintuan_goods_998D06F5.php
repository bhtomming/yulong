<?php exit;?>a:3:{s:8:"template";a:1:{i:0;s:58:"D:/phpStudy/WWW/yulong/themes/tianxin100/pintuan_goods.dwt";}s:7:"expires";i:1545476091;s:8:"maketime";i:1545472491;}<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title>客舍酒店景观大床房_玉泷</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="themes/tianxin100/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="themes/tianxin100/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!--link href="pt_1.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<!--link href="css/pt_2.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<link rel="stylesheet" type="text/css" href="themes/tianxin100/css/style.css?v=1.1.1">
 <script>
           //通过window.screen.width获取屏幕的宽度
          var offWidth = window.screen.width / 30; //这里用宽度/30表示1rem取得的px
          document.getElementsByTagName("html")[0].style.fontSize = offWidth + 'px'; //把rem的值复制给顶级标签html的font-size
      </script>
	<link rel="stylesheet" href="themes/tianxin100/css/mui.min.css?v=1.1.1">
	<link rel="stylesheet" type="text/css" href="themes/tianxin100/css/style.css?v=1.1.1">
<script type="text/javascript" src="data/static/js/common.js"></script><script type="text/javascript" src="data/static/js/lefttime.js"></script><script type="text/javascript" src="data/static/js/common1.js"></script>
<script type="text/javascript" src="themes/tianxin100/js/jquery-1.4.4.min.js"></script>
<script src="themes/tianxin100/js/TouchSlide.js"></script>
<script type="text/javascript">
// 筛选商品属性
jQuery(function($) {
	$(".info").click(function(){
		$('.goodsBuy .fields').slideToggle("fast");
	});
})
onload = function(){
				document.getElementById('number_5').value = 1;//更新数量
				document.getElementById('number_10').value = 1;//更新数量
				document.getElementById('number_20').value = 1;//更新数量
		}
function changenum(diff) {
	var num = parseInt(document.getElementById('goods_number').value);
	var goods_number = num + Number(diff);
	if( goods_number >= 1){
		document.getElementById('goods_number').value = goods_number;//更新数量
				document.getElementById('number_5').value = goods_number;//更新数量
				document.getElementById('number_10').value = goods_number;//更新数量
				document.getElementById('number_20').value = goods_number;//更新数量
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
    <img alt="" src="images/201806/thumb_img/5_thumb_G_1529254241255.jpg" style="width:100%;"/>
<div id="pintuan" class="goodsinfo clearfix">
	<div>
		<h3>景观大床房</h3>
		<span class="price">￥88</span>
		 
		            <form action="pintuan.php?act=buy" method="post" name="form_5">
              <input type="hidden" name="act_id" value="2" />
              <input type="hidden" name="level" value="5" />
              <input type="hidden" id="number_5" name="number" value="1" />
            </form>
            <p class="clearfix"><span>5 人拼团</span>
            <a href="javascript:form_5.submit();">去拼团</a> </p>
                    <form action="pintuan.php?act=buy" method="post" name="form_10">
              <input type="hidden" name="act_id" value="2" />
              <input type="hidden" name="level" value="10" />
              <input type="hidden" id="number_10" name="number" value="1" />
            </form>
            <p class="clearfix"><span>10 人拼团</span>
            <a href="javascript:form_10.submit();">去拼团</a> </p>
                    <form action="pintuan.php?act=buy" method="post" name="form_20">
              <input type="hidden" name="act_id" value="2" />
              <input type="hidden" name="level" value="20" />
              <input type="hidden" id="number_20" name="number" value="1" />
            </form>
            <p class="clearfix"><span>20 人拼团</span>
            <a href="javascript:form_20.submit();">去拼团</a> </p>
                	</div>
	<div>
	    <ul>
	<li>
		1.8×2.0米大床
	</li>
	<li>
		独立餐桌、卫生间
	</li>
	<li>
		配有全套智能家居
	</li>
	<li>
		一键语音控制、没费WiFI
	</li>
</ul>	</div>
</div>
<div class="bottom-log">
    <img src="themes/tianxin100/images/bottom-logo.png" />
    <p>玉泷商城期待您的加入!</p>
</div>
<script type="text/javascript" src="themes/tianxin100/js/jquery-1.9.1.min.js"></script>
<script src="js/mui.min.js"></script>
<div class="activity_nav">
 <ul> 
 <li class="activity_bian"><a href="index.php"><em class="goods_nav1"></em><span>首页</span></a> </li>
 <li>
 <a  href="pintuan.php?act=userlist"><em class="goods_nav2"></em><span>我的拼团</span></a>
 </li>
 <li class="flow"><a class="button active_button" onclick="showFDiv();"><em class="goods_nav3"></em><span>分享活动<span></a> </li>
         <li class="goumai"><a style="display:block;" href="#pintuan" ><em class="goods_nav4"></em><span>发起拼团</span></a> </li>
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
        <img src="themes/tianxin100/images/share_guide.png" onClick="closeFDiv()"  width="100%" height="100%"/>
        </div>
        
        
                
        
        
        <div class="tipMask" id="hidReg" style="display:none; z-index:9000; background-color:#000; opacity:0.5;" ></div>
        <div class="popGeneral" id="popReg"  style=" display:none; background:none; bottom:50px;text-align:center;" onclick="closeReg()">
                   <img src="/wechat/qrcode/154511891.jpg" style="width:80%;height:auto" >
                 </div>
        
  
<script type="text/javascript" src="data/static/js/transport.js"></script><script type="text/javascript" src="data/static/js/utils.js"></script> 
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  wx.config({
    debug: false,
    appId: 'wx633270b1ec197cac',
    timestamp: 1545472491,
    nonceStr: 'EH0jC0GZHX21S9QZ',
    signature: '65f8c56424be1ec12ec649c15f68d1fe2e3cd787',
    jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage' 
    ]
  });
 wx.ready(function () {
	//监听“分享给朋友”
    wx.onMenuShareAppMessage({
      title: '景观大床房',
      desc: '景观大床房',
      link: 'mobile/pintuan.php?act=view&act_id=2&u=5639&scene_id=5639',
      imgUrl: 'images/201806/thumb_img/5_thumb_G_1529254241255.jpg', //--PRINCE 120029121
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
      title: '景观大床房',
      link: 'mobile/pintuan.php?act=view&act_id=2&u=5639&scene_id=5639',
      imgUrl: 'images/201806/thumb_img/5_thumb_G_1529254241255.jpg', //--PRINCE 120029121
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