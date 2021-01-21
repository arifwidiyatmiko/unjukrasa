@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Data Aliansi Masyarakat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            @if($errors->any())
            <div class="col-lg-12 sm-p-t-15">
                <div class="alert alert-danger" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    <strong>Error: </strong> {{$errors->first()}}
                </div>
            </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Lokasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('dashboard/alience/update/'.$alience->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputFile">Nama Lokasi</label>
                            <input type="text" class="form-control" id="allience_name" name="allience_name" value="{{$alience->allience_name}}" placeholder="Nama Narahubung/Koordinator" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{$previous}}" class="btn btn-warning">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('js')
<script>
    $("#phone").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>
@endsection