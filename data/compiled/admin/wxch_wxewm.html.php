<!-- $Id: wxch_config.htm 14216 2013-10-13 14:27:21Z djks $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_var['wxch_lang']['cp_home']; ?><?php if ($this->_var['wxch_lang']['ur_here']): ?> - <?php echo $this->_var['wxch_lang']['ur_here']; ?> <?php endif; ?></title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<?php echo $this->smarty_insert_scripts(array('files'=>'../data/static/js/transport.js,./js/common.js')); ?>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
//-->
</script>
</head>
<body>

<h1>
<?php if ($this->_var['action_link']): ?>
<span class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></span>
<?php endif; ?>
<?php if ($this->_var['action_link2']): ?>
<span class="action-span"><a href="<?php echo $this->_var['action_link2']['href']; ?>"><?php echo $this->_var['action_link2']['text']; ?></a>&nbsp;&nbsp;</span>
<?php endif; ?>
<span class="action-span1"><a href="index.php?act=main"><?php echo $this->_var['wxch_lang']['cp_home']; ?></a> </span><span id="search_id" class="action-span1"> -<?php echo $this->_var['wxch_lang']['ur_here']; ?></span>
<div style="clear:both"></div>
</h1>
<div class="main-div">
  <form name="theForm" method="post" action="wxch-ent.php?act=ewm" enctype="multipart/form-data" >
  <table width="100%" >
  <tr>
    <td class="label">头像位置（X）轴:</td>
    <td><input type="text" name="hearimg_x" size="20" value="<?php echo $this->_var['ret']['hearimg_x']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">头像位置（Y）轴:</td>
    <td><input type="text" name="hearimg_y" size="20" value="<?php echo $this->_var['ret']['hearimg_y']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">头像宽度:</td>
    <td><input type="text" name="hearimg_width" size="20" value="<?php echo $this->_var['ret']['hearimg_width']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">头像高度 :</td>
    <td><input type="text " name="hearimg_hight" size="20" value="<?php echo $this->_var['ret']['hearimg_hight']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">二维码位置（X）轴:</td>
    <td><input type="text" name="qr_x" size="20" value="<?php echo $this->_var['ret']['qr_x']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">二维码位置（Y）轴:</td>
    <td><input type="text" name="qr_y" size="20" value="<?php echo $this->_var['ret']['qr_y']; ?>"/></td>
  </tr>
 <tr>
    <td class="label">二维码宽度 :</td>
    <td><input type="text " name="qr_width" size="32" value="<?php echo $this->_var['ret']['qr_width']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">二维码高度 :</td>
    <td><input type="text " name="qr_hight" size="32" value="<?php echo $this->_var['ret']['qr_hight']; ?>"/></td>
  </tr>
   <tr>
    <td class="label">背景图片 :</td>
    <td>   <input type="file" name="bg_img" size="35" /></td>
  </tr>
  <tr>
    <td class="label"></td>
    <td>请上传530*800 jpg格式文件  <a href="../<?php echo $this->_var['ret']['bg_img']; ?>" style="color: blue;" target="_blank">查看背景图片</a></td>
  </tr>
  <tr>
    <td class="label">文本红色值（255）:</td>
    <td><input type="text " name="text_red" size="32" value="<?php echo $this->_var['ret']['text_red']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">文本绿色值（255） :</td>
    <td><input type="text " name="text_geren" size="32" value="<?php echo $this->_var['ret']['text_geren']; ?>"/></td>
  </tr>
  <tr>
    <td class="label">文本蓝色值（255） :</td>
    <td><input type="text " name="text_blue" size="32" value="<?php echo $this->_var['ret']['text_blue']; ?>"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="hidden" value="1" name="hidden_type" />
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
     <!--<a href="wxch-ent.php?act=look_erweima"><input class="button" value="预览" type="button" size="5" /> </a>-->
        <a href="wxch-ent.php?act=delcatch"><input class="button" value="删除缓存图片" type="button" size="5" /> </a>
    </td>
  </tr>
</table>
  </form>

</div>

<?php echo $this->fetch('wxch_pagefooter.htm'); ?>