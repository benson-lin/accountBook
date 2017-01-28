$(function(){
	lineChart();
});


function lineChart(){//折线图
	//七天内的收支
	var expend = [];
	var income = [];
	var sevenDates = [];
	$.ajax({
		type: "GET", 
		url: "/lineChart", 
		dataType: "json",
		async : false,
		success: function(result){ 
			if(result.code==0) {
				income = result.data.income;
				expend = result.data.expend;
				sevenDates = result.data.sevenDates;
			}
		} 
	});
	var lineChart = echarts.init(document.getElementById('line-chart'));
	option = {
		    title : {
		        text: '七天内收支记录',
//		        subtext: '纯属虚构'
		    },
		    tooltip : {
		        trigger: 'axis'
		    },
		    legend: {
		        data:['收入','支出']
		    },
		    toolbox: {
		        show : true,
		        feature : {
		            dataView : {show: true, readOnly: false},
		            magicType : {show: true, type: ['line', 'bar']},
		            restore : {show: true},
		            saveAsImage : {show: true}
		        }
		    },
		    calculable : true,
		    xAxis : [
		        {
		            type : 'category',
		            data : sevenDates//['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
		        }
		    ],
		    yAxis : [
		        {
		            type : 'value'
		        }
		    ],
		    series : [
		        {
		            name:'收入',
		            type:'bar',
		            data: income, //[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6],
		            markPoint : {
		                data : [
		                    {type : 'max', name: '最大值'},
		                    {type : 'min', name: '最小值'}
		                ]
		            },
		            markLine : {
		                data : [
		                    {type : 'average', name: '平均值'}
		                ]
		            }
		        },
		        {
		            name:'支出',
		            type:'bar',
		            data: expend, //[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6],
		            markPoint : {
		            	 data : [
				                    {type : 'max', name: '最大值'},
				                    {type : 'min', name: '最小值'}
				         ]
//		                data : [
//		                    {name : '年最高', value : 182.2, xAxis: 7, yAxis: 183},
//		                    {name : '年最低', value : 2.3, xAxis: 11, yAxis: 3}
//		                ]
		            },
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
		        }
		    ]
		};


    lineChart.setOption(option);

}

function barChart(){//饼图
	
}

function example(){//例子
	
	var example = echarts.init(document.getElementById('line-chart'));
    var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };
    example.setOption(option);

}