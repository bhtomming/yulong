


<footer>
  <ul>
    <li><a href="./">首页</a></li>
    <li><a href="search.php?intro=hot">热卖</a></li>
    <li><a href="user.php?act=tuiguang">分销</a></li>
    <li><a href="user.php">我的</a></li>
   <li><a href="javascript:ttkefuyaoqing.startchats()">客服</a></li>
  </ul>
</footer>
<!--script src="http://w1.ttkefu.com/k/?fid=7J9FHF6"  charset=utf-8></script-->
<?php echo $this->smarty_insert_scripts(array('files'=>'ttkefu.js')); ?>
<?php if ($this->_var['chat']): ?>
<script>
ttkefuyaoqing.startchats();
</script>
<?php endif; ?>





    