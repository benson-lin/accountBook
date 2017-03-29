<!DOCTYPE html>
<html>
    <head>
        <title>重置密码</title>
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <style type="text/css">
        </style>
  
    </head>
    <body>
    <div class="body">
		《重新设置密码》
		<form role="form" action="login" method="POST">
              <div class="form-group" >
                <p>密码</p>
                <input type="text" class="form-control" id="password" name="register-email">
                <p>确认密码</p>
                <input type="text" class="form-control" id="passwordAgain" name="register-nickname">
                <input type="hidden" value="{{ $data }}" id="data">
                <input type="button" value="重置" id="button">
              </div>
        </form>
    </div>
    <script type="text/javascript">
		$("#button").click(function(){
			var data = $('#data').val();
			var password = $('#password').val();
			var passwordAgain = $('#passwordAgain').val();
			$.ajax({
				  type: 'POST',
				  url: '/resetPassword',
				  dataType: 'json',
				  data: {
					  'data' : data,
					  'password' : password,
					  'passwordAgain' : passwordAgain,
				  },
				  success: function(result){
					  if(result.code == 0){
						  alert('重置成功，请重新登录');
						  location.href = "/";
					  }else{
						  alert('重置失败，请稍后再试');
					  }
				  }
			});
		});
    </script>
    </body>
</html>
