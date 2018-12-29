<?php exit;?>a:3:{s:8:"template";a:2:{i:0;s:57:"D:/phpStudy/WWW/yulong/themes/tianxin100/pintuan_list.dwt";i:1;s:64:"D:/phpStudy/WWW/yulong/themes/tianxin100/library/page_footer.lbi";}s:7:"expires";i:1545476048;s:8:"maketime";i:1545472448;}<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title>玉泷</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="themes/tianxin100/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="themes/tianxin100/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!--link href="pt_1.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<!--link href="css/pt_2.css?v=1.1.1" rel="stylesheet" type="text/css" /><PRINCE 120029121-->
<link rel="stylesheet" type="text/css" href="themes/tianxin100/css/style.css?v=1.1.1">
</head>
<body>
<div id="page">
  <header id="header">
   <img src="themes/tianxin100/images/pintuan.jpg" />
  </header>
<div id="search">
  <span>在 商 城 内 搜 索</span>
  <form  method="post" action="search.php" name="searchForm" id="searchForm_id">
    <input type="text" name="keywords"  class="keyword" id="keywordfoot" />
    <input type="submit" name="" class="btn" value=""  onclick="return check('keywordfoot')" />
  </form>
</div>
<div class="trem">
  
</div>
<div class="bottom-log">
    <img src="themes/tianxin100/images/bottom-logo.png" />
    <p>玉泷商城期待您的加入!</p>
</div>
<!-- 
  <div class="srp grid flex-f-row" id="J_ItemList" style="opacity:1;">
    <div class="product flex_in single_item">
      <div class="pro-inner">
      </div>
    </div>
    <a href="javascript:;" class="get_more"></a> 
  </div>
  -->
  
  <a href="javascript:;" class="get_more"></a> 
  <br /><br /><br />
   <link rel="stylesheet" type="text/css" href="themes/tianxin100/css/style.css?v=1.1.1">
<footer>
  <ul>
    <li><a href="./">首页</a></li>
    <li><a href="search.php?intro=hot">热卖</a></li>
    <li><a href="user.php?act=tuiguang">分销</a></li>
    <li><a href="user.php">我的</a></li>
   <li><a href="tel:19943192712">客服</a></li>
  </ul>
</footer>
<!--script src="http://w1.ttkefu.com/k/?fid=7J9FHF6"  charset=utf-8></script-->
<script type="text/javascript" src="data/static/js/ttkefu.js"></script>    </div>
</div>
<script type="text/javascript" src="themes/tianxin100/js/jquery.min.js"></script> 
<script type="text/javascript" src="themes/tianxin100/js/ectouch.js"></script> 
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
<script type="text/javascript">
var max_page = 2 ; //'' ; //分页数量
jQuery(function($){
  $(window).scroll(function () {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      getPageList();
    }
  });
//分页加载计数处理
var getPageList = (function(){
      var isloading = false ;
      var loadMore = true ;
      var successRespone = function(data)
      {
        loadMore = data.loadMore;
        $('#curpage').val(data.page);
         console.log('page',data.page,$('#curpage').val());
         $.each(data.list,function(k,V){
        var html = '<a href="'+V.url+'" class="pt-goods">\
            <div class="pt-img">\
              <img src="'+V.goods_thumb+'" />\
            </div>\
              <dl class="pt-info"> \
                <h4 class="pt-title" >'+ V.act_name +'</h4>\
                <dd><span class="red-text">参团<span class="price">'+V.lowest_price+'</span></span> <span class="gray-text">单买￥'+V.single_buy_price+'</span></dd>\
                <dd class="redBtn"><span>去拼团</span></dd>\
              </dl>\
          </a>';
          $('.trem').append(html);
         });
         if(loadMore == false){
          $('.trem').append('');
         }
         $('#mark').hide();
      };
      return function(){
        //分页加载中 ，不在加载
        if(isloading) return false ;
        //只有一页 ，不加载
        if(parseInt(max_page) <= 1) {
          $('.goodsbox ul').append('');
          isloading = true;
          return false ;
        }
        
        //分页加载完成，不加载
        if(loadMore == false)  return false ;
        //获取表单筛选数据
       // var data = $('#listform').serializeArray();
       var  data = {page:2};
       // console.log( data[0].value );
       // console.log(data);
        
        $.ajax({
          type:'POST', //传递方式
          async:false,
          beforeSend:function(){ //传递前执行函数
            $('#mark').show();
          },
          url:'pintuan.php?act=asynclist', //提交地址
          data:data,
          dataType:'json',//方式
          success:successRespone, 
        });
      }
  })();
   getPageList();
});
</script>
</body>
</html>
           
