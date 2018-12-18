<?php if ($this->_var['furnishing_goods']): ?>
<div class="bg2"></div>
<h4 class="cate-title">智能家居</h4>
<div class="title"><a class="fr" href="category.php?id=4">查看更多 > </a><span class="blue-text">玉泷科技<sub>SMART HOME</sub></span></div>
<div class="goodsbox hotal">
  <ul>
    <?php $_from = $this->_var['furnishing_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_65120400_1545118925');$this->_foreach['furnishing_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['furnishing_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_65120400_1545118925']):
        $this->_foreach['furnishing_goods']['iteration']++;
?>
    <li class="clearfix">
        <a href="<?php echo $this->_var['goods_0_65120400_1545118925']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_65120400_1545118925']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods_0_65120400_1545118925']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_65120400_1545118925']['name']); ?>">
        <div class="good-info">
          <h4><?php echo $this->_var['goods_0_65120400_1545118925']['name']; ?></h4>
			<div class="goods-control">
				<a class="icon icon-cart" href="javascript:addToCart(<?php echo $this->_var['goods_0_65120400_1545118925']['id']; ?>)"></a>
				<span class="price"><?php if ($this->_var['goods_0_65120400_1545118925']['promote_price']): ?><?php echo $this->_var['goods_0_65120400_1545118925']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods_0_65120400_1545118925']['shop_price']; ?><?php endif; ?></span>				
			</div>
        </div>
      </a>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php endif; ?>