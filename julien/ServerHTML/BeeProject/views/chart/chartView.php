<div class="container-fluid chart_view">
    <div class="row">
        <div class="col">
            <?php 
                switch($Chart_type) {
                    case "weight":
                        echo "<h1>Weight chart</h1>";
                    break;
                    case "temperature":
                        echo "<h1>Temperature chart</h1>";
                    break;
                    case "humidity":
                        echo "<h1>Humidity chart</h1>";
                    break;
                }
            ?>
        </div>
        <div class="col">
            <div class="mt-2" style="display: table-cell;float: left;vertical-align: middle;padding: 5px;">Period :</div>
            <div class="btn-group mt-2 PeriodFilter" role="group" aria-label="Period filter">
                <button type="button" class="btn btn-outline-secondary">Hour</button>
                <button type="button" class="btn btn-outline-secondary">Day</button>
                <button type="button" class="btn btn-outline-secondary">Week</button>
                <button type="button" class="btn btn-outline-secondary">Month</button>
                <button type="button" class="btn btn-outline-secondary active">Year</button>
            </div>
        </div>
        <div class="col">
<!--             <div class="btn-group mt-2" role="group" aria-label="Button group with nested dropdown" style="display:block;text-align:right;">
                <div class="btn-group"  role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Location filter
                    </button>
                <div class="dropdown-menu" id="location_dropdown" aria-labelledby="btnGroupDrop1"></div>
            </div> -->
            <div class="btn-group btn-group-date"  role="group">
                <button id="btnGroupDrop2" type="button" class="btn btn-secondary dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                    Date filter
                </button>
                <div class="dropdown-menu date_dropdown_menu" style="width:300px;height:200px;left:unset;right:0px;">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn_save_date_filter">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>
                <div class="btn-group"  role="group">
                    <button id="btnGroupDrop3" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User filter
                    </button>
                    <div class="dropdown-menu" id="user_dropdown" aria-labelledby="btnGroupDrop3"></div>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-secondary reset_btn" aria-haspopup="true" aria-expanded="false">
                        Reset filter
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="Chart" style="width: 100%; height: 500px;"></div>
    <div class="d-flex justify-content-center btn_group_hour">
        <div class="btn-group mt-2 btn_hour" role="group" aria-label="Hour filter">
            <button type="button" class="btn btn-outline-secondary">1 AM</button>
            <button type="button" class="btn btn-outline-secondary">2 AM</button>
            <button type="button" class="btn btn-outline-secondary">3 AM</button>
            <button type="button" class="btn btn-outline-secondary">4 AM</button>
            <button type="button" class="btn btn-outline-secondary">6 AM</button>
            <button type="button" class="btn btn-outline-secondary">7 AM</button>
            <button type="button" class="btn btn-outline-secondary">8 AM</button>
            <button type="button" class="btn btn-outline-secondary">9 AM</button>
            <button type="button" class="btn btn-outline-secondary">10 AM</button>
            <button type="button" class="btn btn-outline-secondary">11 AM</button>
            <button type="button" class="btn btn-outline-secondary">12 AM</button>
            <button type="button" class="btn btn-outline-secondary">1 PM</button>
            <button type="button" class="btn btn-outline-secondary">2 PM</button>
            <button type="button" class="btn btn-outline-secondary">3 PM</button>
            <button type="button" class="btn btn-outline-secondary">4 PM</button>
            <button type="button" class="btn btn-outline-secondary">6 PM</button>
            <button type="button" class="btn btn-outline-secondary">7 PM</button>
            <button type="button" class="btn btn-outline-secondary">8 PM</button>
            <button type="button" class="btn btn-outline-secondary">9 PM</button>
            <button type="button" class="btn btn-outline-secondary">10 PM</button>
            <button type="button" class="btn btn-outline-secondary">11 PM</button>
            <button type="button" class="btn btn-outline-secondary">12 PM</button>
        </div>
    </div>
<!--     <p>
        Date is : <span id="getDate"></span>
    </p> -->
</div>

