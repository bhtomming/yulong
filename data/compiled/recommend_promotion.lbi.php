<?php if ($this->_var['promotion_goods']): ?>
<div class="bg2"></div>
<div class="title"><a class="fr" href="search.php?intro=promotion">查看更多 > </a><i></i>每日降价商品区</div>

<div id="seller" class="box_two clearfix"  >
 <?php $_from = $this->_var['promotion_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods');$this->_foreach['promotion_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promotion_goods']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods']):
        $this->_foreach['promotion_goods']['iteration']++;
?>
  <a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>">
    <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods']['thumb']; ?>"  alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" />
    <span class="ico">抢购价格</span>
    <span class="price"><?php if ($this->_var['goods']['promote_price']): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?>
    </span>
    <p><?php echo $this->_var['goods']['brief']; ?></p>
  </a>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>

<?php endif; ?>