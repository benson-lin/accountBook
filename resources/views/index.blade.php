<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <!-- bootstrap jquery -->
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="plugins/jquery-fileDownload/jquery.fileDownload.js"></script>
        <script src="plugins/fileupload/fileupload.js"></script>
        <!-- datatables -->
		<script type="text/javascript" charset="utf8" src="plugins/datatables/jquery.dataTables.js"></script>    
		<link rel="stylesheet" type="text/css" href="plugins/datatables/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="plugins/datatables/datatables.js"></script>    
		<script type="text/javascript" charset="utf8" src="plugins/datatables/dataTables.bootstrap.js"></script>    
		<link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap.css">
		<!-- bootstrap-datetimepicker  -->
		<link rel="stylesheet" href="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
		<script src="plugins/bootstrap-datetimepicker/moment.js"></script>
		<script src="plugins/bootstrap-datetimepicker/zh-cn.js"></script>
		<script src="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
		<!-- layer -->
        <script src="plugins/layui/layui.js"></script>
		<link rel="stylesheet" href="plugins/layui/css/layui.css"  media="all">
		<!-- my -->
   	    <link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<script src="js/common.js"></script>
		<script src="js/user.js"></script>
		<script src="js/index.js"></script>	

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
    	                <li><a href="/info">个人信息</a></li>
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
    		    		<div class="col-sm-1 col-sm-offset-3">
    		    			<button name="search-button" class="btn btn-primary search-button">查询</button>
    		    		</div>
    		    		<div class="col-sm-1 batch-export">
    		    			<button name="batch-export" class="btn btn-default batch-export-button">批量导出</button>
    		    		</div>
    		    	</div>
    		    </div>
    		    <div class="add-import-export-record">
    		    	<div class="col-sm-1 add-record">
    		    			<button name="add-record" class="btn btn-default add-record-button">添加记录</button>
    		    	</div>
    		    	<div class="col-sm-1 batch-import">
    		    			<button name="batch-import" class="btn btn-default batch-import-button">批量导入</button>
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
    				            <th>操作</th> 
    				        </tr>
    				    </thead>
    				    <tbody>
    				    </tbody>
    				</table>
    			</div>
    	
    		</div>    
        
        </div>
    </div>
    
    <div class="add-record-form">
		<div class="layui-form">
		  <div class="layui-form-item">
		    <label class="layui-form-label">添加时间</label>
		    <div class="layui-input-block">
		    	<input class="layui-input" placeholder="" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="addTime">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">类型</label>
		    <div class="layui-input-block">
		      <input type="radio" name="type" value="2" title="支出" checked  lay-filter="type">
		      <input type="radio" name="type" value="1" title="收入" lay-filter="type">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">金额</label>
		    <div class="layui-input-block">
		      <input type="text" name="money" required lay-verify="required" placeholder="请输入金额" autocomplete="off" class="layui-input" >
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">账户</label>
		    <div class="layui-input-block">
		      <select name="accountCategory" lay-verify="required" class="account-options" lay-filter="accountCategory">
<!-- 		        <option value="">请选择</option> -->
		      </select>
		    </div>
		  </div>
  		  <div class="layui-form-item">
		    <label class="layui-form-label">类别</label>
		    <div class="layui-input-block">
		      <select name="inExCategory" lay-verify="required" class="add-record-in-ex-category-options" >
<!-- 		        <option value="">请选择</option> -->
		      </select>
		    </div>
		  </div>
  		  <div class="layui-form-item">
		    <label class="layui-form-label">备注</label>
      		<div class="layui-input-block">
		      		<textarea name="remark" placeholder="请输入内容" class="layui-textarea"></textarea>
		    </div>
		  </div>
		 <div class="layui-form-item">
		    <div class="layui-input-block">
		      <button class="layui-btn" lay-submit lay-filter="*">提交</button>
		    </div>
		  </div> 
		</div>
    </div>
    </body>


</html>
