@extends('layouts.app')
@section('content')
<section class="container">
        <div class="row">

            <div class="col-md-3">
                <div id="sidebar-container" class="sidebar-expanded d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                    <!-- Bootstrap List Group -->
                    <ul class="list-group">
                        <!-- Menu with submenu -->
                        <a class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="text-center">
                            <img src="https://www.netfort.com/assets/user-300x300.png" style="width:100px">
                        </div>
                        </a>
                        <a class="list-group-item list-group-item-action flex-column align-items-start text-center">
                            <b>{{ Auth::user()->name }}</b>
                        </a>
                       
                        <a href="#" data-menu="email-sent-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-bullseye fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Email Sent</span>
                            </div>
                        </a>
                         <a href="#" data-menu="revenue-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-microchip fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Revenue Graphs</span>
                            </div>
                        </a>
                        <a href="#" data-menu="customer-converation-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-ravelry fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Customer Converation</span>
                            </div>
                      </a>

                         <a href="#" data-menu="popular-origin-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-snowflake-o fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Popular Origin</span>
                            </div>
                         </a>



                        <a href="#" data-menu="popular-destination-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-podcast fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Popular Destinations</span>
                            </div>
                        </a> 

                        <a href="#" data-menu="avg-cost-pound-box" class="list-group-item list-group-item-action flex-column align-items-start menu_btn">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                 <span class="fa fa-bar-chart fa-fw mr-3"></span> 
                                <span class="menu-collapsed">Avg Cost/Pound</span>
                            </div>
                        </a>
                       
                    </ul><!-- List Group END-->
                </div>
            </div>
            <div class="col-md-9">
                <div class="box-info chart-box email-sent-box">
                    <b> <i class="fa fa-bullseye"></i> Email Sent</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" class="filter-clck nav-link small active" data-chart="1" data-target="#chart1" data-toggle="tab" data-day="7">Last 7 days</a></li>
                        <li class="nav-item"><a href="" class="filter-clck nav-link small" data-chart="1"  data-target="#chart1" data-toggle="tab" data-day="15">Last 15 days</a></li>
                        <li class="nav-item"><a href="" class="filter-clck nav-link small" data-chart="1" data-target="#chart1" data-toggle="tab" data-day="30">Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart1" class="tab-pane fade active show">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>


                <div class="box-info chart-box revenue-box" style="display:none;">
                    <b> <i class="fa fa-microchip"></i> Revenue Graphs</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#chart2" data-toggle="tab" class="filter-clck nav-link small active" data-chart="2" data-day="7">Last 7 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart2" data-toggle="tab" class="filter-clck nav-link small" data-chart="2" data-day="15">Last 15 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart2" data-toggle="tab" class="filter-clck nav-link small" data-chart="2" data-day="30">Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart2" class="tab-pane fade active show">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>


                 <div class="box-info chart-box customer-converation-box" style="display:none;">
                    <b> <i class="fa fa-ravelry"></i> Customer Converation</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#chart3" data-toggle="tab" class="filter-clck nav-link small active" data-chart="3" data-day="7" >Last 7 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart3" data-toggle="tab" class="filter-clck nav-link small" data-chart="3" data-day="15" >Last 15 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart3" data-toggle="tab" class="filter-clck nav-link small" data-chart="3" data-day="30" >Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart3" class="tab-pane fade active show">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>

                 <div class="box-info chart-box popular-origin-box" style="display:none;">
                    <b> <i class="fa fa-snowflake-o"></i> Most Popular Origin</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#chart4" data-toggle="tab" class="filter-clck nav-link small active" data-chart="4" data-day="7" >Last 7 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart4" data-toggle="tab" class="filter-clck nav-link small" data-chart="4" data-day="15" >Last 15 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart4" data-toggle="tab" class="filter-clck nav-link small" data-chart="4" data-day="30" >Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart4" class="tab-pane fade active show">
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div>

                 <div class="box-info chart-box popular-destination-box" style="display:none;">
                    <b> <i class="fa fa-podcast"></i> Most Popular Destinations</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#chart5" data-toggle="tab" class="filter-clck nav-link small active" data-chart="5" data-day="7" >Last 7 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart5" data-toggle="tab" class="filter-clck nav-link small" data-chart="5" data-day="15" >Last 15 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart5" data-toggle="tab" class="filter-clck nav-link small" data-chart="5" data-day="30" >Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart5" class="tab-pane fade active show">
                            <canvas id="myChart5"></canvas>
                        </div>
                    </div>
                </div>


                 <div class="box-info chart-box avg-cost-pound-box" style="display:none;">
                    <b> <i class="fa fa-bar-chart"></i> Avg Cost/Pound</b>
                    <hr>
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#chart6" data-toggle="tab" class="filter-clck nav-link small active" data-chart="6" data-day="7" >Last 7 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart6" data-toggle="tab" class="filter-clck nav-link small" data-chart="6" data-day="15" >Last 15 days</a></li>
                        <li class="nav-item"><a href="" data-target="#chart6" data-toggle="tab" class="filter-clck nav-link small" data-chart="6" data-day="30" >Last 30 days</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="chart6" class="tab-pane fade active show">
                            <canvas id="myChart6"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">
    $(function(){

        getChart1(7);
        getChart2(7);
        getChart3(7);
        getChart4(7);
        getChart5(7);
        getChart6(7);

        $('body').on('click', '.filter-clck', function(e){
            e.preventDefault();
            var days = $(this).data('day');
            var chart_v = $(this).data('chart');
            //$('.chartjs-size-monitor').remove();
            if(chart_v == 1){
                getChart1(days);
            } else if (chart_v == 2){
                getChart2(days);
            } else if (chart_v == 3){
                getChart3(days);
            } else if (chart_v == 4){
                getChart4(days);
            } else if (chart_v == 5){
                getChart5(days);
            } else if (chart_v == 6){
                getChart6(days);
            }
        });

        $('body').on('click', '.menu_btn', function(e){
            e.preventDefault();
            var menu = $(this).data('menu');
            $('.chart-box').hide();
            $('.' + menu).show();
        })


        function getChart1(days){
            $.ajax({
               url : '{{ url("ajax_email_sent") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart1').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart1 && typeof window.chart1.destroy === 'function') {
                        window.chart1.destroy();
                    }
                    
                    window.chart1 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Email Sent Graphs',
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }


        function getChart2(days){
            $.ajax({
               url : '{{ url("ajax_revenue_graphs") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart2 && typeof window.chart2.destroy === 'function') {
                        window.chart2.destroy();
                    }
                    
                    window.chart2 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Revenue Graphs',
                                backgroundColor: 'rgb(54, 162, 235)',
                                borderColor: 'rgb(54, 162, 235)',
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }




        function getChart3(days){
            $.ajax({
               url : '{{ url("ajax_customer_conversation") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart3 && typeof window.chart3.destroy === 'function') {
                        window.chart3.destroy();
                    }
                    
                    window.chart3 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'All Quotes',
                                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                                borderColor: 'rgb(54, 162, 235)',
                                fill : false,
                                data: data.result1
                            },
                            {
                                label: 'Approved Quotes',
                                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                                borderColor: 'rgb(255, 99, 132)',
                                fill : false,
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }


        function getChart4(days){
            $.ajax({
               url : '{{ url("ajax_popular_origin") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart4 && typeof window.chart4.destroy === 'function') {
                        window.chart4.destroy();
                    }
                    
                    window.chart4 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Popular Origin Graphs',
                                backgroundColor: 'rgb(75, 192, 192)',
                                borderColor: 'rgb(75, 192, 192)',
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }


        function getChart5(days){
            $.ajax({
               url : '{{ url("ajax_popular_destination") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart5').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart5 && typeof window.chart5.destroy === 'function') {
                        window.chart5.destroy();
                    }
                    
                    window.chart5 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Popular Destinations Graphs',
                                backgroundColor: 'rgb(153, 102, 255)',
                                borderColor: 'rgb(153, 102, 255)',
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }


        function getChart6(days){
            $.ajax({
               url : '{{ url("ajax_avg_cost_per_pound") }}',
               type : 'POST',
               data : {
                    days : days,
                    _token : '{{ csrf_token() }}'
                },
                success : function(data) {
                    var data = JSON.parse(data);
                    var ctx = document.getElementById('myChart6').getContext('2d');
                    
                    // Destroy existing chart if it exists
                    if (window.chart6 && typeof window.chart6.destroy === 'function') {
                        window.chart6.destroy();
                    }
                    
                    window.chart6 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Average Cost Per Pound',
                                backgroundColor: 'rgba(255, 206, 86, 0.1)',
                                borderColor: 'rgb(255, 206, 86)',
                                fill: false,
                                data: data.result
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        }






    })
    
  </script>
@endsection
@section('customcss')
<style type="text/css">
    .box-info{
        background: white;
        padding: 20px;
    }

    .nav-tabs .nav-item{
        margin-bottom:0px;
        background: white !important;
    }
    .nav-tabs .nav-item a.active{
        background: unset;
        border-bottom: 2px solid #6f7071;
       border-top: unset;
        border-left: unset;
        border-right: unset;
    }
    .nav-tabs .nav-item a:hover{
        border-top: unset;
        border-left: unset;
        border-right: unset;
        border-bottom: 2px solid #6f7071;
    }
</style>
@endsection

