$(function(){
	initQueryMap();
	initDateTimePicker();
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
              {data: 'remark'},
              {data: 'create_time'},
              
         ],
	});
	
	$('.search-button').click(function(){
		table.ajax.reload();
	});
	

});


function initQueryMap(){
	$.ajax({
		type: "get", 
		url: "/getCategoryMap", 
		dataType: "json",
		success: function(result){ 
			if(result.code==0) {
				var accountCategoryMap = result.data.accountCategoryMap;
				var incomeExpendCategoryMap = result.data.incomeExpendCategoryMap;
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
		format: 'YYYY-MM-DD hh:mm',
		locale: 'zh-cn',
	});
	$('#add-time-end').datetimepicker({
		format: 'YYYY-MM-DD hh:mm',
		locale: 'zh-cn',
	});
}