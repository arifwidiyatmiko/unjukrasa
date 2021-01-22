@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard <span class="text-xs">({{$agoDate->format('d M Y').' - '.$currentDate->format('d M Y') }})</span></h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        {{-- <p class="h4 mb-0 text-gray">asda</p> --}}
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
        <div class="col-xs-12 col-lg-6 row">
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-12 col-sm-6 mt-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Demonstrasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demonstration->count()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-12 col-sm-6 mt-1">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                     Total Aliansi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$alience->count()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-xs-12 col-sm-12 mt-1 ">
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
        <div class="col-xs-12 col-lg-6 row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-12 col-sm-6 mt-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lokasi Tersering</h6>
                    </div>
                    <div class="card-body">
                        The styling for this basic card example is created by using default Bootstrap
                        utility classes. By using utility classes, the style of the card component can be
                        easily modified with no need for any custom CSS!
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xs-12 col-sm-6 mt-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aliansi Tersering</h6>
                    </div>
                    <div class="card-body">
                        The styling for this basic card example is created by using default Bootstrap
                        utility classes. By using utility classes, the style of the card component can be
                        easily modified with no need for any custom CSS!
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

</script>
@endsection