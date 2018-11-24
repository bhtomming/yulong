mui.init({
	swipeBack:true //启用右滑关闭功能
});
 mui("#slider").slider({interval: 5000});

mui("#seller").slider({interval: 5000});

$(function(){
	$('#search span').click(function(){
		$(this).hide();
		$('#search form').show();
		$('#search .keyword').focus();
	})
})


/* 搜索验证 */
function check(Id){
	var strings = document.getElementById(Id).value;
	if(strings.replace(/(^\s*)|(\s*$)/g, "").length == 0){
		return false;
	}
	return true;
}