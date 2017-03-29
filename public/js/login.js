$("#forgetPasswordButton").click(function(){
	console.log('111111');
    BootstrapDialog.show({
        title: '忘记密码',
        type: BootstrapDialog.TYPE_DEFAULT,
        message: $('<p>邮箱： <input type="text" placeholder="Email..." id="forgetEmail"></p>'),
//        message: $('<textarea class="form-control" placeholder="Try to input multiple lines here..."></textarea>'),
        buttons: [{
            label: '确定',
            cssClass: 'btn-default',
            hotkey: 13, // Enter.
            action: function(dialog) {
            	$forgetEmail = $("#forgetEmail").val();
            	if($forgetEmail) {
            		$.ajax({
                		  type: 'POST',
                		  url: '/forgetPassword',
                		  dataType: 'json',
                		  data: {
                			  'forgetEmail' : $forgetEmail,
                		  },
                		  success: function(result){
                			  if(result.code == 0){
                				dialog.setMessage('邮件发送成功，请前往邮箱查看');
                			  }else{
                				dialog.setMessage('邮件发送失败，请稍后再试');
                			  }
                		  }
                	});
            	}else{
            		dialog.close();
            	}
            	
            	
            }
        }]
    });
    
    
});


$('#loginButton').click(function(){
	var nickname = $('#login-nickname').val();
	var password = $('#login-password').val();
	$.ajax({
		  type: 'POST',
		  url: '/login',
		  dataType: 'json',
		  data: {
			  'login-nickname' : nickname,
			  'login-password' : password
		  },
		  success: function(result){
			  if(result.code == 0){
				  location.href = "/";
			  }else{
				  layer.msg(result.message);
			  }
		  }
	});
});


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
