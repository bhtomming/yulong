<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta charset="UTF-8">
<title><?php echo $this->_var['page_title']; ?></title>
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0"> 
<link href="<?php echo $this->_var['ectouch_themes']; ?>/ectouch.css?v=1.1.1" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_var['ectouch_themes']; ?>/css/mui.min.css?v=1.1.1">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['ectouch_themes']; ?>/css/style.css?v=1.1.1">




</head>
<body>
<div id="page" style="right: 0px; left: 0px; display: block; overflow-y: hidden;overflow-x : hidden; ">



<div id="slider" class="mui-slider" >
      <div class="mui-slider-group mui-slider-loop">      
          <?php $_from = $this->_var['wap_index_ad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');$this->_foreach['wap_index_ad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['wap_index_ad']['total'] > 0):
    foreach ($_from AS $this->_var['ad']):
        $this->_foreach['wap_index_ad']['iteration']++;
?>
           <div class="mui-slider-item">
            <a href="<?php echo $this->_var['ad']['url']; ?>"><img src="<?php echo $this->_var['ad']['ad_code']; ?>"\/></a>
          </div>         
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
      </div>
</div>



<div id="search">
  <span>在 商 城 内 搜 索</span>
  <form  method="post" action="search.php" name="searchForm" id="searchForm_id">
    <input type="text" name="keywords"  class="keyword" id="keywordfoot" />
    <input type="submit" name="" class="btn" value=""  onclick="return check('keywordfoot')" />
  </form>
</div>



<?php echo $this->fetch('library/index_icon.lbi'); ?> 





<?php echo $this->fetch('library/recommend_promotion.lbi'); ?>




<?php if ($this->_var['pintuan']): ?>
<div class="title"><a class="fr" href="pintuan.php">查看更多 > </a><i></i>拼团商品区</div>

<div class="trem">
  <a href="<?php echo $this->_var['pintuan']['0']['url']; ?>" class="clearfix">
    <div class="img">
      <img src="<?php echo $this->_var['pintuan']['0']['goods_thumb']; ?>">
      <span class="title" ></span >
      <font><?php echo $this->_var['pintuan']['0']['act_name']; ?></font>
    </div>
      <dl class="clearfix">       
        <dd class="fl"><span class="ico">拼团价格</span><span class="price"><?php echo $this->_var['pintuan']['0']['lowest_price']; ?></span></dd>
        <dd class="fl"><span class="ico">拼团人数</span><span class="price"> <?php echo $this->_var['pintuan']['0']['lowest_amount']; ?>人</span> </dd>
        <dd class="fr"><span class="redBtn">去拼团</span></dd>
      </dl>    
      <p class="desc"><?php echo $this->_var['pintuan']['0']['goods_brief']; ?></p>

  </a>
</div> 
<?php endif; ?>





<?php echo $this->fetch('library/recommend_best.lbi'); ?>


	
	

<?php echo $this->fetch('library/recommend_hotal.lbi'); ?>



<?php echo $this->fetch('library/recommend_specialty.lbi'); ?>

	

<?php echo $this->fetch('library/recommend_furnishing.lbi'); ?>

	

<?php echo $this->fetch('library/recommend_house.lbi'); ?>
	


<div class="bottom-log">
    <img src="<?php echo $this->_var['ectouch_themes']; ?>/images/bottom-logo.png" />
    <p>玉泷商城期待您的加入!</p>
</div>
</div>
<?php echo $this->fetch('library/footer_nav.lbi'); ?>
<?php echo $this->fetch('library/top_tianxin100_guanzhu.lbi'); ?>

<script type="text/javascript" src="themes/tianxin100/js/jquery-1.9.1.min.js"></script>
<script src="js/mui.min.js"></script>
<script type="text/javascript" src="js/lhf.js" charset="utf-8"></script>
	<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport_index.js')); ?>
<script type="text/javascript" src="themes/tianxin100/js/touchslider.dev.js"></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>


</body>
</html>