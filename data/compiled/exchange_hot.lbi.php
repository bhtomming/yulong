<?php if ($this->_var['hot_goods']): ?>
<div class="blank2"></div>
<div class="rmtj">
<a href="search.php?intro=best"><div class="rmtj_left">热卖</div></a>
<a href="search.php?intro=best"><div class="rmtj_right"></div></a>
</div>
<ul class="chanpin">
<?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['hot_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hot_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['hot_goods']['iteration']++;
?>
	<li>
		<div class="chanpin_mb">
		<a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods']['thumb']; ?>" /></a>
		<?php if ($this->_var['goods']['promote_price'] != ""): ?> 
		<P><em class="red"><?php echo $this->_var['goods']['promote_price']; ?></em>
		<em class="xiexian">市场价：<?php echo $this->_var['goods']['market_price']; ?> </em></P>
		<?php else: ?> 
		<P><em class="red"><?php echo $this->_var['goods']['shop_price']; ?></em>
		<em class="xiexian">市场价：<?php echo $this->_var['goods']['market_price']; ?> </em></P>
		<?php endif; ?>
		
		<p><?php echo sub_str(htmlspecialchars($this->_var['goods']['name']),12); ?></p>
		</div>
	</li>
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
<?php endif; ?>

