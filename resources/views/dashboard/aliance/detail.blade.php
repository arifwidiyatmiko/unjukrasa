@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Aliansi </h1>
        <a href="{{URL::to('dashboard/alience/')}}" class="d-none d-sm-inline-block btn btn-sm btn-default shadow-sm"><i class="fas fa-arrow-left fa-sm text-black-50"></i> Daftar Aliansi</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nama Aliansi : <strong>{{$alience->allience_name}}</strong></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tableWithSearch">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama PIC</th>
                                <th>Nomor Telepon</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persons as $key => $item) 
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <a href="{{URL::to('dashboard/alience/pic/update/'.$item->id)}}" class="btn btn-primary">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('js')

<script> 
    var table = $('#tableWithSearch').DataTable({
    });
    
</script>
@endsection