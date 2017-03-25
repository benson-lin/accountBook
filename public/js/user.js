

$(function(){
	user = getUserInfo();
	$(".nickname").text(user.nickname);
	$(".email").text(user.email);
	
	$("#modifyNicknameButton").click(function(){
		$("#modifyNicknameModal").modal("show");
	});
	$("#modifyNickname").click(function(){
		$.ajax({
			  type: 'POST',
			  url: '/modifyNickname',
			  dataType: 'json',
			  data: {
				  'newNickname' : $('#newNickname').val(),
			  },
			  success: function(result){
				  if(result.code == 0){
//					  BootstrapDialog.alert('已成功修改，请重新登录');
					  BootstrapDialog.show({
			          title: 'Information',
			          message: '已成功修改，请重新登录',
			          buttons: [{
			              label: '是',
			              action: function(dialog) {
			            	 
			                    location.href = "/";
			              }
			          }]
			      });
					
				  }else{
					  BootstrapDialog.alert(result.message);
				  }
			  }
		});
//		  BootstrapDialog.show({
//	          title: '警告',
//	          message: '确认修改',
//	          buttons: [{
//	              label: '是',
//	              action: function(dialog) {
//	            	  
////	                  dialog.setMessage('Message 1');
//	              }
//	          }, {
//	              label: '否',
//	              action: function(dialog) {
////	                  dialog.setMessage('Message 2');
//	              }
//	          }]
//	      });
		

	});
	

});


function getUserInfo(){
	var user;
	$.ajax({
		  type: 'get',
		  url: '/getUserInfo',
		  async : false,
		  success: function(result){
			  user = $.parseJSON(result).data;
		  }
	});
	return user;
}


