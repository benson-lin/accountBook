<!DOCTYPE html>
<html>
    <head>
        <title>注册失败</title>
        <meta charset="utf-8">
        <style type="text/css">
        	
        	.body {
        		width: 500px;
        		border: 3px solid #aff;
        		margin: 50px auto;        	
        	}

        	.body p {
        		text-align: center;
        		font-family:"Microsoft YaHei",微软雅黑;
        		font-size: 30px;
        	}

        	.body p a {
        		color: red;	
        	}
        </style>
    </head>
    <body>
    <div class="body">
		<p>注册失败</p>
		<p>原因：{{ $msg }}</p>
    </div>
    </body>
</html>
