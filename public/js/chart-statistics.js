$(function(){
	
	getRemainMoneyByAccount();
	barChart();
	lineChart();
});

function barChart(){//饼图
	var expendRecords = [];
	var incomeRecords = [];
	var incomeAccountNames = [];
	var expendAccountNames = [];
	$.ajax({
		type: "GET", 
		url: "/barChart", 
		dataType: "json",
		async : false,
		success: function(result){ 
			if(result.code==0) {
				incomeAccountNames = result.data.incomeAccountNames;
				incomeRecords = result.data.incomeRecords;
				expendAccountNames = result.data.expendAccountNames;
				expendRecords = result.data.expendRecords;
			}
		} 
	});
	var incomeBarChart = echarts.init(document.getElementById('income-bar-chart'));
	var incomeOption = {
		    title : {
		        text: '近一个月收入金额比例',
//		        subtext: '纯属虚构',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: incomeAccountNames
		    },
		    series : [
		        {
		            name: '账户',
		            type: 'pie',
		            radius : '45%',
		            center: ['50%', '40%'],
		            data: incomeRecords,
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
		};

	incomeBarChart.setOption(incomeOption);
	
	
	
	var expendBarChart = echarts.init(document.getElementById('expend-bar-chart'));
	var expendOption = {
		    title : {
		        text: '近一个月支出金额比例',
//		        subtext: '纯属虚构',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: expendAccountNames
		    },
		    series : [
		        {
		            name: '账户',
		            type: 'pie',
		            radius : '45%',
		            center: ['50%', '40%'],
		            data: expendRecords,
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
		};

	expendBarChart.setOption(expendOption);
	
}

function getRemainMoneyByAccount() {
	$.ajax({
		type: "GET", 
		url: "/getRemainMoneyByAccount", 
		dataType: "json",
		success: function(result){ 
			if(result.code==0) {
				$data = result.data;
				$.each($data, function(index, remainMoney){
					account = remainMoney['name'];
					remainMoney = remainMoney['money'];
					$("#main-data").append('<p class="text-primary">'+account+": "+remainMoney+'元</p>');
				});
			}
		} 
	});
}
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
	var option = {
		    title: {
		        text: '七天内收支记录',
//		        subtext: '纯属虚构'
		    },
		    tooltip: {
		        trigger: 'axis'
		    },
		    legend: {
		    	data:['收入','支出']
		    },
		    toolbox: {
		        show: true,
		        feature: {
		            dataZoom: {},
		            dataView: {readOnly: false},
		            magicType: {type: ['line', 'bar']},
		            restore: {},
		            saveAsImage: {}
		        }
		    },
		    xAxis:  {
		        type: 'category',
		        boundaryGap: false,
		        data: sevenDates, //['周一','周二','周三','周四','周五','周六','周日']
		    },
		    yAxis: {
		        type: 'value',
		        axisLabel: {
		            formatter: '{value} 元'
		        }
		    },
		    series: [
		        {
		            name:'收入',
		            type:'line',
		            data: income, //[11, 11, 15, 13, 12, 13, 10],
		            markPoint: {
		                data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },
		            markLine: {
		                data: [
		                    {type: 'average', name: '平均值'}
		                ]
		            }
		        },
		        {
		            name:'支出',
		            type:'line',
		            data: expend, //[1, -2, 2, 5, 3, 2, 0],
		            markPoint: {
		                data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },
		            markLine: {
		                data: [
		                    {type: 'average', name: '平均值'}
		                ]
		            }
		        }
		    ]
		};

    lineChart.setOption(option);

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