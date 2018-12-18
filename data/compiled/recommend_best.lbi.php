<?php if ($this->_var['daliys']): ?>
<div class="bg2"></div>
<div class="daliy-title">
    <p class="daliy-cate-title">每日特价商品<span>-实时更新</span></p>
    <p class="sub-text">DAILY PRICE PEDUCTION PRODDUCTS-REAL-TIME UPDATE</p>
</div>
<div class="goodsbox">
    <div class="swiper-container1">
        <div class="swiper-wrapper">
        <?php $_from = $this->_var['daliys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'daliy');$this->_foreach['daliy_daliy'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['daliy_daliy']['total'] > 0):
    foreach ($_from AS $this->_var['daliy']):
        $this->_foreach['daliy_daliy']['iteration']++;
?>
            <div class="swiper-slide">
                <a href="<?php echo $this->_var['daliy']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['daliy']['name']); ?>">
                    <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['daliy']['thumb']; ?>" class="daliy-img" alt="<?php echo htmlspecialchars($this->_var['daliy']['name']); ?>" />
                    <div class="good-info-col-1">
                        <h4><?php echo $this->_var['daliy']['name']; ?></h4>
                        <p><?php echo $this->_var['daliy']['brief']; ?></p>
                        <div class="goods-control">
                            <a class="icon icon-cart" href="javascript:addToCart(<?php echo $this->_var['daliy']['id']; ?>)"></a>
                            <span class="price"><?php if ($this->_var['daliy']['promote_price']): ?><?php echo $this->_var['daliy']['promote_price']; ?><?php else: ?><?php echo $this->_var['daliy']['shop_price']; ?><?php endif; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </div>
</div>
<?php endif; ?>

