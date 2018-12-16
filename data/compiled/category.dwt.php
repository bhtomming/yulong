<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $this->_var['page_title']; ?></title>
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/touch-icon.png" rel="apple-touch-icon-precomposed" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?v=1.1.1" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_var['ectouch_themes']; ?>/css/mui.min.css?v=1.1.1">
<link href="<?php echo $this->_var['ectouch_themes']; ?>/css/style.css?v=1.1.1" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page" style="right: 0px; left: 0px; display: block;">
<?php if ($this->_var['cat_ad']['ad_code']): ?>
<img src="<?php echo $this->_var['cat_ad']['ad_code']; ?>" style="width: 100%;">
<?php endif; ?>

<div id="search">
  <span>在 商 城 内 搜 索</span>
  <form  method="post" action="search.php" name="searchForm" id="searchForm_id">
    <input type="text" name="keywords"  class="keyword" id="keywordfoot" />
    <input type="submit" name="" class="btn" value=""  onclick="return check('keywordfoot')" />
  </form>
</div>


  <?php echo $this->fetch('library/goods_list_search.lbi'); ?>
  <?php echo $this->fetch('library/footer_nav.lbi'); ?>
</div>


<div id="page-nav" class="nav" style="right:-275px;">
  <form class="hold-height" action="category.php">
    <div class="attrExtra">
      <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>"/>
      <button class="attrExtra-submit" type="submit">确定</button>
      <button class="attrExtra-cancel" type="button"  onclick="mtShowMenu()">取消</button>
    </div>
    <div class="attrs attr-fix" style="overflow: auto;height: 100%"> 
       
      <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?> 
      
      <?php if ($this->_var['brands']['1']): ?>
      <div class="attr brandAttr">
        <div class="attrKey"><?php echo $this->_var['lang']['brand']; ?></div>
        <div class="attrValues">
          <ul class="av-collapse filter_list">
            <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?> 
            <?php if ($this->_var['brand']['selected']): ?>
            <li class="av-selected"> 
              <?php else: ?>
            <li> 
              <?php endif; ?> 
              <a href="javascript:void(0);" data="<?php echo $this->_var['brand']['brand_id']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
          </ul>
          <div class="av-options"><a class="j_More avo-more avo-more-down" href="javascript:;">查看更多<i></i></a> </div>
        </div>
      </div>
      <?php endif; ?> 
      
      <?php if ($this->_var['price_grade']['1']): ?>
      <div class="attr brandAttr">
        <div class="attrKey"><?php echo $this->_var['lang']['price']; ?></div>
        <div class="attrValues">
          <ul class="av-collapse filter_list">
            <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?> 
            <?php if ($this->_var['grade']['selected']): ?>
            <li class="av-selected"> 
              <?php else: ?>
            <li> 
              <?php endif; ?> 
              <a href="javascript:void(0);" data="<?php echo $this->_var['grade']['start']; ?>|<?php echo $this->_var['grade']['end']; ?>"><?php echo $this->_var['grade']['price_range']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
            <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
          </ul>
          <div class="av-options"><a class="j_More avo-more avo-more-down" href="javascript:;">查看更多<i></i></a> </div>
        </div>
      </div>
      <?php endif; ?> 
      
      <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_69300000_1544942171');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_69300000_1544942171']):
?>
      <div class="attr brandAttr">
        <div class="attrKey"><?php echo htmlspecialchars($this->_var['filter_attr_0_69300000_1544942171']['filter_attr_name']); ?></div>
        <div class="attrValues">
          <ul class="av-collapse filter_list">
            <?php $_from = $this->_var['filter_attr_0_69300000_1544942171']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?> 
            <?php if ($this->_var['attr']['selected']): ?>
            <li class="av-selected filter_attr"> 
              <?php else: ?>
            <li class="filter_attr"> 
              <?php endif; ?> 
              <a href="javascript:void(0);" data="<?php echo $this->_var['attr']['attr_id']; ?>"><?php echo $this->_var['attr']['attr_value']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </ul>
          <div class="av-options"><a class="j_More avo-more avo-more-down" href="javascript:void(0);">查看更多<i></i></a> </div>
        </div>
      </div>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>"/>
      <?php endif; ?> 
       
    </div>
  </form>
</div>
<div id="mark"></div>
	
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['ectouch_themes']; ?>/js/ectouch.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport_index.js')); ?>
<script type="text/javascript" src="themes/tianxin100/js/touchslider.dev.js"></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
<script type="text/javascript">
var max_page = '<?php echo $this->_var['max_page']; ?>' ; //分页数量
jQuery(function($){

	$(window).scroll(function () {
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			//$('.get_more').click();
            //分页 异步加载
			getPageList();
		}
	});
//分页加载计数处理
var	getPageList = (function(){

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
			 
			 //搜索结果处理
			 var html = '<li class="clearfix">\
				<a href="'+v.url+'" title="'+v.name+'">\
					<img src="'+v.goods_thumb+'" alt="'+v.name+'">\
					<div  class="good-info">\
						<h4>'+v.name+'</h4>\
						<div class="goods-control">\
							<a class="icon icon-cart" href="javascript:addToCart(1);"></a>\
						<span class="price">价格</span>\
						</div>\
					</div>\
				</a>\
			</li>';
			 $('.goodsbox ul').append(html);
          

         });
         if(loadMore == false){
          $('.goodsbox').append('<div class="splite-line" style="text-align:center; min-height:2rem;">已经到底喽～</div>');
         }
         $('#mark').hide();

      };

      return function(){
        //分页加载中 ，不在加载
        if(isloading) return false ;
        //只有一页 ，不加载
        if(parseInt(max_page) <= 1) {
          $('.goodsbox').append('<div  class="splite-line" style="text-align:center; min-height:2rem;">已经到底喽～</div>');
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
          url:'category.php?ajax=1&id=' + data[0].value, //提交地址
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