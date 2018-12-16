
<?php if ($this->_var['specialty_goods']): ?>
<h4 class="cate-title">特色产品</h4>
<div class="title"><a class="fr" href="category.php?id=3">查看更多 > </a><span class="blue-text">玉泷农业<sub>CHARACTERISTIC PRODUCTS</sub></span></div>
<div class="goodsbox hotal">
  <ul>
    <?php $_from = $this->_var['specialty_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_07511200_1544780136');$this->_foreach['specialty_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['specialty_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_07511200_1544780136']):
        $this->_foreach['specialty_goods']['iteration']++;
?>
    <li class="clearfix">
        <a href="<?php echo $this->_var['goods_0_07511200_1544780136']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_07511200_1544780136']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods_0_07511200_1544780136']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_07511200_1544780136']['name']); ?>">
        <div class="good-info">
          <h4><?php echo $this->_var['goods_0_07511200_1544780136']['name']; ?></h4>
          <p><?php echo $this->_var['goods_0_07511200_1544780136']['brief']; ?></p>
			<div class="goods-control">
				<a class="icon icon-cart" href="javascript:addToCart(<?php echo $this->_var['goods_0_07511200_1544780136']['id']; ?>)"></a>
				<div class="icon-buy-border">
					<a class="icon-buy"  href="javascript:addToCart1(<?php echo $this->_var['goods_0_07511200_1544780136']['id']; ?>)">购买</a>
				</div>
				<span class="icon-rmb">RMB /</span>
				<span class="price"><?php if ($this->_var['goods_0_07511200_1544780136']['promote_price']): ?><?php echo $this->_var['goods_0_07511200_1544780136']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods_0_07511200_1544780136']['shop_price']; ?><?php endif; ?></span>				
			</div>
        </div>
      </a>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php endif; ?>