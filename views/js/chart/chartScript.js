var weightDatas;
var chart_load = ""
  
//-----------------------------------------------
//
//  Chart load data script
//
//-----------------------------------------------

function getChartInfo(type_of_chart) {
    chart_load = type_of_chart;
    var action = "action=measure&MeasureType=" + type_of_chart;
    var jsonData = $.ajax({
        type: "POST",
        url: "../controller/index.php",
        data: action,
        dataType: "json",
        async: false      
    }).responseText;
    drawChart(jsonData);
}

function drawChart(jsonData) {
    var req = jsonData.split("/");
    var period = req[0].split("-");

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(req[1]);
    var options;
    var index_year = parseInt(period[1].split('_')[0]);
    var index_month = parseInt(period[1].split('_')[1]);
    var index_day = parseInt(period[1].split('_')[2]);
    var index_hour = parseInt(period[1].split('_')[3]);
    var month = getMonth(index_month);
    $(".btn_hour").hide();

    // Switch to edit chart option of each period view
    switch (period[0]) {
        case "Hour":
            $(".btn_hour").show();
            var date_hours = new Date().getHours(); // 0 to 23
            if(date_hours > 12) {
                // We are on afternoon
                date_hours -= 12;
                date_hours += " PM";
            }
            else {
                // We are on morning
                date_hours += " AM";
            }
            $(".btn_hour").find(".btn-primary").removeClass("btn-primary");
            $(".btn_hour").find(":contains('" + date_hours + "')").removeClass("btn-outline-secondary");
            $(".btn_hour").find(":contains('" + date_hours + "')").addClass("btn-primary");
            $(".btn_hour").find(":contains('" + date_hours + "')").removeAttr("disabled");
            $(".btn_hour").find(":contains('" + date_hours + "')").nextAll().attr("disabled", true);
            var options = {
                hAxis: {
                    title: "Day : " + index_day + " " + month + " " + index_year,
                    viewWindow: {
                        min: new Date(index_year, index_month, index_day, index_hour, 00),
                        max: new Date(index_year, index_month, index_day, index_hour, 60)
                    },
                    gridlines: {
                        count: -1,
                        units: {
                            days: {format: ['MMM dd']},
                            hours: {format: ['h:mm a']},
                        }
                    },
                },
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                //legend: 'none',
                bar: {groupWidth: "15%"},
            };
        break;            
        case "Day":
            var options = {
                hAxis: {
                    title: "Day : " + index_day + " " + month + " " + index_year,
                    viewWindow: {
                        min: new Date(index_year, index_month, index_day, 00),
                        max: new Date(index_year, index_month, index_day, 24)
                    },
                    gridlines: {
                        count: -1,
                        units: {
                            days: {format: ['MMM dd']},
                            hours: {format: ['h a']},
                        }
                    },
                },
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                //legend: 'none',
                bar: {groupWidth: "15%"},
            };
        break;
        case "Week":
            options = {
                hAxis: {
                    ticks: applyRangeChart(period)
                },
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                //legend: 'none',
                bar: {groupWidth: "25%"},
            };
        break;
        case "Month":
            options = {
                hAxis: {
                    ticks: applyRangeChart(period)
                },
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                //legend: 'none',
                bar: {groupWidth: "50%"},
            };
        break;
        case "Year":
            options = {
                hAxis: {
                    ticks: applyRangeChart(period)
                },
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                //legend: 'none',
                bar: {groupWidth: "100%"},
            };
        break;
    }
    // CHANGE THIS IF YOU WANT ANOTHER TYPE OF CHART
    var chart = new google.visualization.LineChart(document.getElementById("Chart"));
    
    // Draw the chart
    chart.draw(data,options);
}  

function applyRangeChart(period) {
    var column_date = new Array();
    switch(period[0]) {
        case "Year":
            // Column in "month" view
            var index_year = parseInt(period[1].split('_')[0]);
            var index_month = parseInt(period[1].split('_')[1]);
            for(i=0; i <= 12; i++){
                column_date.push(new Date(index_year, index_month));
                index_month++;
            }
        break;
        case "Month":
            // Column in "day" view
            var index_year = parseInt(period[1].split('_')[0]);
            var index_month = parseInt(period[1].split('_')[1]);
            var index_day = parseInt(period[1].split('_')[2]);
            for(i=0; i <= 30; i++){
                column_date.push(new Date(index_year, index_month, index_day))
                index_day++;
            }
            break;
        case "Week":
            // Column in "day" view
            var index_year = parseInt(period[1].split('_')[0]);
            var index_month = parseInt(period[1].split('_')[1]);
            var index_day = parseInt(period[1].split('_')[2]);
            for(i=0; i <= 7; i++){
                column_date.push(new Date(index_year, index_month, index_day))
                index_day++;
            }
            break;
        case "Day":
            // Column in "hour" view
            var index_year = parseInt(period[1].split('_')[0]);
            var index_month = parseInt(period[1].split('_')[1]);
            var index_day = parseInt(period[1].split('_')[2]);
            var index_hour = parseInt(period[1].split('_')[3]);
            for(i=0; i <= 24; i++){
                column_date.push(new Date(index_year, index_month, index_day, index_hour))
                index_hour++;
            }
            break;
        case "Hour":
            // Column in "minute" view
            var index_year = parseInt(period[1].split('_')[0]);
            var index_month = parseInt(period[1].split('_')[1]);
            var index_day = parseInt(period[1].split('_')[2]);
            var index_hour = parseInt(period[1].split('_')[3]);
            var index_minute = parseInt(period[1].split('_')[4]);
            for(i=0; i <= 60; i++){
                column_date.push(new Date(index_year, index_month, index_day, index_hour, index_minute))
                index_minute++;
            }
            break;
    }
    return column_date;
}

