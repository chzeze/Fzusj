// JavaScript Document
$(document).ready(function() {
	var options={
		chart: {
		renderTo: 'container'
		},
		title: {
		text: '净值折线图'
		},
		subtitle: {
		text: 'Source:  Zeze.com'
		},
		xAxis:{
		categories: [<?php echo rtrim($dates2,",");?>]
		},
		yAxis:{
		title: {
		text: 'Net worth (元)'
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
		name: '容易宝500',
		data: [<?php echo $dates3?>]
		}
	]
};
var chart = new Highcharts.Chart(options);
});