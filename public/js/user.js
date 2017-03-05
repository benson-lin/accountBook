

$(function(){
	user = getUserInfo();
	$(".nickname").text(user.nickname);
	$(".email").text(user.email);
});


function getUserInfo(){
	var user;
	$.ajax({
		  type: 'get',
		  url: '/getUserInfo',
		  async : false,
		  success: function(result){
			  user = $.parseJSON(result).data;
		  }
	});
	return user;
}


