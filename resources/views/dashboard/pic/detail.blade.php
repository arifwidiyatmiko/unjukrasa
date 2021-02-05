@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Aliansi</h1>
        <a href="{{$previous}}" class="d-none d-sm-inline-block btn btn-sm btn-default shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-primary"></i> Kembali</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nama : <span class="text text-muted">{{$person->name." (".$person->phone.")"}}</span></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tableWithSearch">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Koordinator</th>
                                <th>Nomor Kontak</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
        pageLength: 10,
    });
    
</script>
@endsection