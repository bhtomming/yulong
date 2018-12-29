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

</head>
<body>
<div id="page">
  <header id="header">
   <img src="<?php echo $this->_var['ectouch_themes']; ?>/images/pintuan.jpg" />
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
    <img src="<?php echo $this->_var['ectouch_themes']; ?>/images/bottom-logo.png" />
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
   <?php echo $this->fetch('library/page_footer.lbi'); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/ectouch.js"></script> 
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
<script type="text/javascript">
var max_page = 2 ; //'<?php echo $this->_var['max_page']; ?>' ; //分页数量
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

           
