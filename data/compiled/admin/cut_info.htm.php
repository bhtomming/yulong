<!-- $Id: cut_info.htm 16992 2010-01-19 08:45:49Z wangleisvn $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../data/static/js/utils.js,./js/listtable.js,./js/validator.js')); ?>
<script type="text/javascript" src="../data/static/js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../data/static/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<div class="main-div">
<form method="post" action="cut.php" name="theForm" onsubmit="return validate()">
<table cellspacing="1" cellpadding="3" width="100%">

  <tr>
    <td align="right">商品关键字</td>
    <td><input type="text" name="keywords" size="30" />
    <input type="button" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" onclick="searchGoods()"></td>
  </tr>
  <tr>
    <td class="label"><a href="javascript:showNotice('noticegoodsid');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['goodsid']; ?></td>
    <td>
        <select name="goods_id" onchange="javascript:change_good_products();">
        <?php echo $this->_var['cut']['option']; ?>
        </select>
        <!--select name="product_id" style="display:none">
        <?php echo $this->html_options(array('options'=>$this->_var['good_products_select'],'selected'=>$this->_var['cut']['product_id'])); ?>
        </select-->
        <?php echo $this->_var['lang']['require_field']; ?>
     <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticegoodsid"><?php echo $this->_var['lang']['notice_goodsid']; ?></span></td>
  </tr>
  <tr>
    <td class="label">活动名称</td>
    <td><input type="text" name="cut_name" maxlength="60" size="60" value="<?php echo $this->_var['cut']['cut_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span">显示在前台页面,分享到微信朋友圈或好友时也显示标题，例如可使用【全名砍价】+商品名称</span></td>
  </tr>

  <tr>
    <td class="label"><?php echo $this->_var['lang']['start_time']; ?></td>
    <td>
      <input type="text" name="start_time" maxlength="60" size="40" value="<?php echo $this->_var['cut']['start_time']; ?>" readonly="readonly" id="start_time_id" />
      <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time_id', '%Y-%m-%d %H:%M', '24', false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
      <?php echo $this->_var['lang']['require_field']; ?>
    </td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['end_time']; ?></td>
    <td>
      <input type="text" name="end_time" maxlength="60" size="40" value="<?php echo $this->_var['cut']['end_time']; ?>"  readonly="readonly" id ="end_time_id" />
      <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('end_time_id', '%Y-%m-%d %H:%M', '24', false, 'selbtn1');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
      <?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label"><a href="javascript:showNotice('noticeminPrice');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['min_price']; ?></td>
    <td><input type="text" name="start_price" maxlength="60" size="20" value="<?php echo $this->_var['cut']['start_price']; ?>" /><?php echo $this->_var['lang']['require_field']; ?><br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeminPrice"><?php echo $this->_var['lang']['notice_min_price']; ?></span></td>
  </tr>
   <tr>
    <td class="label"><a href="javascript:showNotice('noticemaxPrice');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['max_price']; ?></td>
    <td><input type="text" name="end_price" maxlength="60" size="20" value="<?php echo $this->_var['cut']['end_price']; ?>" /><?php echo $this->_var['lang']['require_field']; ?><br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticemaxPrice"><?php echo $this->_var['lang']['notice_max_price']; ?></span></td>
  </tr>


  <tr>
    <td class="label"><a href="javascript:showNotice('noticePrice');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['price']; ?></td>
    <td><input type="text" name="max_price" maxlength="60" size="20" value="<?php echo $this->_var['cut']['max_price']; ?>" /><?php echo $this->_var['lang']['require_field']; ?><br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticePrice"><?php echo $this->_var['lang']['notice_price']; ?></span></td>
  </tr>
  <tr>
     <td class="narrow-label">是否显示保底价格</td>
      <td>
        <input type="radio" name="showlimit" value="1" <?php if ($this->_var['cut']['showlimit'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="showlimit" value="0" <?php if ($this->_var['cut']['showlimit'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr>
  <tr>
    <td class="label">每位客户允许下单的次数</td>
    <td><input type="text" name="orders_limit" value="<?php echo $this->_var['cut']['orders_limit']; ?>" size="20" />
        <br /><span class="notice-span">活动期间，可以下单购买的次数。0表示不限制</span></td>
  </tr>
  <tr>
     <td class="narrow-label">未登陆用户弹出引导关注图片二维码</td>
      <td>
        <input type="radio" name="needreg" value="1" <?php if ($this->_var['cut']['needreg'] == 1): ?>checked<?php endif; ?>> 是
        <input type="radio" name="needreg" value="0" <?php if ($this->_var['cut']['needreg'] == 0): ?>checked<?php endif; ?>> 否
      </td>
  </tr>
  <tr>
    <td class="label">分享标题</td>
    <td><input type="text" name="share_title" maxlength="60" size="60" value="<?php echo $this->_var['cut']['share_title']; ?>" />
    <br /><span class="notice-span">用于分享到微信朋友圈或者微信好友时显示，不设置默认使用活动名称</span></td>
  </tr>
  <tr>
    <td class="label">分享描述</td>
    <td><input type="text" name="share_brief" maxlength="60" size="60" value="<?php echo $this->_var['cut']['share_brief']; ?>" /><?php echo $this->_var['lang']['require_field']; ?>
    <br /><span class="notice-span">用于分享给微信好友时显示，不设置默认使用活动名称</span></td>
  </tr>
  <tr>
    <td class="label"><?php echo $this->_var['lang']['desc']; ?></td>
    <td><!--textarea  name="desc" cols="60" rows="4"  ><?php echo $this->_var['cut']['act_desc']; ?></textarea-->
        <table id="detail-table" style="display: table;" width="90%">
          <tbody><tr>
            <td><script charset="utf-8" src="../include/kindeditor/kindeditor-min.js"></script>
    <script>
        var editor;
            KindEditor.ready(function(K) {
                editor = K.create('textarea[name="desc"]', {
                    allowFileManager : true,
                    width : '700px',
                    height: '300px',
                    resizeType: 0    //固定宽高
                });
            });
    </script>
    <textarea id="desc" name="desc" style="width: 700px; height: 300px; display:block;"><?php echo $this->_var['cut']['act_desc']; ?></textarea>
    </td>
          </tr>
        </tbody></table>
    </td>
  </tr>

  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
      <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
      <input type="hidden" name="id" value="<?php echo $this->_var['cut']['act_id']; ?>" />
    </td>
  </tr>
</table>
</form>
</div>
<script language="JavaScript">
<!--

var display_yes = (Browser.isIE) ? 'block' : 'table-row-group';

document.forms['theForm'].elements['cut_name'].focus();
onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("cut_name",  no_name);
  validator.isNullOption("goods_id", no_goods_id);
  validator.isTime("start_time", invalid_starttime, true);
  validator.isTime("end_time", invalid_endtime, true);
  validator.gt("end_time", "start_time", invalid_gt);
  validator.gt("end_price", "start_price", invalid_price);
  validator.isNumber("start_price", invalid_min_price, true);
  validator.isNumber("max_price", invalid_max_price, true);
  validator.isInt("cost_points", invalid_integral, true);

  if (document.forms['theForm'].elements['act'] == "insert")
  {
      validator.required("password", no_password);
  }

  return validator.passed();
}

function searchGoods()
{
  var filter = new Object;
  filter.keyword = document.forms['theForm'].elements['keywords'].value;

  Ajax.call('cut.php?is_ajax=1&act=search_goods', filter, searchGoodsResponse, 'GET', 'JSON');
}

function searchGoodsResponse(result)
{
  var frm = document.forms['theForm'];
  var sel = frm.elements['goods_id'];
  //var sp = frm.elements['product_id'];

  if (result.error == 0)
  {
    /* 清除 options */
    sel.length = 0;
    //sp.length = 0;

    /* 创建 options */
    var goods = result.content.goods;
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

    /* 创建 product options */
    /*var products = result.content.products;
    if (products)
    {
      sp.style.display = display_yes;

      for (i = 0; i < products.length; i++)
      {
        var p_opt = document.createElement("OPTION");
        p_opt.value = products[i].product_id;
        p_opt.text  = products[i].goods_attr_str;
        sp.options.add(p_opt);
      }
    }
    else
    {
      sp.style.display = 'none';

      var p_opt = document.createElement("OPTION");
      p_opt.value = 0;
      p_opt.text  = search_is_null;
      sp.options.add(p_opt);
    }*/
  }

  if (result.message.length > 0)
  {
    alert(result.message);
  }
}

function change_good_products()
{
  var filter = new Object;
  filter.goods_id = document.forms['theForm'].elements['goods_id'].value;

  Ajax.call('cut.php?is_ajax=1&act=search_products', filter, searchProductsResponse, 'GET', 'JSON');
}

function searchProductsResponse(result)
{
  var frm = document.forms['theForm'];
  //var sp = frm.elements['product_id'];

  //if (result.error == 0)
  //{
    /* 清除 options */
    //sp.length = 0;

    /* 创建 product options */
   // var products = result.content.products;
   // if (products.length)
  //  {
   ///   sp.style.display = display_yes;

    //  for (i = 0; i < products.length; i++)
     /// {
      //  var p_opt = document.createElement("OPTION");
       // p_opt.value = products[i].product_id;
      //  p_opt.text  = products[i].goods_attr_str;
      //  sp.options.add(p_opt);
      //}
   /* }
    else
    {
      sp.style.display = 'none';

      var p_opt = document.createElement("OPTION");
      p_opt.value = 0;
      p_opt.text  = search_is_null;
      sp.options.add(p_opt);
    }
  }*/

  if (result.message.length > 0)
  {
    alert(result.message);
  }
}
//-->

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>