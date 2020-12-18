$(document).ready( function() {
	var dataLength = 0;
    var i;

    // Prod vs Costs
	function make_graphs() {
		var data = [];
        $.getJSON("chart_stuff/cargar_productos.php", function (result) {
            dataLength = result.length;
            for( i = 0; i < dataLength; i++ )
            {
                data.push({
                    label: result[i].valorx,
                    y: parseInt(result[i].valory)
                });
            };

            chart.render();
        });

        var chart = new CanvasJS.Chart("chart", {
            title: {
                text: "Productos vs. Costo"
            },
            axisX: {
                title: "Productos"
            },
            axisY: {
                title: "Costo ($)",
                prefix: "$"
            },
            data: [{
                type: "line",
                yValueFormatString: "$#,##0.##",
                dataPoints: data
            }]
        });
    }

    make_graphs();

    // Prod vs Costs
	function make_otherbar() {
		var data = [];
        $.getJSON("chart_stuff/cargar_productos_otherchart.php", function (result) {
            dataLength = result.length;
            for( i = 0; i < dataLength; i++ )
            {
                data.push({
                    label: result[i].valorx,
                    y: parseInt(result[i].valory)
                });
            };

            chart.render();
        });

        var chart = new CanvasJS.Chart("otherchart", {
        	animationEnabled: true,
			theme: "light2",
			title: {
				text: "Ventas Acumuladas"
			},
			axisY: {
				titleFontSize: 24,
				includeZero: false,
				prefix: "$",
				crosshair: {
					enabled: true,
					valueFormatString: "$#,##0.##",
					snapToDataPoint: true
				}
			},
			axisX: {
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			data: [{
				type: "line",
				yValueFormatString: "$#,##0.##",
				dataPoints: data
			}]
        });

        chart.render();
    }

    make_otherbar();

    // Pie Chart
    function make_piechart() {
    	var data = [];
        $.getJSON("chart_stuff/cargar_productos_pie.php", function (result) {
            dataLength = result.length;
            for( i = 0; i < dataLength; i++ )
            {
                data.push({
                	label: result[i].valorx,
                    y: parseInt(result[i].valory)
                });
                
            };

            chart.render();
        });

        var chart = new CanvasJS.Chart("piechart", {
			animationEnabled: true,
			title: {
				text: "Mis Productos"
			},
			data: [{
				type: "doughnut",
				startAngle: 60,
				indexLabelFontSize: 17,
				indexLabel: "{label} - #percent%",
				toolTipContent: "<b>{label}:</b> ${y} (#percent%)",
				dataPoints: data
			}]
        });

        chart.render();
    }

    make_piechart();
	
	// Bar chart
	function create_barchart()
	{
		var data = [];
		$.getJSON("chart_stuff/cargar_productos_barchart.php", function (result) {
            dataLength = result.length;
            for( i = 0; i < dataLength; i++ )
            {
                data.push({
                    y: parseInt(result[i].valory),
                    label: result[i].valorx
                });
            };

            barchart.render();
        });

		var barchart = new CanvasJS.Chart("barchart", {
			title: {
                text: "Productos vs Ventas"
            },
			axisX: {
				title: "Productos",
				labelFontSize: 14,
			},
			axisY: {
				title: "Cantidad Vendidas",
				gridThickness: 0,
				labelFontSize: 14,
				lineThickness: 2
			},
			data: [{ type: "column", dataPoints: data }]
		});

		barchart.render();
	}

	create_barchart();
});