google.load("visualization", "1", {packages:["corechart"]});
//google.setOnLoadCallback(getChartInfo("weight"));

$(document).ready(function() {
    getChart("weight");

    $('.warning_tab').on('click', function(event){
        var action = "action=warning";
        var jsonData = $.ajax({
            type: "POST",
            url: "../controller/index.php",
            data: action,
            dataType: "json",
            async: false 
        }).responseText;
        $('.content-wrapper').replaceWith(jsonData);
    });

    $('.weight_chart').on('click', function(){
        resetHive();
        getChart("weight");
    });

    $('.temperature_chart').on('click', function(){
        resetHive();
        getChart("temperature");
    });

    $('.humidity_chart').on('click', function(){
        resetHive();
        getChart("humidity");
    });

    function resetHive() {
        $(".hive_name").each(function() {
            $(this).removeClass("active");
            $(this).css("color","rgba(255,255,255,.5)");
        });
    }

    $('#searchbar_hive').keypress(function(event) {
        var value_input = event.target.value;
        if(value_input != "") {
            $(".hive_name").parent().parent().hide();
            $(".hive_name:contains(" + value_input + ")").parent().parent().show();
        }
        else {
            $(".hive_name").parent().parent().show(); 
        }
    });

    $('.hive_name').on('click', function(event) {
        var hive_name = event.target.innerHTML;
        var hive_list = "";
        var hive_counter = 0;

        // Put style on css element
        $(".hive_name:contains(" + hive_name + ")").css("color","red");

        // If the element is already selected
        if($(this).hasClass("active")) {
            $(".hive_name:contains(" + hive_name + ")").css("color","rgba(255,255,255,.5)");
        }

        // Toggle class 'active'
        $(this).toggleClass("active");

        // Iterate all list to find active hive selection
        $(".hive_name").each(function() {
            if($(this).hasClass("active")) {
                hive_list += $(this).text() + ",";
                hive_counter++;
            }
        });

        // Delete last character
        hive_list = hive_list.substring(0, hive_list.length - 1);

        // If you select any hive, reset default view ( without location )
        if(hive_counter == 0) {
            hive_list = "default";
        }

        // Get selected hive data
        var action = "action=filterLocation&hive_name=" + hive_list;
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
        drawChart(jsonData);
    });
});

function getChart(type_of_chart) {
    $('.content-wrapper').load('../controller/index.php',
    { action: 'chart', chart:type_of_chart },
    function(data, status, jqXGR) {  
        loadChartScript();
        getChartInfo(type_of_chart);
    });
    
}

