<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="{{ URL::asset('plugins/js/jquery/jquery-3.1.1.min.js') }}"></script>

    </head>
    <body>
登录
    <form action="login" method="POST">
    	<input type="text" name="login-nickname">
    	<input type="password" name="login-password">
    	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    	<input type="submit" value="登录" >
    </form>
    
注册
<input type="text" id="register-username">
    	<input type="text" id="register-nickname">
    	<input type="password" id="register-password">
    	<input type="button" value="注册" id="registerButton">
    </body>
            <script type="text/javascript" src="{{ URL::asset('js/basic.js') }}"></script>
</html>
