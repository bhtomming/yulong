<?php if ($this->_var['daliy']): ?>
<div class="bg2"></div>
<div class="daliy-title">
    <p class="daliy-cate-title">每日特价商品<span>-实时更新</span></p>
    <p class="sub-text">DAILY PRICE PEDUCTION PRODDUCTS-REAL-TIME UPDATE</p>
</div>
<div class="goodsbox">
    <div class="goods-col-1">
        <a href="<?php echo $this->_var['daliy']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['daliy']['name']); ?>">
            <img class="daliy-img" src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['daliy']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['daliy']['name']); ?>">
                <div class="good-info-col-1">
                    <h4><?php echo $this->_var['daliy']['name']; ?></h4>
                    <p><?php echo $this->_var['daliy']['brief']; ?></p>
                    <div class="goods-control">
                        <a class="icon icon-cart" href="javascript:addToCart(<?php echo $this->_var['daliy']['id']; ?>)"></a>
                        <div class="icon-buy-border">
                            <a class="icon-buy"  href="javascript:addToCart1(<?php echo $this->_var['daliy']['id']; ?>)">购买</a>
                        </div>
                        <span class="icon-rmb">RMB /</span>
                        <span class="price"><?php if ($this->_var['daliy']['promote_price']): ?><?php echo $this->_var['daliy']['promote_price']; ?><?php else: ?><?php echo $this->_var['daliy']['shop_price']; ?><?php endif; ?></span>
                    </div>
                </div>
        </a>
    </div>
</div>
<?php endif; ?>

