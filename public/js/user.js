

$(function(){
	user = getUserInfo();
	$("#nickname").text(user.nickname);
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


