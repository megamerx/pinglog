<!DOCTYPE HTML>
<html>
<head>
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
        color: "red",
		yValueFormatString: "#,### ms",
		dataPoints: dataPoints
	}]
});

    function addData(new_data) {
        var data = new_data.data;
        
        //console.log(i, data[i].date, new Date(data[i].date));
        for (var i = 0; i < data.length; i++) {
            //console.table(i, data[i].date, new Date(data[i].date));
            
            d = new Date(data[i].date * 1000);
            dataPoints.push({
                x: d,
                y: data[i].units
            });
        }
        
        //console.table(dataPoints);
        chart.render();

        console.log(new_data.dates);
        dates = new_data.dates;
        var $sel  = $('#selectedDates');
        var curent = new_data.stats.dateUsed;

        for (var j = 0; j < dates.length; j++) {
            dateText = dates[j]; //console.log(dateText);            
            var selected = curent == dateText ? ' selected="selected" ' : '';
            $sel.append('<option value="' + dateText + '" ' +  selected + ' >' + dateText + '</option>'); 
        }
        //console.log(new_data.stats);

        //process dates
        $('#pinglogused').html(new_data.stats.mem_usage);
    }

    //$.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales-data.json", addData);
    $.getJSON("pingrto.php<?php echo isset($_GET['date']) ? '?date=' . $_GET['date']: '';?>", addData);

}

function doChangeUrl(obj) {
    dateVal = obj.value;
    url = 'pingraph-rto.php?date=' + dateVal;
    location.href = url;
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<div id="dates">
    <select id="selectedDates" onchange="doChangeUrl(this);">
    </select>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/canvasjs.min.js"></script>
<?php echo " Used mem : " . number_format(memory_get_usage(), 0) . ' bytes';?>
&nbsp; PinglogUsage : <span id="pinglogused">0</span>
</body>
</html>
