<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
    
    
    login
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
                    <input type="text" class="form-control" id="login-nickname" placeholder="Nickname" name="login-nickname">
                    <input type="password" class="form-control" id="login-password" placeholder="Password" name="login-password">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="submit" class="btn btn-default" value="登录" >
                  </div>
                </form>
        	</div>
        	<div class="tab-pane fade" id="login-register">
        	<!-- 
        		<p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple 
        			TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。</p>
        			 -->
    			<form role="form" action="login" method="POST">
                  <div class="form-group" >
                    <input type="text" class="form-control" id="register-username" placeholder="Username" name="register-username">
                    <input type="text" class="form-control" id="register-nickname" placeholder="Nickname" name="register-nickname">
                    <input type="password" class="form-control" id="register-password" placeholder="Password" name="register-password">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="button" class="btn btn-default" value="注册"  id="registerButton">
                  </div>
                </form>
        	</div>
        </div>
    
    </div>

    	
    	
    	
    	
    </body>
    <link rel="stylesheet" href="css/Basic/login.css">
    <script type="text/javascript" src="js/basic.js"></script>
</html>
