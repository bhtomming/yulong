<?php exit;?>a:3:{s:8:"template";a:2:{i:0;s:62:"D:/phpStudy/WWW/yulong/themes/tianxin100/pintuan_user_list.dwt";i:1;s:64:"D:/phpStudy/WWW/yulong/themes/tianxin100/library/page_footer.lbi";}s:7:"expires";i:1545475302;s:8:"maketime";i:1545471702;}<!DOCTYPE html>
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
<script>
/* PRINCE 120029121  */
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
  <header id="header">
       <div class="header_l header_return"> <a class="ico_10"  href="javascript:goBack()"> 返回 </a> </div>
    <h2> 我的拼团 </h2>
  </header>
<div class="trem">
</div>
  <a href="javascript:;" class="get_more"></a>
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
<script type="text/javascript" src="data/static/js/ttkefu.js"></script></div>
<script type="text/javascript" src="themes/tianxin100/js/jquery.min.js"></script>
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
        console.log(data);
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
          $('.trem').append('<li style="text-align:center; min-height:2rem;">已经到底喽～</li>');
         }
         $('#mark').hide();
      };
      return function(){
        //分页加载中 ，不在加载
        if(isloading) return false ;
        //只有一页 ，不加载
        if(parseInt(max_page) <= 1) {
          $('.goodsbox ul').append('<li style="text-align:center; min-height:2rem;">已经到底喽～</li>');
          isloading = true;
          return false ;
        }
        //分页加载完成，不加载
        if(loadMore == false)  return false ;
        //获取表单筛选数据
       // var data = $('#listform').serializeArray();
       var  data = {page:2};
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