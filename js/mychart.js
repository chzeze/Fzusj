// JavaScript Document
$(document).ready(function() {
	var options={
		chart: {
		renderTo: 'container'
		},
		title: {
		text: '��ֵ����ͼ'
		},
		subtitle: {
		text: 'Source:  Zeze.com'
		},
		xAxis:{
		categories: [<?php echo rtrim($dates2,",");?>]
		},
		yAxis:{
		title: {
		text: 'Net worth (Ԫ)'
		}
		
	},
	legend: {
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'middle',
		borderWidth: 0
		},
		series: [
		{
		name: '���ױ�500',
		data: [<?php echo $dates3?>]
		}
	]
};
var chart = new Highcharts.Chart(options);
});