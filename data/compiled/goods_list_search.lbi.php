<div class="filter" style="position:static; top:0px; width:100%;">
  <form method="GET" class="sort" id="listform" name="listform">

    <ul class="filter-inner">
      <li class="">
      <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=goods_id&order=DESC&keywords=<?php echo $this->_var['keywords']; ?>#goods_list&">综合
       <?php if ($this->_var['pager']['search']['sort'] == 'goods_id' && $this->_var['pager']['search']['order'] == 'DESC'): ?><i class="f-ico-arrow-d"></i><?php endif; ?></a> </li>
      <li class="">
      <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=click_count&order=DESC&keywords=<?php echo $this->_var['keywords']; ?>#goods_list">人气
      <?php if ($this->_var['pager']['search']['sort'] == 'click_count' && $this->_var['pager']['search']['order'] == 'DESC'): ?><i class="f-ico-arrow-d"></i><?php endif; ?> </a> </li>
      <li >
      <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=sales_count&order=DESC&keywords=<?php echo $this->_var['keywords']; ?>#goods_list">销量
       <?php if ($this->_var['pager']['search']['sort'] == 'sales_count' && $this->_var['pager']['search']['order'] == 'DESC'): ?><i class="f-ico-arrow-d"></i><?php endif; ?> </a></li>
      <li >
      <a href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=<?php if ($this->_var['pager']['search']['sort'] == 'shop_price' && $this->_var['pager']['search']['order'] == 'ASC'): ?>DESC<?php else: ?>ASC<?php endif; ?>&keywords=<?php echo $this->_var['keywords']; ?>#goods_list">价格 <span>
      <?php if ($this->_var['pager']['search']['sort'] == 'shop_price' && $this->_var['pager']['search']['order'] == 'ASC'): ?><i class="f-ico-triangle-mt "></i><?php endif; ?>
     <?php if ($this->_var['pager']['search']['sort'] == 'shop_price' && $this->_var['pager']['search']['order'] == 'DESC'): ?><i class="f-ico-triangle-mb "></i><?php endif; ?>
       </span>
       </a> </li>
      
    </ul>
    <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>" />
    <input type="hidden" name="display" value="<?php echo $this->_var['pager']['display']; ?>" id="display" />
    <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
    <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
    <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
    <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>" />
    <input type="hidden" name="page" id="curpage" value="<?php echo $this->_var['pager']['page']; ?>" />
    <input type="hidden" name="sort" value="<?php echo $this->_var['pager']['sort']; ?>" />
    <input type="hidden" name="order" value="<?php echo $this->_var['pager']['order']; ?>" />
    <input type="hidden" name="keywords" value="<?php echo $this->_var['keywords']; ?>" />
  </form>
</div>
   	<?php if ($this->_var['goods_list']): ?>
<div class="goodsbox" style="width: 100%; overflow:hidden;">
  <ul>
     <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
      <?php if ($this->_var['goods']['goods_id']): ?>
    <li class="clearfix">
        <a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>">
        <img src="<?php echo $this->_var['site_url']; ?><?php echo $this->_var['goods']['goods_thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>">
        <div>
          <h4><?php echo htmlspecialchars($this->_var['goods']['name']); ?> </h4>
          <p><?php echo $this->_var['goods']['goods_brief']; ?></p>
          <font>
            <span class="ico">购买价格</span>
            <span class="price"><?php if ($this->_var['goods']['promote_price']): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></span>
          </font>
        </div>
      </a>
    </li>
     <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>

    <?php else: ?>
    <div id="J_ItemList" class="srp album flex-f-row" style="opacity:1;">
    <p style="text-align:center;">找不到匹配条件的商品哦~ ~</p>
    </div>
    <?php endif; ?>