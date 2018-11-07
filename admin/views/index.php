<?php
$controlador = "Index";
$accion = "index";
$titulo = "inicio";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            <header class="main-header">
                <?php
                include 'include/header.php';
                ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <?php
                include 'include/sidebar.php';
                ?>
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Inicio
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->

                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Cotizaciones</a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Reporte</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>                                    
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->

                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Comentarios</a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Reporte</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="comentario-chart" style="position: relative; height: 300px;"></div>                                    
                                </div>
                            </div>
                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.3
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php
        include 'include/footer.php';
        ?>
        <script src="plugins/morris/morris.min.js"></script>
        <script>
            /*
             * Author: Abdullah A Almsaeed
             * Date: 4 Jan 2014
             * Description:
             *      This is a demo file used only for the main dashboard (index.html)
             **/

            $(function () {

                "use strict";

                //Make the dashboard widgets sortable Using jquery UI
                $(".connectedSortable").sortable({
                    placeholder: "sort-highlight",
                    connectWith: ".connectedSortable",
                    handle: ".box-header, .nav-tabs",
                    forcePlaceholderSize: true,
                    zIndex: 999999
                });
                $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

                //jQuery UI sortable for the todo list
                $(".todo-list").sortable({
                    placeholder: "sort-highlight",
                    handle: ".handle",
                    forcePlaceholderSize: true,
                    zIndex: 999999
                });

                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();

                $('.daterange').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                }, function (start, end) {
                    window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                });

                /* jQueryKnob */
                $(".knob").knob();

                //jvectormap data
                var visitorsData = {
                    "US": 398, //USA
                    "SA": 400, //Saudi Arabia
                    "CA": 1000, //Canada
                    "DE": 500, //Germany
                    "FR": 760, //France
                    "CN": 300, //China
                    "AU": 700, //Australia
                    "BR": 600, //Brazil
                    "IN": 800, //India
                    "GB": 320, //Great Britain
                    "RU": 3000 //Russia
                };
                //World map by jvectormap
                $('#world-map').vectorMap({
                    map: 'world_mill_en',
                    backgroundColor: "transparent",
                    regionStyle: {
                        initial: {
                            fill: '#e4e4e4',
                            "fill-opacity": 1,
                            stroke: 'none',
                            "stroke-width": 0,
                            "stroke-opacity": 1
                        }
                    },
                    series: {
                        regions: [{
                                values: visitorsData,
                                scale: ["#92c1dc", "#ebf4f9"],
                                normalizeFunction: 'polynomial'
                            }]
                    },
                    onRegionLabelShow: function (e, el, code) {
                        if (typeof visitorsData[code] != "undefined")
                            el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
                    }
                });

                //Sparkline charts
                var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
                $('#sparkline-1').sparkline(myvalues, {
                    type: 'line',
                    lineColor: '#92c1dc',
                    fillColor: "#ebf4f9",
                    height: '50',
                    width: '80'
                });
                myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
                $('#sparkline-2').sparkline(myvalues, {
                    type: 'line',
                    lineColor: '#92c1dc',
                    fillColor: "#ebf4f9",
                    height: '50',
                    width: '80'
                });
                myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
                $('#sparkline-3').sparkline(myvalues, {
                    type: 'line',
                    lineColor: '#92c1dc',
                    fillColor: "#ebf4f9",
                    height: '50',
                    width: '80'
                });

                //The Calender
                $("#calendar").datepicker();

                //SLIMSCROLL FOR CHAT WIDGET
                $('#chat-box').slimScroll({
                    height: '250px'
                });

                /* Morris.js Charts */
                // Sales chart
                var area = new Morris.Bar({
                    element: 'revenue-chart',
                    data: [
                      <?php
                      echo $vars["carritos"];
                      ?>                      
                    ],
                    xkey: 'device',
                    ykeys: ['geekbench'],
                    labels: ['total'],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    hideHover: 'auto'
                  });
                var area2 = new Morris.Bar({
                    element: 'comentario-chart',
                    data: [
                      <?php                      
                      echo $vars["cotizaciones"];
                      ?>                      
                    ],
                    xkey: 'device',
                    ykeys: ['geekbench'],
                    labels: ['total'],
                    barRatio: 0.4,
                    xLabelAngle: 35,
                    hideHover: 'auto'
                  });
                var line = new Morris.Line({
                    element: 'line-chart',
                    resize: true,
                    data: [
                        {y: '2011 Q1', item1: 2666},
                        {y: '2011 Q2', item1: 2778},
                        {y: '2011 Q3', item1: 4912},
                        {y: '2011 Q4', item1: 3767},
                        {y: '2012 Q1', item1: 6810},
                        {y: '2012 Q2', item1: 5670},
                        {y: '2012 Q3', item1: 4820},
                        {y: '2012 Q4', item1: 15073},
                        {y: '2013 Q1', item1: 10687},
                        {y: '2013 Q2', item1: 8432}
                    ],
                    xkey: 'y',
                    ykeys: ['item1'],
                    labels: ['Item 1'],
                    lineColors: ['#efefef'],
                    lineWidth: 2,
                    hideHover: 'auto',
                    gridTextColor: "#fff",
                    gridStrokeWidth: 0.4,
                    pointSize: 4,
                    pointStrokeColors: ["#efefef"],
                    gridLineColor: "#efefef",
                    gridTextFamily: "Open Sans",
                    gridTextSize: 10
                });

                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a"],
                    data: [
                        {label: "Download Sales", value: 12},
                        {label: "In-Store Sales", value: 30},
                        {label: "Mail-Order Sales", value: 20}
                    ],
                    hideHover: 'auto'
                });

                //Fix for charts under tabs
                $('.box ul.nav a').on('shown.bs.tab', function () {
                    area.redraw();
                    area2.redraw();
                    donut.redraw();
                    line.redraw();
                });

                /* The todo list plugin */
                $(".todo-list").todolist({
                    onCheck: function (ele) {
                        window.console.log("The element has been checked");
                        return ele;
                    },
                    onUncheck: function (ele) {
                        window.console.log("The element has been unchecked");
                        return ele;
                    }
                });

            });

        </script>

    </body>
</html>