function changeHourView(selected_hours) {
    var hour_of_day = selected_hours.split(" ");
    var hour = parseInt(hour_of_day[0]);
    if(hour_of_day[1] === "PM") {
        // If we are on afternoon
        hour += 12;
    }
    var action = "action=changeHour&Hour=" + hour;
    var jsonData = $.ajax({
        type: "POST",
        url: "../controller/index.php",
        data: action,
        dataType: "json",
        async: false      
    }).responseText;
    drawChart(jsonData);
}

//-----------------------------------------------
//
//  Filter script
//
//-----------------------------------------------

function getFilters() {
    var action = "action=getFilter";
    $.ajax({
        type: "POST",
        url: "../controller/index.php",
        data: action,
        dataType: "json",
        async: false,
        success: function (response) {
            $("#location_dropdown").empty();
            $("#user_dropdown").empty();
            $.each(response, function(key,value){
                var keyFilter = key;
                $.each(value, function(key,value){
                    if(keyFilter === 0) {
                        $("#location_dropdown").append("<a class='dropdown-item' onclick=\"locationFilter(\'"+value.name_hive+"\')\" href='#'>"+value.name_hive+"</a>");
                    }
                    else if(keyFilter === 1) {
                        $("#user_dropdown").append("<a class='dropdown-item' onclick=\"userFilter(\'"+value.username+"\')\" href='#'>"+value.username+"</a>");
                    }
                });
            });
        }        
    }).responseText;
}

function filterPeriod(filter_period) {
    var action = "action=filterPeriod&period=" + filter_period;
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
}

function locationFilter(hive_name) {
    var action = "action=filterLocation&hive_name=" + hive_name;
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
};

function userFilter(username) {
/*     var action = "action=filterUser&username=" + username;
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
    drawChart(jsonData);  */
};

function dateFilter(min_date,max_date,filter_date_mode) {
    var action = "action=filterDate&min_date=" + min_date + "&max_date=" + max_date + "&filter_date_mode" + filter_date_mode;
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
};

function applyDateFilter() {
    var filter_date_mode = 0;
    var current_date = changeDateFormat(new Date());
    var min_date = changeDateFormat($('#datetimepicker1').datetimepicker('viewDate'));
    var max_date = changeDateFormat($('#datetimepicker2').datetimepicker('viewDate'));
    if (min_date == max_date) {
        // no interval
        console.log("any date");
        filter_date_mode = 1;
    }
    else if (min_date == current_date) {
        // min date not fill
        console.log("min date");
        filter_date_mode = 2;
    }
    else if (max_date == current_date) {
        // max date not fill
        console.log("max date");
        filter_date_mode = 3;
    }
    dateFilter(min_date,max_date,filter_date_mode);
    $('#getDate').text(min_date);
}

function resetFilter() {
    $(".hive_name").each(function() {
        $(this).removeClass("active");
        $(this).css("color","rgba(255,255,255,.5)");
    });
    
    var action = "action=resetFilter";
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
}

//-----------------------------------------------
//
//  Load chart script
//
//-----------------------------------------------

function loadChartScript() {
    // Set the interval to refresh automatically chart
    setInterval(function(){ 
        getChartInfo(chart_load); 
    }, 3000);

    // Get the filter list for chart filtering
    getFilters();

    // Side menu animation (With the "+" icon)
    $('.nav-link-collapse').on('click', function() {
        $('.nav-link-collapse').not(this).removeClass('nav-link-show');
        $(this).toggleClass('nav-link-show');
    });

    // Period filter
    $('.PeriodFilter :button').on('click', function(e) {
        $('.PeriodFilter').find(".active").toggleClass("active");
        $(this).toggleClass("active");
        filterPeriod(e.target.innerHTML);
    });    

    // Reset button
    $('.reset_btn').on('click', function(e) {
        resetFilter();
    });

    $('.btn_hour :button').on('click', function(e) {
        $('.btn_hour').find(".active").toggleClass("active");
        $(this).toggleClass("active");
        changeHourView(e.target.innerHTML);
    });

    // Is click outside date popup
    $(document).mouseup(function(e){
        var container = $(".btn-group-date");
        // If the target of the click isn't the container
        if(!container.is(e.target) && container.has(e.target).length === 0){
            $('.date_dropdown_menu').hide();
        }
    });

    // Show date menu
    $('#btnGroupDrop2').on('click', function(event){
        $('.date_dropdown_menu').show();
    });

    // Save and apply date filtering
    $('.btn_save_date_filter').on('click', function(){
        applyDateFilter();
    });

    // Configuration of date filtering
    $(function () {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker({
            useCurrent: false
        });
        $("#datetimepicker1").on("change.datetimepicker", function (e) {
            $('#datetimepicker2').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker2").on("change.datetimepicker", function (e) {
            $('#datetimepicker1').datetimepicker('maxDate', e.date);
        });
    });
}

//-----------------------------------------------
//
//  Utility
//
//-----------------------------------------------

function changeDateFormat(date) {
    var d = new Date(date);
    var curr_date = d.getDate();
    var curr_month = d.getMonth() + 1;
    if (curr_month < 10)
    {
        curr_month = "0" + curr_month;
    }
    var curr_year = d.getFullYear();
    var new_date = curr_year + "-" + curr_month + "-" + curr_date;
    return new_date;
};

function getMonth(month_number) {
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";
    return month[month_number];
}