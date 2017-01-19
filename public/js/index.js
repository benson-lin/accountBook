$(function(){
	$('#myTable').DataTable({
		dom: "<'page-table'ftr><'page-table-paginate clearfix'lpi>",
		pageLength: 15,
		paging: true,
		serverSide: true,
		searching: false,
		info: true,
		processing: true,
		ordering: false,
		audoWidth:false,
		lengthMenu: [10,15,20,25,100],
        ajax : {
        	method: 'GET',
        	url: '/queryRecords',
        	data: function(d){
        		var data = {};
        		data.type=1;
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
         language: {
             "sProcessing": "处理中...",
             "sLengthMenu": "显示 _MENU_ 项结果",
             "sZeroRecords": "没有匹配结果",
             "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
             "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
             "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
             "sInfoPostFix": "",
             "sSearch": "搜索:",
             "sUrl": "",
             "sEmptyTable": "表中数据为空",
             "sLoadingRecords": "载入中...",
             "sInfoThousands": ",",
             "oPaginate": {
                 "sFirst": "首页",
                 "sPrevious": "上页",
                 "sNext": "下页",
                 "sLast": "末页"
             },
             "oAria": {
                 "sSortAscending": ": 以升序排列此列",
                 "sSortDescending": ": 以降序排列此列"
             }
         },
	});
	
});