
$('#registerButton').click(function(){
	var email = $('#register-email').val();
	var nickname = $('#register-nickname').val();
	var password = $('#register-password').val();
	$.ajax({
		  type: 'POST',
		  url: '/register',
		  dataType: 'json',
		  data: {
			  'register-email' : email,
			  'register-nickname' : nickname,
			  'register-password' : password
		  },
		  success: function(result){
			  if(result.code == 0){
				  location.href = "/sendEmailSucc";
			  }else{
				  alert(result.message);
			  }
		  }
		});
});
