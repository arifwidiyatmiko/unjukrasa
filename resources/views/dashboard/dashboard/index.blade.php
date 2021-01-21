@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1 Minggu terakhir
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">1 Minggu terakhir</a>
                    <a class="dropdown-item" href="#">1 Bulan  terakhir</a>
                    <a class="dropdown-item" href="#">3 Bulan  terakhir</a>
                    <a class="dropdown-item" href="#">Pilih Tanggal</a>
                </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Demonstrasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Total Aliansi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Pending Requests Card Example -->
        {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Demonstrasi</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('js')
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/utils.js')}}"></script>
<script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Dataset 1',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ]
        }]

    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                }
            }
        });

    };

    // document.getElementById('randomizeData').addEventListener('click', function() {
    //     var zero = Math.random() < 0.2 ? true : false;
    //     barChartData.datasets.forEach(function(dataset) {
    //         dataset.data = dataset.data.map(function() {
    //             return zero ? 0.0 : randomScalingFactor();
    //         });

    //     });
    //     window.myBar.update();
    // });

    // var colorNames = Object.keys(window.chartColors);
    // document.getElementById('addDataset').addEventListener('click', function() {
    //     var colorName = colorNames[barChartData.datasets.length % colorNames.length];
    //     var dsColor = window.chartColors[colorName];
    //     var newDataset = {
    //         label: 'Dataset ' + (barChartData.datasets.length + 1),
    //         backgroundColor: color(dsColor).alpha(0.5).rgbString(),
    //         borderColor: dsColor,
    //         borderWidth: 1,
    //         data: []
    //     };

    //     for (var index = 0; index < barChartData.labels.length; ++index) {
    //         newDataset.data.push(randomScalingFactor());
    //     }

    //     barChartData.datasets.push(newDataset);
    //     window.myBar.update();
    // });

    // document.getElementById('addData').addEventListener('click', function() {
    //     if (barChartData.datasets.length > 0) {
    //         var month = MONTHS[barChartData.labels.length % MONTHS.length];
    //         barChartData.labels.push(month);

    //         for (var index = 0; index < barChartData.datasets.length; ++index) {
    //             // window.myBar.addData(randomScalingFactor(), index);
    //             barChartData.datasets[index].data.push(randomScalingFactor());
    //         }

    //         window.myBar.update();
    //     }
    // });

    // document.getElementById('removeDataset').addEventListener('click', function() {
    //     barChartData.datasets.pop();
    //     window.myBar.update();
    // });

    // document.getElementById('removeData').addEventListener('click', function() {
    //     barChartData.labels.splice(-1, 1); // remove the label first

    //     barChartData.datasets.forEach(function(dataset) {
    //         dataset.data.pop();
    //     });

    //     window.myBar.update();
    // });
</script>
@endsection