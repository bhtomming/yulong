<style>
#qrcode { display:block; position:fixed; z-index:99999; width:100%; height:100%; top:0px; left:0px; padding:40% 0 0 0;    text-align: center;
background-color:#000000;background:rgba(0, 0, 0, 0.5);}
#qrcode img {width:60%; height:auto;}
#qrcode  a {display:block; color:#fff;}
</style>

  <?php if ($this->_var['is_subscribe'] == 0): ?>
    <div id="qrcode">
    <span onclick="$('#qrcode').hide();" style="display: block;text-align: right; margin: 0 20%;color: #fff; font-size: 10px;">关闭</span>
    <img src="/images/qrcode_344.jpg" />
  	<a href="javascript:;">长按二维码 ，马上关注公众号</a>
  	 </div>
  <?php endif; ?>
