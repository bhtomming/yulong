<?php if ($this->_var['electronic_goods']): ?>
<div class="bg2"></div>
<div class="title"><a class="fr" href="category.php?id=4">查看更多 > </a><i></i>电子商品区</div>

<div class="goodsbox">
  <ul>
    <?php $_from = $this->_var['electronic_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_82900300_1543904001');$this->_foreach['electronic_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['electronic_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_82900300_1543904001']):
        $this->_foreach['electronic_goods']['iteration']++;
?>
    <li class="clearfix">
        <a href="<?php echo $this->_var['goods_0_82900300_1543904001']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_82900300_1543904001']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods_0_82900300_1543904001']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_82900300_1543904001']['name']); ?>">
        <div>
          <h4><?php echo $this->_var['goods_0_82900300_1543904001']['name']; ?></h4>
          <p><?php echo $this->_var['goods_0_82900300_1543904001']['brief']; ?></p>
          <font>
            <span class="ico">购买价格</span>
            <span class="price"><?php if ($this->_var['goods_0_82900300_1543904001']['promote_price']): ?><?php echo $this->_var['goods_0_82900300_1543904001']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods_0_82900300_1543904001']['shop_price']; ?><?php endif; ?></span>
          </font>
        </div>
      </a>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php endif; ?>