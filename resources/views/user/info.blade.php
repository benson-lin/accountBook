<!DOCTYPE html>
<html>
    <head>
        <title>个人信息</title>
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="plugins/jquery/jquery-3.1.1.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/echarts/echarts.min.js"></script>
        
        <script src="plugins/layui/layui.js"></script>
        <script src="plugins/bootstrap-dialog/bootstrap-dialog.min.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/bootstrap-dialog/bootstrap-dialog.min.css">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/user.css">
		<script src="/js/common.js"></script>

		
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
    	                <li><a href="/main">收支汇总</a></li>
    	                <li><a href="/statistics">收支统计</a></li>
    	                <li class="active"><a href="/info">个人信息</a></li>
    	            </ul>
    			</div>
    		</div>    
    	    <div class="main col-sm-10">
    	    	<div class="user-info">
    	    		<div class="user-info-nickname">
    	    		    <div class="col-sm-2">用户名</div>
    	    			<div class="col-sm-3 nickname"></div>
    	    			<div class="col-sm-3"><input type="button" data-toggle="modal"  id="modifyNicknameButton" value="修改" class="btn btn-default"></div>
    	    		</div>
					<div class="user-info-email">
	    	    		<div class="col-sm-2">邮箱</div>
	    	    		<div class="col-sm-3 email">　</div>
    	    		</div>
    	    	</div>
    		</div>    
        
        </div>
    </div>
    
      <!-- Modal -->
  <div class="modal fade" id="modifyNicknameModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">修改昵称</h4>
        </div>
        <div class="modal-body">
        	<div class="form-group" >
	          	<div class="col-sm-2">新昵称：</div>
	          	<div class="col-sm-6"><input type="text" id="newNickname" class="form-control"></div>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="modifyNickname">确定</button>
        </div>
      </div>
      
    </div>
  </div>
  
<!--     <div class="modal hide fade" id="modifyNicknameModal" tabindex="-1" role="dialog">
		<div class="col-sm-2">
    			<input type="text">
    	</div>
    	<div class="col-sm-6">
    			<input type="text" id="newNickname">
    	</div>
	</div> -->
    <script src="/js/user.js"></script>
</body>
</html>
