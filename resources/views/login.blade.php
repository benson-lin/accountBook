<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/layui/layui.js"></script>
        <script src="plugins/layui/css/layui.css"></script>	
    </head>
    <body>
    <div class="body">
    	<div class="signIn"><span>Sign in to account book</span></div>
	    <div class="main">
	          <ul id="myTab" class="nav nav-tabs">
	        	<li class="active">
	        		<a href="#login-form" data-toggle="tab">
	        			登录
	        		</a>
	        	</li>
	        	<li><a href="#login-register" data-toggle="tab">注册</a></li>
	        </ul>
	         <div id="myTabContent" class="tab-content">
	        	<div class="tab-pane fade in active" id="login-form">
	              	<form role="form" action="login" method="POST">
	                  <div class="form-group" >
	                  	<p>Nickname</p>
	                    <input type="text" class="form-control" id="login-nickname" name="login-nickname">
	                    <p>Password</p>
	                    <input type="password" class="form-control" id="login-password"  name="login-password">
	                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	                    <input type="submit" class="btn btn-default" value="Sign In" >
	                  </div>
	                </form>
	        	</div>
	        	<div class="tab-pane fade" id="login-register">
	    			<form role="form" action="login" method="POST">
	                  <div class="form-group" >
	                    <p>Email</p>
	                    <input type="text" class="form-control" id="register-email" name="register-email">
	                    <p>Nickname</p>
	                    <input type="text" class="form-control" id="register-nickname" name="register-nickname">
	                    <p>Password</p>
	                    <input type="password" class="form-control" id="register-password"  name="register-password">
	                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	                    <input type="button" class="btn btn-default" value="Sign Up"  id="registerButton">
	                  </div>
	                </form>
	        	</div>
	        </div>
	    
	    </div>
    
    </div>
    	
    	
    </body>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/basic.js"></script>
</html>
