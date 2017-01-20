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
		<link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
    <div class="main">
	    <div id="search" class="form-horizontal">
	    	<div class="form-group search-form">
	    		<label class="col-sm-2 control-label">分类</label>	
	    		<div class="col-sm-3 form-account-catetory">
	    			<select class="form-control account-options">
	    				<option value="-1">请选择</option>
	    			</select>
	    		</div>
	    		<label class="col-sm-2 control-label">金额</label>	
	    		<div class="col-sm-5">
	    			<div class="money-begin pull-left">
	    				<input type="text" class="form-control" name="money-begin">
	    			</div>
	    			<div class="money-option">-</div>
	    			<div class="money-end pull-right">
	    				<input type="text" class="form-control" name="money-end">
	    			</div>
	    		</div>
	    		<label class="col-sm-2 control-label">来源</label>	
	    		<div class="col-sm-3 form-in-ex-category">
	    			<div class="in-ex-category pull-left">
	    				<select class="form-control in-ex-category-options">
	    					<option value="-1">请选择</option>
	    				</select>
	    			</div>
	    		</div>
	    		<label class="col-sm-2 control-label">添加时间</label>	
	    		<div class="col-sm-5">
	    			<div class="add-time-begin pull-left">
	    				<input type="text" class="form-control" name="add-time-begin">
	    			</div>
	    			<div class="add-time-option">-</div>
	    			<div class="add-time-end pull-right">
	    				<input type="text" class="form-control" name="add-time-end">
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
			            <th>时间</th>
			            <th>分类</th>
			            <th>金额</th>
			            <th>账户</th>
			            <th>备注</th> 
			        </tr>
			    </thead>
			    <tbody>
			    </tbody>
			</table>
		</div>

	</div>
    	<a href='/logout'>登出</a>
    <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>
