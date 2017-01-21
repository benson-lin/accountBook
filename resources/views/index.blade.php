<!DOCTYPE html>
<html>
    <head>
        <title>首页</title>
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="plugins/datatables/jquery.dataTables.js"></script>    
		<link rel="stylesheet" type="text/css" href="plugins/datatables/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="plugins/datatables/datatables.js"></script>    
		<script type="text/javascript" charset="utf8" src="plugins/datatables/dataTables.bootstrap.js"></script>    
		<link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
		<script src="plugins/bootstrap-datetimepicker/moment.js"></script>
		<script src="plugins/bootstrap-datetimepicker/zh-cn.js"></script>
		<script src="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
	<script src="js/index.js"></script>	
    <link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/common.css">
    </head>
    <body>
    
    <div class="body">
    	<div class="top">
        	<span>Account Book</span>
        	<div class="info">
        		<div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <span id="nickname"></span>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">个人信息</a></li>
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
    	                <li><a href="#section-3">个人信息</a></li>
    	                <li><a href="#section-4">第四部分</a></li>
    	                <li><a href="#section-5">第五部分</a></li>
    	            </ul>
    			</div>
    		</div>    
    	    <div class="main col-sm-10 ">
    		    <div id="search" class="form-horizontal">
    		    	<div class="form-group search-form">
    		    		<label class="col-sm-2 control-label">账户</label>	
    		    		<div class="col-sm-3 form-account-catetory">
    		    			<select class="form-control account-options">
    		    				<option value="">请选择</option>
    		    			</select>
    		    		</div>
    		    		<label class="col-sm-2 control-label">金额</label>	
    		    		<div class="col-sm-5">
    		    			<div class="form-money-begin pull-left">
    		    				<input type="text" class="form-control" name="money-begin">
    		    			</div>
    		    			<div class="money-option">-</div>
    		    			<div class="form-money-end pull-right">
    		    				<input type="text" class="form-control" name="money-end">
    		    			</div>
    		    		</div>
    		    		<label class="col-sm-2 control-label">类别</label>	
    		    		<div class="col-sm-3 form-in-ex-category">
    		    			<div class="in-ex-category pull-left">
    		    				<select class="form-control in-ex-category-options">
    		    					<option value="">请选择</option>
    		    				</select>
    		    			</div>
    		    		</div>
    		    		<label class="col-sm-2 control-label">添加时间</label>	
    		    		<div class="col-sm-5">
    		    			<div class="add-time-begin pull-left">
    		    				<input type="text" class="form-control" name="add-time-begin" id="add-time-begin">
    		    			</div>
    		    			<div class="add-time-option">-</div>
    		    			<div class="add-time-end pull-right">
    		    				<input type="text" class="form-control" name="add-time-end" id="add-time-end">
    		    			</div>
    		    		</div>
    	    			<label class="col-sm-2 control-label">备注</label>	
    		    		<div class="col-sm-3 form-remark">
    		    			<div class="remark pull-left">
    		    				<input type="text" class="form-control" name="remark">
    		    			</div>
    		    		</div>
    		    	</div>
    		    		    	
    		    	<div class="form-group button-form">
    		    		<div class="col-sm-4 col-sm-offset-3">
    		    			<button name="search-button" class="btn btn-primary search-button">查询</button>
    		    		</div>
    		    	</div>
    		    </div>
    			<div id="list">
    				<table id="myTable" class="display">
    				     <thead>
    				        <tr>
    				            <th>ID</th>
    				            <th>添加时间</th>
    				            <th>分类</th>
    				            <th>金额</th>
    				            <th>账户</th>
    				            <th>备注</th> 
    				            <th>创建时间</th> 
    				        </tr>
    				    </thead>
    				    <tbody>
    				    </tbody>
    				</table>
    			</div>
    	
    		</div>    
        
        </div>
    </div>
    </body>

</html>
