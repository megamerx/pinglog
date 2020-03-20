<?php
//graph.php
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="refresh" content="2">


<script>
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
	theme: "light2",
	title: {
		text: "Daily Ping log"
	},
	axisY: {
		title: "Milliseconds",
		titleFontSize: 24
	},
	data: [{
		type: "column",
		yValueFormatString: "#,### ms",
		dataPoints: dataPoints
	}]
});

function addData(data) {
	for (var i = 0; i < data.length; i++) {
        console.log(i, data[i].date, new Date(data[i].date));

        d = new Date(data[i].date * 1000);
		dataPoints.push({
			x: d,
			y: data[i].units
		});
	}
	console.table(dataPoints);
    chart.render();



}

//$.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales-data.json", addData);
$.getJSON("pinglog.php", addData);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/canvasjs.min.js"></script>

<?php echo " Used mem : " . number_format(memory_get_usage(), 0) . ' bytes';?>
</body>
</html>
