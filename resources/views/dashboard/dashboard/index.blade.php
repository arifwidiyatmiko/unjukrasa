@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard <span class="text-xs">({{$ago->format('d M Y').' - '.$currentDate->format('d M Y') }})</span></h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        {{-- <p class="h4 mb-0 text-gray">asda</p> --}}
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$currentChoice}}
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{URL::to('dashboard?t=week')}}">1 Minggu terakhir</a>
            <a class="dropdown-item" href="{{URL::to('dashboard?t=month')}}">1 Bulan  terakhir</a>
            <a class="dropdown-item" href="{{URL::to('dashboard?t=3month')}}">3 Bulan  terakhir</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalDatepicker">Pilih Tanggal</a>
        </div>
    </div>

    <!-- Content Row -->
    
    <div class="row">
        <div class="col-xs-12 col-lg-12 row">
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-3 col-xs-12 col-md-6 mt-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Demonstrasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demonstration->count()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-3 col-xs-12 col-md-6 mt-1">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                     Jumlah Aliansi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$alience->count()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-3 col-xs-12 col-md-6 mt-1">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                     Jumlah Lokasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$location->count()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-3 col-xs-12 col-md-6 mt-1">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Jumlah Masa Terbanyak</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$max_massa}} Orang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 mt-2 ">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#tab2" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Demonstrasi Astra berdasarlam Status</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="tab2">
                        <div class="card-body">
                            <canvas id="chart-area1"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 mt-2 ">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#tab4" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Aliansi Pendemo Astra</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="tab4">
                        <div class="card-body">
                            <canvas id="chart-area2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 mt-2 ">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#tab3" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Diagram Demonstrasi</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="tab3">
                        <div class="card-body">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
        <div class="row"></div>
        <div class="col-12 row">
            <div class="col-xs-12 col-lg-12 ">
                <div class="row">
                    <div class="col-12 mt-1">
                        <div class="card shadow mb-4">
                            <a href="#tabelDemo1" class="d-block card-header py-3" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="tabelDemo1">
                                <h6 class="m-0 font-weight-bold text-primary">Tabel Demonstrasi</h6>
                            </a>
                            <div class="collapse" id="tabelDemo1">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_demo">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Lokasi</th>
                                                <th>Aliansi</th>
                                                <th>Jumlah Orang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (empty($demonstration))
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak Ada data</td>
                                                </tr>
                                            @else
                                                @foreach ($demonstration as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$value->date}}</td>
                                                    <td>{{$value->location->building_name}}</td>
                                                    <td>{{$value->alliencePic->allience->allience_name}}</td>
                                                    <td>{{$value->mass_amount}}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mt-1">
                        <div class="card shadow mb-4">
                            <a href="#tabelDemo2" class="d-block card-header py-3" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="tabelDemo2">
                                <h6 class="m-0 font-weight-bold text-primary">Tabel Demonstrasi Astra</h6>
                            </a>
                            <div class="collapse" id="tabelDemo2">
                                <div class="card-body">
                                    <table class="table table-hover" id="table_demo1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Lokasi</th>
                                                <th>Aliansi</th>
                                                <th>Terlaksana</th>
                                                <th>Jumlah Orang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (empty($demo_astra))
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak Ada data</td>
                                                </tr>
                                            @else
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($demo_astra as $key => $value)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>{{date('d M Y',strtotime($value->date))}}</td>
                                                    <td>{{$value->location->building_name}}</td>
                                                    <td>{{$value->alliencePic->allience->allience_name}}</td>
                                                    <td>{{($value->status == true)? 'Terlaksana':'Tidak' }}</td>
                                                    <td>{{$value->mass_amount}}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xs-12  col-sm-6 mt-1">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lokasi paling sering dikunjungi</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lokasi</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter =1; @endphp
                                        @if (empty($top_location))
                                            <tr>
                                                <td colspan="2" class="text-center">Tidak Ada data</td>
                                            </tr>
                                        @else
                                            @foreach ($top_location as $key => $value)
                                            <tr>
                                                <th>{{$counter }}</th>
                                                <td>{{$key}}</td>
                                                <td>{{$value}}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xs-12  col-sm-6 mt-1">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Aliansi paling sering mengunjungi</h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lokasi</th>
                                            <th>Jumlah Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (empty($top_alience))
                                            <tr>
                                                <td colspan="2" class="text-center">Tidak Ada data</td>
                                            </tr>
                                        @else
                                            @php $i=1; @endphp
                                            @foreach ($top_alience as $key => $value)
                                            <tr>
                                                <th>{{$i}}</th>
                                                <td>{{$key}}</td>
                                                <td>{{$value}}</td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="modalDatepicker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{URL::to('dashboard?t=custom')}}" method="get" id="form-custom">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tanggal</label>
                        <input type="hidden" value="custom" name="t">
                        <input type="text" class="form-control" id="tanggal" name="tanggal"  placeholder="Pilih Tanggal" required>
                        <small id="emailHelp" class="form-text text-muted">Tanggal awal hingga tanggal akhir.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="form-custom" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/utils.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.table').dataTable({        
            "pagingType": "full"
        });
        $('input[id="tanggal"]').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
            }
        });
    });
    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
        };
    const grouped_demo_count = {{$demo_astra_grouped->count()}};
    const astra_top_allience = {{count($astra_top_alience)}};
    var color = Chart.helpers.color;
    var barChartData = {
        labels: @php echo json_encode($days); @endphp.map(String),
        datasets: [{
            label: 'Data Demonstrasi',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: @php echo json_encode($daily_demo); @endphp.map(Number)
        }]

    };
    @if ($demo_astra_grouped->count() > 0)
    var coloR = [];
    @foreach ($demo_astra_grouped as $key=>$val)
    coloR.push(dynamicColors());
    @endforeach
    var pieConfig1 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach ($demo_astra_grouped as $key=>$val)
                    {{count($val)}},
                    @endforeach
                ],
                backgroundColor: coloR,
            }],
            labels: [
                
                @foreach ($demo_astra_grouped as $key=>$val)
                '{{($key == '')? 'Tidak Terlaksana':'Terlaksana'}}',
                @endforeach
            ]
        },
        options: {
            responsive: true
        }
    };
    @endif

    @if (count($astra_top_alience) > 0)
    var coloR = [];
    @foreach ($astra_top_alience as $key=>$val)
    coloR.push(dynamicColors());
    @endforeach
    var pieConfig2 = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach ($astra_top_alience as $key=>$val)
                    {{$val}},
                    @endforeach
                ],
                backgroundColor: coloR,
            }],
            labels: [
                    @foreach ($astra_top_alience as $key=>$val)
                    '{{$key}}',
                    @endforeach
            ]
        },
        options: { scales: { scaleLabel: { fontSize: 13 } } }
    };
    @endif

    window.onload = function() {
        var cts = document.getElementById('chart-area2').getContext('2d');
        var ctz = document.getElementById('chart-area1').getContext('2d');
        // var cty = document.getElementById('chart-area').getContext('2d');
        var ctx = document.getElementById('canvas').getContext('2d');
        // if(demo == 0 && demo_astra == 0){
        //     cty.fillStyle = "#3e3e3e";
        //     cty.font = "16px Arial";
        //     cty.fillText('Data Kosong',50,70);
        // }else{
        //     window.myPie = new Chart(cty, pieConfig);
        // }
        if (grouped_demo_count == 0) {
            ctz.fillStyle = "#3e3e3e";
            ctz.font = "16px Arial";
            ctz.fillText('Data Kosong',50,70);
        } else {
            window.myPie = new Chart(ctz, pieConfig1);
        }
        if (astra_top_allience == 0) {
            cts.fillStyle = "#3e3e3e";
            cts.font = "16px Arial";
            cts.fillText('Data Kosong',170,70);
        } else {
            window.myPie = new Chart(cts, pieConfig2);
        }
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
            },
            yAxes: [{
                barPercentage: 0.5,
                min:0,
                gridLines: {
                    display: false
                }
            }],
        });

    };

</script>
@endsection