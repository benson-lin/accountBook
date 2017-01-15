



$('#registerButton').click(function(){
	var username = $('#register-username').val();
	var nickname = $('#register-nickname').val();
	var password = $('#register-password').val();
	$.ajax({
		  type: 'POST',
		  url: '/register',
		  data: {
			  'register-username' : username,
			  'register-nickname' : nickname,
			  'register-password' : password
		  },
		  success: function(result){
			  alert(result);
		  }
		});
});
