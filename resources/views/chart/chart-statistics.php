<!DOCTYPE html>
<html>
    <head>
        <title>首页</title>
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/echarts/echarts.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/common.css">
		        <script src="plugins/layui/layui.js"></script>
		<script src="/js/common.js"></script>
		<script src="/js/user.js"></script>
		
    </head>
<body>
    <div class="body">
    	<div class="top">
        	<span>Account Book</span>
        	<div class="info">
        		<div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <span class="nickname"></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/info">个人信息</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/logout">退出登录</a></li>
                  </ul>
                </div>
        	</div>
        </div>
        <div class="bottom">
    		<div class="col-sm-2">
    			<div class="menu">
    	            <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="600">
    	                <li class="active"><a href="/main">收支汇总</a></li>
    	                <li><a href="/statistics">收支统计</a></li>
    	                <li><a href="/info">个人信息</a></li>
    	                <li><a href="#section-4">第四部分</a></li>
    	                <li><a href="#section-5">第五部分</a></li>
    	            </ul>
    			</div>
    		</div>    
    	    <div class="main col-sm-10 ">
    	    	<div class="col-sm-2" id="main-data">
    	    		<span>余额：</span>
    	    	</div>
				<div class="col-sm-10" id="main-chart">
					<div class="col-sm-6" id="line-chart" style="width: 800px;height:400px;"></div>
					<div class="col-sm-2" id="expend-bar-chart" style="width: 500px;height:400px;"></div>
					<div class="col-sm-2" id="income-bar-chart" style="width: 500px;height:400px;"></div>
				</div>    		    
    		</div>    
        
        </div>
    </div>
    <script type="text/javascript" src="js/chart-statistics.js"></script>
    <link rel="stylesheet" type="text/css" href="css/chart-statistics.css">
</body>
</html>
