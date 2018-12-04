<!DOCTYPE html>
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="utf-8" />
<title><?php echo $this->_var['page_title']; ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?v=1.1.1" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/css/style.css?v=1.1.1" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="page" style="right: 0px; left: 0px; display: block;">
  <header id="header" style="z-index:1">
    <div class="header_l"> <a class="ico_10" href="javascript:history.go(-1)"> 返回 </a> </div>
    <div id="search_box2" >
      <div class="search_box" >
        <form method="post" action="search.php" name="searchForm" id="searchForm_id">
          <input name="keywords" type="text" id="keywordfoot" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>" />
          <button class="ico_07" type="submit" cursor="hand" onclick="return check('keywordfoot')"> </button>
        </form>
      </div>
    </div>
  </header>
  <?php echo $this->fetch('library/goods_list_search.lbi'); ?>
</div>
<?php echo $this->fetch('library/footer_nav.lbi'); ?>

<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery.more.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/ectouch.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
<script type="text/javascript">
var max_page = '<?php echo $this->_var['max_page']; ?>' ; //分页数量
var keywords = '<?php echo $this->_var['keywords']; ?>';
jQuery(function($){

  $(window).scroll(function () {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      //$('.get_more').click();
            //分页 异步加载
      console.log('test category page');
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
         $.each(data.list,function(k,v){
          if(v.promote_price.length > 0){
            var price = v.promote_price ;
          }else{
            var price = v.shop_price ;
          }
            var html = '<li class="clearfix">\
              <a href="<?php echo $this->_var['goods']['url']; ?>" title="'+v.name+'">\
              <img src="'+v.goods_thumb+'" alt="'+v.name+'">\
              <div>\
                <h4>'+v.name+'</h4>\
                <p>'+v.goods_brief+'</p>\
                <font>\
                  <span class="ico">购买价格</span>\
                  <span class="price">'+price+'</span>\
                </font>\
              </div>\
            </a>\
          </li>';
          $('.goodsbox ul').append(html);

         });
         if(loadMore == false){
          $('.goodsbox ul').append('<li style="text-align:center; min-height:2rem;">已经到底喽～</li>');
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
        var data = $('#listform').serializeArray();

        console.log( data[0].value );
        console.log(data);
        
        $.ajax({
          type:'POST', //传递方式
          async:false,
          beforeSend:function(){ //传递前执行函数
            $('#mark').show();
          },
          url:'search.php?ajax=1&keywords=' + keywords, //提交地址
          data:data,
          dataType:'json',//方式
          success:successRespone, 
        });

      }
  })();
});
</script>
</body>
</html>