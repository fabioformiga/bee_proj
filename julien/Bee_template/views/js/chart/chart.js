function FilterChart(type_filter, value_filter) {
    var hive_selected = "";
    var first_value = 1;
    var queryType;
    var action = "";
 
    // check if some hive are selected
    $('input[type=checkbox]').each(function(){
       if($(this).is(":checked")){
          if (first_value == 1) {
             hive_selected += $(this).attr('id');
             first_value = 0;
          } else {
             hive_selected += ','+$(this).attr('id');
          }
       }
    })
 
    // check the type of filter selected
    if (hive_selected != "") {
       queryType = "hive";
    } else if($("#dropdown_local_container").children().attr('id') == "local") {
       queryType = "date";
    } else {
       queryType = "local";
    }
    
    // prepare action for send to controller
    switch(type_filter) {
       case "date":
          var action = "type=" + queryType + "&date=" + value_filter + "&local=" + $("#dropdown_local_container").children().attr('id') + "&hive=" + hive_selected + "&action=filter";
          $("#dropdown_date_title").text(value_filter);
          break;
       case "local":
          $("#dropdown_local_container").children().attr('id',value_filter);
          var action = "type=local&date=" + $("#dropdown_date_title").text() + "&local=" + value_filter + "&hive=" + hive_selected + "&action=filter";
          HiveCheckbox(value_filter);
          break;
       case "hive":
          var action = "type=hive&date=" + $("#dropdown_date_title").text() + "&local=" + $("#dropdown_local_container").children().attr('id') + "&hive=" + hive_selected + "&action=filter";
          break;
    }
 
    // send action to controller
    $.ajax({
       type: "POST",
       url: "../controller/Controller.php",
       data: action,
       datatype: "text/html",
       success: function (response) {
          // load chart with data
          LoadChart(response);
     }
 });  
 }
 
 function LoadChart(datas) {
    // create different google chart with database datas
    var datasJSON = JSON.parse(datas);
    var indexLocal = [];
    var countLocal = 0;
    var firstValue = 1;
    var date;
    var arr = [];
    var localMap = new Map();
    var value_measure_name;
 
    var data = new google.visualization.DataTable();
 
    data.addColumn('string', 'Values');
 
     $.each( datasJSON, function( key, value ) {
       if(firstValue === 1) {
          date = value.date_measure;
          firstValue = 0;
          value_measure_name = Object.getOwnPropertyNames(value);
       }
       
       if(date != value.date_measure) {
          var row = [];
          row.push(date);
          $.each( arr, function( key, value ) {
             row.push(value);
          });
          data.addRow(row);
          arr = [indexLocal];
       }
       if(!indexLocal.includes(value.id_location)) {
          // we count all different local
          localMap.set(value.id_location, countLocal);
          countLocal++;
          indexLocal.push(value.id_location);
          data.addColumn('number', value.name_location);
       }
       arr[localMap.get(value.id_location)] = parseInt(value[value_measure_name[1]]);
       date = value.date_measure;
    }); 
 
    var options= {
       title: "Weight of hives",
    }
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
 }
 
 function HiveCheckbox(local) {
    // load hive checkbox values
    var action = "local=" + local + "&action=checkbox_hive";
    $.ajax({
       type: "POST",
       url: "../controller/Controller.php",
       data: action,
       datatype: "text/html",
       success: function (response) {
          $("#dropdown_hive_container").show();
          var checkbox_items = $.parseJSON(response);
          $("#dropdown_hive").empty();
          $.each( checkbox_items, function( key, value ) {
             $("#dropdown_hive").append($( "<label id=label_hive class=dropdown-item checkbox><input type=checkbox id=\'" + value["reference_hive"] + "\' onclick=FilterChart(\'hive\',\'" + value["reference_hive"] + "\')> hive " +  value["reference_hive"] + "</label>"));
           });
       }
    }); 
 }
 
 $("#chart_container").ready(function(){
    // hide hive container
    $("#dropdown_hive_container").hide();
 
    // load local dropdown values
    var action = "action=dropdown_local"
    $.ajax({
       type: "POST",
       url: "../controller/Controller.php",
       data: action,
       datatype: "text/html",
       success: function (response) {
          var dropdown_items = $.parseJSON(response);
          $.each( dropdown_items, function( key, value ) {
             $("#dropdown_local").append($("<button class=dropdown-item id=\'" + value["Id_location"] + "\' type=button onclick=\"FilterChart(\'local\',\'" + value["Id_location"] + "\')\">" + value["name_location"] + "</button>"));
           });
       }
    });  
 
    // load filter with default values
    var action = "type=date&date=" + $("#dropdown_date_title").text() + "&local=local&hive=hive&action=filter";
    $.ajax({
       type: "POST",
       url: "../controller/Controller.php",
       data: action,
       datatype: "text/html",
       success: function (response) {
          // load the Visualization API and the chart package
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(function(){LoadChart(response)});
       }
    });  
 })