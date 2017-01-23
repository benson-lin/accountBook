$(function(){
	layui.use(['layer']);
});

$('#registerButton').click(function(){
	var username = $('#register-username').val();
	var nickname = $('#register-nickname').val();
	var password = $('#register-password').val();
	$.ajax({
		  type: 'POST',
		  url: '/register',
		  dataType: 'json',
		  data: {
			  'register-username' : username,
			  'register-nickname' : nickname,
			  'register-password' : password
		  },
		  success: function(result){
			  if(result.code != 0){
				  layer.msg(result.message);
			  }else{
				  layer.msg(result.message);
				  location.href = '/';
			  }
		  }
		});
});
