<!-- $Id: pintuan_view.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../data/static/js/utils.js,./js/listtable.js')); ?>


<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
    <tr>
      <th><a href="javascript:listTable.sort('user_id');">团长ID</a><?php echo $this->_var['sort_user_id']; ?></th>
      <th><a href="javascript:listTable.sort('user_nickname');">团长昵称</a><?php echo $this->_var['sort_user_nickname']; ?></th>
      <th><a href="javascript:listTable.sort('create_time');">开团时间</a><?php echo $this->_var['sort_create_time']; ?></th>
      <th><a href="javascript:listTable.sort('end_time');">结束时间</a><?php echo $this->_var['sort_end_time']; ?></th>
      <th><a href="javascript:listTable.sort('need_people');">所需人数</a><?php echo $this->_var['sort_need_people']; ?></th>
      <th><a href="javascript:listTable.sort('available_people');">还需人数</a><?php echo $this->_var['sort_available_people']; ?></th>
      <th><a href="javascript:listTable.sort('status');">状态</a><?php echo $this->_var['sort_status']; ?></th>
      <th><?php echo $this->_var['lang']['handler']; ?></th>

    </tr>
    <?php $_from = $this->_var['pintuan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pintuan');if (count($_from)):
    foreach ($_from AS $this->_var['pintuan']):
?>
    <tr>
      <td align="center"><?php echo $this->_var['pintuan']['user_id']; ?></td>
      <td align="center"><?php echo $this->_var['pintuan']['user_nickname']; ?></td>
      <td align="center"><?php echo $this->_var['pintuan']['create_time']; ?></td>
      <td align="center"><?php echo $this->_var['pintuan']['end_time']; ?></td>
      <td align="center"><?php echo $this->_var['pintuan']['need_people']; ?></td>
      <td align="center"><?php echo $this->_var['pintuan']['available_people']; ?></td>
      <td align="center"><?php if ($this->_var['pintuan']['status'] == 1): ?>拼团成功<?php elseif ($this->_var['pintuan']['status'] == 2): ?>
                          <font  color="#FF0000">拼团失败</font><?php else: ?>进行中<?php endif; ?></td>
      <td align="center">
        <a href="pintuan.php?act=detail_view&amp;pt_id=<?php echo $this->_var['pintuan']['pt_id']; ?>&amp;act_id=<?php echo $this->_var['pintuan']['act_id']; ?>" title="<?php echo $this->_var['lang']['view_detail']; ?>"><img src="images/icon_view.gif" border="0" height="16" width="16"></a>
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <tr>
      <td align="right" nowrap="true" colspan="8"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query_pintuan";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    startCheckOrder();  // 开始检查订单
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>