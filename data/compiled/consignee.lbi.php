
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js')); ?>
<?php if ($this->_var['consignee']['address_id'] > 0): ?>
<dl>
  <dd class="dd1">收货人</dd>
  <dd class="dd2"> <?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?></dd>
</dl>
<dl>
  <dd class="dd1">联系电话</dd>
  <dd class="dd2"><?php echo htmlspecialchars($this->_var['consignee']['tel']); ?></dd>
</dl>


<?php if ($this->_var['real_goods_count'] > 0): ?> 

<dl>
  <dd class="dd1"><?php echo $this->_var['lang']['country_province']; ?> </dd>
  <dd class="dd2"> <?php if ($this->_var['consignee']['area'] != ''): ?> <?php echo $this->_var['consignee']['area']; ?> <?php else: ?> 请选择 <?php endif; ?></dd>
</dl>
<?php endif; ?> 

<?php if ($this->_var['real_goods_count'] > 0): ?> 

<dl>
  <dd class="dd1"><?php echo $this->_var['lang']['detailed_address']; ?></dd>
  <dd class="dd2">
    <?php echo htmlspecialchars($this->_var['consignee']['address']); ?></dd>
</dl>

<?php endif; ?> 

<!--
<dl>
<dd class="dd1"><?php echo $this->_var['lang']['backup_phone']; ?></dd><dd class="dd2"><input name="mobile" type="text" class="inputBg"  id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" /></dd><dd class="dd3"><i></i></dd>
</dl>
--> 
<?php if ($this->_var['real_goods_count'] > 0): ?> 
 
<!--
<dl>
<dd class="dd1"><?php echo $this->_var['lang']['sign_building']; ?></dd><dd class="dd2"><input name="sign_building" type="text" class="inputBg"  id="sign_building_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?>" /></dd><dd class="dd3"><i></i></dd>
</dl>
<dl>
<dd class="dd1"><?php echo $this->_var['lang']['deliver_goods_time']; ?></dd><dd class="dd2"><input name="best_time" type="text"  class="inputBg" id="best_time_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['best_time']); ?>" /></dd><dd class="dd3"><i></i></dd>
</dl>--> 
<?php endif; ?>

<dl style="border:none; padding-bottom:0">
 <dd class="center">
<?php if ($_SESSION['user_id'] > 0 && $this->_var['consignee']['address_id'] > 0): ?> 

 
    <button type="submit" class="c-btn5" name="Submit"><?php echo $this->_var['lang']['shipping_address']; ?></button>
    <button type="button" class="c-btn5 editNew" data-num="<?php echo $this->_var['sn']; ?>" name="button" >修改</button>
    <button type="button" class="c-btn5" name="button" onclick="if (confirm('<?php echo $this->_var['lang']['drop_consignee_confirm']; ?>')) location.href='flow.php?step=drop_consignee&amp;id=<?php echo $this->_var['consignee']['address_id']; ?>'"><?php echo $this->_var['lang']['drop']; ?></button>
  
<?php else: ?>
 
    <button type="submit" class="c-btn1" name="Submit"><?php echo $this->_var['lang']['shipping_address']; ?></button>
 
<?php endif; ?>
 </dd>
</dl>
<?php else: ?>
<dl><dd class="center"><button type="button" class="c-btn5" name="button" id="addNew">新添加收货地址</button> </dd></dl>
<?php endif; ?>
<input type="hidden" name="step" value="consignee" />
<input type="hidden" name="act" value="checkout" />
<input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />