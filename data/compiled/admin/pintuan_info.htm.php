<!-- $Id: pintuan_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'./js/validator.js,../data/static/js/utils.js')); ?>

<script type="text/javascript" src="../data/static/js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../data/static/js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<!-- 商品搜索 -->
<div class="form-div">
  <form action="javascript:searchGoods()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <!-- 分类 -->
    <select name="cat_id"><option value="0"><?php echo $this->_var['lang']['all_cat']; ?></caption><?php echo $this->_var['cat_list']; ?></select>
    <!-- 品牌 -->
    <select name="brand_id"><option value="0"><?php echo $this->_var['lang']['all_brand']; ?></caption><?php echo $this->html_options(array('options'=>$this->_var['brand_list'])); ?></select>
    <!-- 关键字 -->
    <input type="text" name="keyword" size="20" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<form method="post" action="pintuan.php?act=insert_update" name="theForm" onsubmit="return validate()">
<div class="main-div">
<table id="group-table" cellspacing="1" cellpadding="3" width="100%">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_goods_name']; ?></td>
    <td><select name="goods_id">
      <?php if ($this->_var['pintuan']['act_id']): ?>
      <option value="<?php echo $this->_var['pintuan']['goods_id']; ?>"><?php echo $this->_var['pintuan']['goods_name']; ?></option>
      <?php else: ?>
      <option value="0"><?php echo $this->_var['lang']['notice_goods_name']; ?></option>
      <?php endif; ?>
    </select>    </td>
  </tr>
  <tr>
    <td class="label">活动名称</td>
    <td><input type="text" name="act_name" maxlength="60" size="60" value="<?php echo $this->_var['pintuan']['act_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span">显示在前台页面,例如可使用【拼团】+商品名称，不设置默认使用商品标题</span></td>
  </tr>

  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_start_date']; ?></td>
    <td>
      <input name="start_time" type="text" id="start_time" size="22" value='<?php echo $this->_var['pintuan']['start_time']; ?>' readonly="readonly" /><input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_end_date']; ?></td>
    <td>
      <input name="end_time" type="text" id="end_time" size="22" value='<?php echo $this->_var['pintuan']['end_time']; ?>' readonly="readonly" /><input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn2');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
    </td>
  </tr>


  <?php $_from = $this->_var['pintuan']['price_ladder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  <?php if ($this->_var['key'] == 0): ?>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_price_ladder']; ?></td>
    <td><?php echo $this->_var['lang']['notice_ladder_amount']; ?> <input type="text" name="ladder_amount[]" value="<?php echo $this->_var['item']['amount']; ?>" size="8" />&nbsp;&nbsp;
      <?php echo $this->_var['lang']['notice_ladder_price']; ?> <input type="text" name="ladder_price[]" value="<?php echo $this->_var['item']['price']; ?>" size="8" />
      <a href="javascript:;" onclick="addLadder(this)"><strong>[+]</strong></a>    <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <?php else: ?>
  <tr>
    <td></td>
    <td><?php echo $this->_var['lang']['notice_ladder_amount']; ?> <input type="text" name="ladder_amount[]" value="<?php echo $this->_var['item']['amount']; ?>" size="8" />&nbsp;&nbsp;
      <?php echo $this->_var['lang']['notice_ladder_price']; ?> <input type="text" name="ladder_price[]" value="<?php echo $this->_var['item']['price']; ?>" size="8" />
      <a href="javascript:;" onclick="removeLadder(this)"><strong>[-]</strong></a>    </td>
  </tr>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
     <td class="narrow-label">是否允许单独购买</td>
      <td>
        <input type="radio" name="single_buy" value="1" <?php if ($this->_var['pintuan']['single_buy'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="single_buy" value="0" <?php if ($this->_var['pintuan']['single_buy'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr>
  <tr>
    <td class="label">单独购买时的价格</td>
    <td><input type="text" name="single_buy_price" value="<?php echo empty($this->_var['pintuan']['single_buy_price']) ? '0' : $this->_var['pintuan']['single_buy_price']; ?>" size="30" /></td>
  </tr>
  <tr>
    <td class="label">市场价</td>
    <td><input name="market_price" type="text"  value="<?php echo empty($this->_var['pintuan']['market_price']) ? '0' : $this->_var['pintuan']['market_price']; ?>" size="30"></td>
  </tr>
  <tr>
    <td class="label">折扣</td>
    <td><input name="discount" type="text"  value="<?php echo empty($this->_var['pintuan']['discount']) ? '0' : $this->_var['pintuan']['discount']; ?>" size="30">
    <br /><span class="notice-span">填写商品拼团价约为市场价的多少折</span></td>
  </tr>
  <tr>
    <td class="label">虚拟销量基数</td>
    <td><input type="text" name="virtual_sold" value="<?php echo empty($this->_var['pintuan']['virtual_sold']) ? '0' : $this->_var['pintuan']['virtual_sold']; ?>" size="30" />前台显示的销量为：虚拟销量+实际销量</td>
  </tr>
  <tr>
    <td class="label">拼团限时</td>
    <td><input type="text" name="time_limit" value="<?php echo empty($this->_var['pintuan']['time_limit']) ? '0' : $this->_var['pintuan']['time_limit']; ?>" size="30" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span">小时制，支持小数点，建议整数。超过限定小时后，拼团未成功则判为失败</span></td>
  </tr>
  
  <tr>
    <td class="label">开团个数限制</td>
    <td><input type="text" name="open_limit" value="<?php echo empty($this->_var['pintuan']['open_limit']) ? '0' : $this->_var['pintuan']['open_limit']; ?>" size="30" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span">当用户发起的进行中的拼团个数达到此数量（注意：是进行中的拼团），将暂时不能发起拼团。0为不限制。</span></td>
  </tr>

  <tr>
     <td class="narrow-label">是否可以选择商品数量</td>
      <td>
        <input type="radio" name="choose_number" value="1" <?php if ($this->_var['pintuan']['choose_number'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="choose_number" value="0" <?php if ($this->_var['pintuan']['choose_number'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr>
  <!--tr>
     <td class="narrow-label">好友参团是否微信提醒团长</td>
      <td>
        <input type="radio" name="notify_header" value="1" <?php if ($this->_var['pintuan']['notify_header'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="notify_header" value="0" <?php if ($this->_var['pintuan']['notify_header'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr-->
  <tr>
     <td class="narrow-label">未登陆用户弹出引导关注图片二维码</td>
      <td>
        <input type="radio" name="need_login" value="1" <?php if ($this->_var['pintuan']['need_login'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="need_login" value="0" <?php if ($this->_var['pintuan']['need_login'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr>
  <!--tr>
    <td class="label">默认引导关注二维码图片URL</td>
    <td><input type="text" name="qrcode_img"  size="60" value="<?php echo $this->_var['pintuan']['qrcode_img']; ?>" />
    <br /><span class="notice-span">用于未登陆用户，弹出引导关注二维码（URL是绝对地址，请使用http开头的地址）<br />不设置默认使用mobile/images/weixin/pintuan_qrcode.jpg</span></td>
  </tr-->
  <tr>
    <td class="label">分享标题</td>
    <td><input type="text" name="share_title"  size="60" value="<?php echo $this->_var['pintuan']['share_title']; ?>" />
    <br /><span class="notice-span">用于分享到微信朋友圈或者微信好友时显示，不设置默认使用商品标题</span></td>
  </tr>
  <tr>
    <td class="label">分享描述</td>
    <td><input type="text" name="share_brief"  size="60" value="<?php echo $this->_var['pintuan']['share_brief']; ?>" />
    <br /><span class="notice-span">用于分享给微信好友时显示，不设置默认使用商品标题</span></td>
  </tr>
  <tr>
    <td class="label">分享图片URL</td>
    <td><input type="text" name="share_img"  size="60" value="<?php echo $this->_var['pintuan']['share_img']; ?>" />
    <br /><span class="notice-span">用于微信分享时显示，不设置默认使用商品主图（URL是绝对地址，请使用http开头的地址）</span></td>
  </tr>

  <tr>
    <td class="label"><?php echo $this->_var['lang']['label_desc']; ?></td>
    <td><!--textarea  name="desc" cols="60" rows="4"  ><?php echo $this->_var['cut']['act_desc']; ?></textarea-->
        <table id="detail-table" style="display: table;" width="90%">
          <tbody><tr>
            <td><script charset="utf-8" src="../include/kindeditor/kindeditor-min.js"></script>
    <script>
        var editor;
            KindEditor.ready(function(K) {
                editor = K.create('textarea[name="act_desc"]', {
                    allowFileManager : true,
                    width : '700px',
                    height: '300px',
                    resizeType: 0    //固定宽高
                });
            });
    </script>
    <textarea id="act_desc" name="act_desc" style="width: 700px; height: 300px; display:block;"><?php echo $this->_var['pintuan']['act_desc']; ?></textarea>
    </td>
          </tr>
        </tbody></table>
    </td>
  </tr>
  <tr>
    <td class="label">&nbsp;</td>
    <td>
      <input name="act_id" type="hidden" id="act_id" value="<?php echo $this->_var['pintuan']['act_id']; ?>">
      <input type="submit" name="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
 </td>
  </tr>
</table>
</div>
</form>
<script language="JavaScript">
<!--


// 检查新订单
startCheckOrder();

/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  var eles = document.forms['theForm'].elements;

  var goods_id = eles['goods_id'].value;
  if (goods_id <= 0)
  {
    validator.addErrorMsg(error_goods_null);
  }
  validator.isNumber('deposit', error_deposit, false);
  validator.isInt('restrict_amount', error_restrict_amount, false);
  validator.isInt('gift_integral', error_gift_integral, false);
  return validator.passed();
}

/**
 * 搜索商品
 */
function searchGoods()
{
  var filter = new Object;
  filter.cat_id   = document.forms['searchForm'].elements['cat_id'].value;
  filter.brand_id = document.forms['searchForm'].elements['brand_id'].value;
  filter.keyword  = document.forms['searchForm'].elements['keyword'].value;

  Ajax.call('pintuan.php?is_ajax=1&act=search_goods', filter, searchGoodsResponse, 'GET', 'JSON');
}

function searchGoodsResponse(result)
{
  if (result.error == '1' && result.message != '')
  {
    alert(result.message);
	return;
  }

  var sel = document.forms['theForm'].elements['goods_id'];

  sel.length = 0;

  /* 创建 options */
  var goods = result.content;
  if (goods)
  {
    for (i = 0; i < goods.length; i++)
    {
      var opt = document.createElement("OPTION");
      opt.value = goods[i].goods_id;
      opt.text  = goods[i].goods_name;
      sel.options.add(opt);
    }
  }
  else
  {
    var opt = document.createElement("OPTION");
    opt.value = 0;
    opt.text  = search_is_null;
    sel.options.add(opt);
  }

  return;
}
/**
 * 新增一个价格阶梯
 */
function addLadder(obj, amount, price)
{
  var src  = obj.parentNode.parentNode;
  var idx  = rowindex(src);
  var tbl  = document.getElementById('group-table');
  var row  = tbl.insertRow(idx + 1);
  var cell = row.insertCell(-1);
  cell.innerHTML = '';
  var cell = row.insertCell(-1);
  cell.innerHTML = src.cells[1].innerHTML.replace(/(.*)(addLadder)(.*)(\[)(\+)/i, "$1removeLadder$3$4-");;
}

/**
 * 删除一个价格阶梯
 */
function removeLadder(obj)
{
  var row = rowindex(obj.parentNode.parentNode);
  var tbl = document.getElementById('group-table');

  tbl.deleteRow(row);
}

//-->

</script>

<?php echo $this->fetch('pagefooter.htm'); ?>