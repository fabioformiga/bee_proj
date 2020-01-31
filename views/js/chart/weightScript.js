setInterval(function(){ getData(); }, 3000);

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(getData);

var weightDatas;

//filter_input(INPUT_POST, "action")
function getData() {
    var action = "action=weight";
    var jsonData = $.ajax({
        type: "POST",
        url: "../controller/index.php",
        data: action,
        dataType: "json",
        async: false,
        success: function (response) {
            console.log(response);
        }        
    }).responseText;
    //console.log(jsonData);
    drawChart(jsonData);
}

function drawChart(jsonData) {
    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);
        
    var options = {
        title: 'Weight value according to their id',
        pieHole: 0.5,
        pieSliceTextStyle: {
            color: 'black',
        },
        legend: 'none'
    };
    var chart = new google.visualization.LineChart(document.getElementById("WeightChart"));
    chart.draw(data,options);
}  


  