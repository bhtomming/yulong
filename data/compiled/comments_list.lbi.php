<ul class="list">
<?php if ($this->_var['comments']): ?>
<?php $_from = $this->_var['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
<li class="radius5">
	<div class="tit radius5" > <span><?php if ($this->_var['comment']['username']): ?><?php echo htmlspecialchars($this->_var['comment']['username']); ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></span>  <?php echo $this->_var['comment']['add_time']; ?></div>
	<p>评分：<img src="<?php echo $this->_var['ectouch_themes']; ?>/images/stars<?php echo $this->_var['comment']['rank']; ?>.png" class="star" alt="<?php echo $this->_var['comment']['comment_rank']; ?>" /></p>
	<p>评论：<?php echo $this->_var['comment']['content']; ?></p>
	<?php if ($this->_var['comment']['imgfile'] != ''): ?>
	<p>图片： <img src="<?php echo $this->_var['comment']['imgfile']; ?>" style="height:3rem;" ></p>
	<?php endif; ?>
	<?php if ($this->_var['comment']['re_content']): ?>
	<p><?php echo $this->_var['lang']['admin_username']; ?><?php echo $this->_var['comment']['re_content']; ?></p>
	<?php endif; ?>
</li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
<?php endif; ?>
</ul>


       
       <div id="pagebar" class="f_r">
        <form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <?php if ($this->_var['pager']['styleid'] == 0): ?>
        <div id="pager" style="padding:10px 0">
          <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span>  <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a>  </span>
            <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_41411200_1544780143');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_41411200_1544780143']):
?>
            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_41411200_1544780143']; ?>" />
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <?php else: ?>


        <?php endif; ?>
        </form>
        <script type="text/javascript">
        <!--
        
        function selectPage(sel)
        {
          sel.form.submit();
        }
        
        //-->
        </script>
      </div>
      
      <div class="blank2"></div>
      
      <div class="commentsList radius5">
      <style>
      #pager {font-size:0.8rem;}
      #ECS_COMMENT {padding:50px 1rem 0;}
       #ECS_COMMENT .list  {font-size:0.8rem;}
      #ECS_COMMENT .list li {border-bottom:0.06rem solid  #ddd;padding:0.5rem 0;}
#commentForm {padding:0 1rem;}
#pic {margin: 1rem 0; display:block;}
#imgurl {display:none; height:50px;}
      </style>
      <form action="javascript:;" onsubmit="submitComment(this)" method="post" name="commentForm" id="commentForm">
   
 <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="" >
           <tr>
          <td>
        <?php echo $this->_var['lang']['username']; ?>：<?php if ($_SESSION['user_name']): ?><?php echo $_SESSION['user_name']; ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?>
          </td>
        </tr>
     <tr>
         
          <td>
          <input name="comment_rank" type="radio" value="5" checked="checked" id="comment_rank5" /> 非常好
          <input name="comment_rank" type="radio" value="4" id="comment_rank4" /> 很好
          <input name="comment_rank" type="radio" value="3" id="comment_rank3" /> 一般
          <input name="comment_rank" type="radio" value="2" id="comment_rank2" /> 不行
          <input name="comment_rank" type="radio" value="1" id="comment_rank1" /> 很差
          </td>
        </tr>
         <tr style="display:none;">
          <td>
          <input placeholder="E-mail"  type="text" name="email" id="email"  maxlength="100" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="inputBg"/>
          </td>
        </tr>
        <tr>
          <td>
          <textarea placeholder="<?php echo $this->_var['lang']['comment_content']; ?>" name="content" class="inputBg2" style="height:4rem"  ></textarea>
          <input type="hidden" name="cmt_type" value="<?php echo $this->_var['comment_type']; ?>" />
          <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
          </td>
        </tr>
 <tr >
          <td>
           <img src="" id="imgurl" >
          <input  type="file" name="pic" id="pic" onchange="updatefile()" value=""/>
           <input type="hidden" name="imgfile" id="imgfile" value="" />


          </td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="提交评论" class="c-btn3" /></td>
        </tr>
      </table>
      </form>
      </div>
      
    <div class="blank2"></div>
  
<script type="text/javascript">
//<![CDATA[
<?php $_from = $this->_var['lang']['cmt_lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_41411200_1544780143');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_41411200_1544780143']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item_0_41411200_1544780143']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

var imgfile ;
//上传图片
function updatefile(){
    var file = $('#pic')[0].files[0];
    console.log(file);
    var typeStr="image/jpg,image/png,image/gif,image/jpeg";
   if(typeStr.indexOf(file.type)>=0){
      if (file.size > 2097152) {
            alert("上传的文件不能大于2M");
            return;
      }else{

         var imgdata = new FormData();
         imgdata.append("img",file);
          $.ajax({
             type: "POST",
              url: "comment.php?act=updatefile",
             data: imgdata,
              processData:false,
              contentType:false,
             success: function(msg){
             msg = JSON.parse(msg);
             imgfile = msg.url ;
                $('#imgfile').val(msg.url);
                $('#imgurl').attr('src',msg.url).show();
               //alert( "Data Saved: " + msg );
             }
          });
      }

   }else{
      alert("请上传格式为jpg、png、gif、jpeg的图片");
   }
  var imgdata = new FormData();
  imgdata.append("img",file);


}


/**
 * 提交评论信息
*/
function submitComment(frm)
{
  var cmt = new Object;

  //cmt.username        = frm.elements['username'].value;
  cmt.email           =   "test@163.com"; //frm.elements['email'].value;
  cmt.content         = frm.elements['content'].value;
  cmt.type            = frm.elements['cmt_type'].value;
  cmt.id              = frm.elements['id'].value;
  cmt.enabled_captcha = frm.elements['enabled_captcha'] ? frm.elements['enabled_captcha'].value : '0';
  cmt.captcha         = frm.elements['captcha'] ? frm.elements['captcha'].value : '';
  cmt.rank            = 0;
  cmt.imgfile            = imgfile ;// frm.elements['imgfile'].value;;

  for (i = 0; i < frm.elements['comment_rank'].length; i++)
  {
    if (frm.elements['comment_rank'][i].checked)
    {
       cmt.rank = frm.elements['comment_rank'][i].value;
     }
  }

//  if (cmt.username.length == 0)
//  {
//     alert(cmt_empty_username);
//     return false;
//  }

  if (cmt.email.length > 0)
  {
     if (!(Utils.isEmail(cmt.email)))
     {
        alert(cmt_error_email);
        return false;
      }
   }
   else
   {
        alert(cmt_empty_email);
        return false;
   }

   if (cmt.content.length == 0)
   {
      alert(cmt_empty_content);
      return false;
   }

   if (cmt.enabled_captcha > 0 && cmt.captcha.length == 0 )
   {
      alert(captcha_not_null);
      return false;
   }

   Ajax.call('comment.php', 'cmt=' + cmt.toJSONString(), commentResponse, 'POST', 'JSON');
   return false;
}

/**
 * 处理提交评论的反馈信息
*/
  function commentResponse(result)
  {
    if (result.message)
    {
      alert(result.message);
    }

    if (result.error == 0)
    {
      var layer = document.getElementById('ECS_COMMENT');

      if (layer)
      {
        layer.innerHTML = result.content;
      }
    }
  }

//]]>
</script>