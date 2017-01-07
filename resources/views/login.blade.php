<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta charset="utf-8">
    </head>
    <body>

    <form action="login" method="POST">
    	<input type="text" name="username">
    	<input type="password" name="password">
    	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    	<input type="submit" value="登录" >
    </form>
    </body>
</html>
