<!-- $Id: user_account_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'./js/validator.js')); ?>
<div class="main-div">
  <form action="user_account.php" method="post" name="theForm" onsubmit="return validate()">
    <table width="100%">
      <tr>
        <td class="label">提现额度：</td>
        <td>
          <input type="text" name="limit_account_replay" value="<?php echo $this->_var['limit_account_replay']; ?>" size="20" />
        <p>设置最小的提现金额</p>
        </td>
      </tr>
      <tr>
        <td class="label">&nbsp;</td>
        <td>
          <input type="hidden" name="act" value="tixian_query" />
          <?php if ($this->_var['user_surplus']['process_type'] == 0 || $this->_var['user_surplus']['process_type'] == 1): ?>
          <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
          <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
          <?php endif; ?>
        </td>
      </tr>
    </table>
  </form>
</div>

<script language="JavaScript">
<!--

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

    validator.required("user_id",   user_id_empty);
    validator.required("amount",    deposit_amount_empty);
    validator.isNumber("amount",    deposit_amount_error, true);

    var deposit_amount = document['theForm'].elements['amount'].value;
    if (deposit_amount.length > 0)
    {
        if (deposit_amount == 0 || deposit_amount < 0)
        {
            alert(deposit_amount_error);
            return false;
        }
    }

    return validator.passed();
}

//-->

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>