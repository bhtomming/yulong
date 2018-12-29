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
  <?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery.min.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
<script type="text/javascript">
var max_page = 2 ; //'<?php echo $this->_var['max_page']; ?>' ; //分页数量
jQuery(function($){
  getPageList();
  console.log('已经执行');
  $(window).scroll(function () {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      getPageList();
    }
  });
});
//分页加载计数处理
var getPageList = (function(){

      var isloading = false ;

      var loadMore = true ;
console.log('执行函数');
      var successRespone = function(data)
      {
        loadMore = data.loadMore;
        $('#curpage').val(data.page);
console.log("对数据进行处理");
         if(data == "null"){
         $('.trem').append("您还没有参加任何拼团");
         }
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
console.log('在获取内容之前');
        $.ajax({
          type:'POST', //传递方式
          async:false,
          beforeSend:function(){ //传递前执行函数
            $('#mark').show();
          },
          url:'pintuan.php?act=asyncuserlist', //提交地址
          data:data,
          dataType:'json',//方式
          success:successRespone,
        });

      }
  })();
</script>
</body>
</html>