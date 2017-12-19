/*
Name: 			Dashboard - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0
*/

(function( $ ) {

	'use strict';


	/*
	Flot: Basic
	*/
	var flotDashBasic = $.plot('#flotDashBasic', flotDashBasicData, {
		series: {
			lines: {
				show: true,
				fill: true,
				lineWidth: 2,
				fillColor: {
					colors: [{
						opacity: 0.45
					}, {
						opacity: 0.45
					}]
				}
			},
			points: {
				show: true
			},
			shadowSize: 0
		},
		grid: {
			hoverable: true,
			clickable: true,
			borderColor: 'rgba(0,0,0,0.1)',
			borderWidth: 1,
			labelMargin: 15,
			backgroundColor: 'transparent'
		},
		yaxis: {
			min: 0,
			max: 200,
			color: 'rgba(0,0,0,0.1)'
		},
		xaxis: {
			mode: 'categories',
			color: 'rgba(0,0,0,0)'

		},
		tooltip: true,
		tooltipOpts: {
			content: '%s: Value of %x is %y',
			shifts: {
				x: -60,
				y: 25
			},
			defaultTheme: false
		}
	});

	$(this).on("styleSwitcher.setColor", function(ev) {
		flotDashBasicData[0].color = ev.color;
		flotDashBasic.setData(flotDashBasicData);
		flotDashBasic.draw();
	});

	if (typeof($.browser) != 'undefined') {
		if($.browser.mobile) {
			flotDashBasicData[0].color = '#0088cc';
			flotDashBasic.setData(flotDashBasicData);
			flotDashBasic.draw();
		}
	}


var flotDashBasic1 = $.plot('#flotDashBasic1', flotDashBasicData1, {
		series: {
			lines: {
				show: true,
				fill: true,
				lineWidth: 2,
				fillColor: {
					colors: [{
						opacity: 0.45
					}, {
						opacity: 0.45
					}]
				}
			},
			points: {
				show: true
			},
			shadowSize: 0
		},
		grid: {
			hoverable: true,
			clickable: true,
			borderColor: 'rgba(0,0,0,0.1)',
			borderWidth: 1,
			labelMargin: 15,
			backgroundColor: 'transparent'
		},
		yaxis: {
			min: 0,
			max: 200,
			color: 'rgba(0,0,0,0.1)'
		},
		xaxis: {
			mode: 'categories',
			color: 'rgba(0,0,0,0)'

		},
		tooltip: true,
		tooltipOpts: {
			content: '%s: Value of %x is %y',
			shifts: {
				x: -60,
				y: 25
			},
			defaultTheme: false
		}
	});

	$(this).on("styleSwitcher.setColor", function(ev) {
		flotDashBasicData1[0].color = ev.color;
		flotDashBasic1.setData(flotDashBasicData1);
		flotDashBasic1.draw();
	});

	if (typeof($.browser) != 'undefined') {
		if($.browser.mobile) {
			flotDashBasicData1[0].color = '#0088cc';
			flotDashBasic1.setData(flotDashBasicData1);
			flotDashBasic1.draw();
		}
	}

	/*
	Flot: Real-Time
	*/
	
	/*
	Sparkline: Line
	*/
	var sparklineLineDashOptions = {
		type: 'line',
		width: '80',
		height: '55',
		lineColor: '#CCCCCC'
	};

	$("#sparklineLineDash").sparkline(sparklineLineDashData, sparklineLineDashOptions);

	/*
	Map
	*/
	var vectorMapDashOptions = {
		map: 'world_en',
		backgroundColor: null,
		color: '#FFFFFF',
		hoverOpacity: 0.7,
		selectedColor: '#005599',
		enableZoom: true,
		borderWidth:1,
		showTooltip: true,
		values: sample_data,
		scaleColors: ['#CCCCCC'],
		normalizeFunction: 'polynomial'
	};

	$('#vectorMapWorld').vectorMap(vectorMapDashOptions);

	$(this).on("styleSwitcher.setColor", function(ev) {
		$("#vectorMapWorld").vectorMap('set', 'scaleColors', [ev.color]);
	});

	if (typeof($.browser) != 'undefined') {
		if($.browser.mobile) {
			$("#vectorMapWorld").vectorMap('set', 'scaleColors', ['#0088cc']);
		}
	}

	}).apply( this, [ jQuery ]);