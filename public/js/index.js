$(function(){
	
	initQueryMap();
	initDateTimePicker();
	getFormListData();
	initEvent();
});

function initEvent(){
	$('.batch-export-button').click(function(){
		var data = {};
 		var account = $('.account-options').val();
		var moneyBegin = $("input[name=money-begin]").val();
		var moneyEnd = $("input[name=money-end]").val();
		var inExpend = $('.in-ex-category-options').val();
		var addTimeBegin = $("input[name=add-time-begin]").val();
		var addTimeEnd = $("input[name=add-time-end]").val();
		var remark = $("input[name=remark]").val();
		data.addTimeGreater = addTimeBegin;
		data.addTimeLess = addTimeEnd;
		data.moneyGreater = moneyBegin;
		data.moneyLess = moneyEnd;
		data.accountCategoryId = account;
		data.remark = remark;
		data.incomeExpendCategoryId = inExpend;
		
		 $.fileDownload('/exportRecords',{
	            httpMethod: "POST",
	            data : data
	        }).done(function() {}).fail(function() {alert('导出文件失败');});
	});
	 $('.batch-import-button').FileUpload({  //选择上传文件
	        action: '/batchImportRecords',
	        name: 'recordsExcel',
	        onComplete: function(id, filename, result){
	        	layer.msg(result.message);
	        	table.ajax.reload();
	        }
	  });

	
	$('.search-button').click(function(){
		table.ajax.reload();
	});
	$('.add-record-button').click(function(){
		$.each(incomeExpendCategoryMap, function(index, inExpend){
			if(inExpend.type == 2){
				$(".add-record-in-ex-category-options").append("<option value="+inExpend.id+">"+inExpend.name+"</option>");
			}
		});
		layui.use(['form', 'laydate'], function(){
			var layer = layui.layer;
			layer.open({
				type: 1,
				area: ['500px', '560px'],
				title: '添加记录',
				content: $('.add-record-form').html(),
				success: function(layero, index){
						var form = layui.form().render();
						form.on('radio(type)', function(data){
							$(".add-record-in-ex-category-options").text('');
							$.each(incomeExpendCategoryMap, function(index, inExpend){
								if(inExpend.type == data.value){
									$(".add-record-in-ex-category-options").append("<option value="+inExpend.id+">"+inExpend.name+"</option>");
								}
							});
							form.render('select');
						});
						form.on('submit(*)', function(data){
							var allField = data.field;
							$.ajax({
								type: "POST", 
								url: "/addRecord", 
								dataType: "json",
								data: {
									type: allField.type,
									money: allField.money,
									addTime: allField.addTime,
									accountCategoryId: allField.accountCategory,
									incomeExpendCategoryId: allField.inExCategory,
									remark: allField.remark
								},
								success: function(result){ 
									if(result.code==0) {
										layer.msg(result.message);
										layer.closeAll('page');
										table.ajax.reload();
										return true;
									}else{
										layer.msg(result.message);
										return false;
									}
								} 
							});
						});
	
	
				}
			});
		});
	});
	
}


function initQueryMap(){
	$.ajax({
		type: "get", 
		url: "/getCategoryMap", 
		dataType: "json",
		success: function(result){ 
			if(result.code==0) {
				accountCategoryMap = result.data.accountCategoryMap;
				incomeExpendCategoryMap = result.data.incomeExpendCategoryMap;
				$.each(accountCategoryMap, function(index, account){
					$(".account-options").append("<option value="+account.id+">"+account.name+"</option>");
				});
				$.each(incomeExpendCategoryMap, function(index, inExpend){
					$(".in-ex-category-options").append("<option value="+inExpend.id+">"+inExpend.name+"</option>");
				});
			}
		} 
	});
}


function initDateTimePicker(){
	$('#add-time-begin').datetimepicker({
		format: 'YYYY-MM-DD 00:00:00',
		locale: 'zh-cn',
	});
	$('#add-time-end').datetimepicker({
		format: 'YYYY-MM-DD 23:59:59',
		locale: 'zh-cn',
	});
}


function getFormListData(){
	
	//获取表单内容
	table = $('#myTable').DataTable({
		dom: "<'page-table'ftr><'page-table-paginate clearfix'lpi>",
		pageLength: 15,
		paging: true,
		serverSide: true,
		scrollX: true,
        ajax : {
        	method: 'GET',
        	url: '/queryRecords',
        	data: function(d){
        		var data = {};
        		var account = $('.account-options').val();
        		var moneyBegin = $("input[name=money-begin]").val();
        		var moneyEnd = $("input[name=money-end]").val();
        		var inExpend = $('.in-ex-category-options').val();
        		var addTimeBegin = $("input[name=add-time-begin]").val();
        		var addTimeEnd = $("input[name=add-time-end]").val();
        		var remark = $("input[name=remark]").val();
        		data.addTimeGreater = addTimeBegin;
        		data.addTimeLess = addTimeEnd;
        		data.moneyGreater = moneyBegin;
        		data.moneyLess = moneyEnd;
        		data.accountCategoryId = account;
        		data.remark = remark;
        		data.incomeExpendCategoryId = inExpend;
        		
        		data.limit = d.length;
        		data.page = d.start/d.length+1;
        		return data;
        	},
        	dataSrc: function(result){
        		result.recordsTotal = result.data.total;
        		result.recordsFiltered = result.data.total;
           	    return result.data.data;
        	}
        },
        columns: [
              {data: 'id'},
              {data: 'add_time'},
              {
            	  render: function(data, type, row) {
            		  return row.income_expend.name;
            	  }
              },
              {data: 'money'},
              {
            	  render: function(data, type, row) {
            		  return row.account.name;
            	  }
              },
              {
            	  render: function(data, type, row) {
            		 return (row.remark || '') ? row.remark :  '--' ;
            	  }
              },
              {data: 'create_time'},
              {
            	  render: function(data, type, row) {
            		 return '<a href="#" onclick=removeRecords('+row.id+') class="remove-record">移除</a>';
            	  }
              },
         ],
	});
}

function removeRecords(recordId){
	
	layer.confirm('是否移除该记录？', {
		  btn: ['是','否'] //按钮
	}, function(){
		$.ajax({
			type: "POST", 
			url: "/removeRecords", 
			dataType: "json",
			data: {
				id: recordId,
			},
			success: function(result){ 
				if(result.code==0) {
					layer.msg(result.message, {icon: 1});
					table.ajax.reload();
				}else{
					layer.msg(result.message);
				}
			} 
		});
	  
	}, function(){
//	  layer.msg('也可以这样', {
//	    time: 20000, //20s后自动关闭
//	    btn: ['明白了', '知道了']
//	  });
	});

}
