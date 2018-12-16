<?php if ($this->_var['hotal_goods']): ?>
<div class="bg2"></div>
<h4 class="cate-title">酒店订房</h4>
<div class="title"><a class="fr" href="category.php?id=2">查看更多 > </a><span class="blue-text">玉泷悦途<sub>HOTEL RESERVATION</sub></span></div>
<div class="goodsbox hotal">
  <ul>
    <?php $_from = $this->_var['hotal_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['hotal_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hotal_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['hotal_goods']['iteration']++;
?>
    <li class="clearfix hotel-list">
        <a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>">
        <div class="good-info">
          <h4><?php echo $this->_var['goods']['name']; ?></h4>
          <p><?php echo $this->_var['goods']['brief']; ?></p>
			<div class="goods-control">
				<a class="icon icon-cart" href="javascript:addToCart(<?php echo $this->_var['goods']['id']; ?>)"></a>
				<div class="icon-buy-border">
					<a class="icon-buy"  href="javascript:addToCart1(<?php echo $this->_var['goods']['id']; ?>)">购买</a>
				</div>
				<span class="icon-rmb">RMB /</span>
				<span class="price"><?php if ($this->_var['goods']['promote_price']): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></span>				
			</div>
        </div>
      </a>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
  <?php if ($this->_var['hai_bao']): ?>
  <?php $_from = $this->_var['hai_bao']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'hb_goods');if (count($_from)):
    foreach ($_from AS $this->_var['hb_goods']):
?>
  <div class="hai-bao">
    <a href="<?php echo $this->_var['hb_goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['hb_goods']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['hb_goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['hb_goods']['name']); ?>">
    </a>
  </div>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <?php endif; ?>
</div>
<?php endif; ?>