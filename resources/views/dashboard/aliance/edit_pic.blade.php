@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Data Koordinator Aliansi Masyarakat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Koordinator Aliansi Masyarakat</h6>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('dashboard/alience/pic/update/'.$pic->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputFile">Nama Lokasi</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$pic->name}}" placeholder="Nama Narahubung/Koordinator" required>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Alamat</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$pic->phone}}" placeholder="Nomor Telepon" required>
                        </div>
                        <input type="hidden" name="redirect_url" value="{{$previous}}">
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