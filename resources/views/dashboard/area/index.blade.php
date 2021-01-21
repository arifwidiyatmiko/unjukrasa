@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tabel Wilayah</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tableWithSearch">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Provinsi</th>
                                <th>Nama Kota/Kabupaten</th>
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
        processing: true,
        serverSide: true,
        ajax: "{{ route ('api.area') }}",
        columns: [
            {"data":"no",orderable: false},
            {"data":"provinceName",orderable: false},
            {"data":"cityName",orderable: false},
            // {"data":"updated_at"},
        ],
    });
    
    $(document).ready(function() {
        $('.item-select2').select2();
    });
</script>
@endsection