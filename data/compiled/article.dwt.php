<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title><?php echo $this->_var['page_title']; ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?v=1.1.1" rel="stylesheet" type="text/css" />
</head>

<body>
<header id="header" >
  <div class="header_l header_return"> <a class="ico_10"  href="javascript:history.back(-1)"> 返回 </a> </div>
  <h1> 文章详情 </h1>
  <div class="header_r"> <a class="ico_15" href="ectouch.php?act=share&content=<?php echo $this->_var['article']['title']; ?>"> 分享 </a> </div>
</header>
<div class="blank3"></div>
<section class="wrap">
  <div class="art_content radius10">
    <h2><span><?php echo $this->_var['article']['title']; ?></span> <?php echo $this->_var['article']['add_time']; ?></h2>
    <div>
      <p> <?php echo $this->_var['article']['content']; ?> </p>
    </div>
  </div>
</section>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
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
	//尚网网络科技100监听“分享给朋友”
    wx.onMenuShareAppMessage({
      title: '<?php echo $this->_var['page_title']; ?>',
      desc: '<?php echo $this->_var['page_title']; ?>',
      link: '<?php echo $this->_var['url']; ?>',
      imgUrl: '',

    });

	//分享到朋友圈尚网网络科技100
    wx.onMenuShareTimeline({
      title: '<?php echo $this->_var['page_title']; ?>',
      link: '<?php echo $this->_var['url']; ?>',
      imgUrl: '',
    });


});

</script>
</body>
</html>
