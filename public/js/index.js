$(function(){
	
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
//        		data.type=1;
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
              
         ],
	});
	
	$('.search-button').click(function(){
		table.ajax.reload();
	});
	
	getQueryMap();
});


function getQueryMap(){
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