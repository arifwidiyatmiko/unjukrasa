@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Lokasi</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Lokasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('dashboard/location/update/'.$location->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputFile">Nama Lokasi</label>
                            <input type="text" class="form-control" id="building_name" name="building_name" value="{{$location->building_name}}" placeholder="nama lokasi/gedung" required>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$location->address}}" placeholder="Alamat (Nama Jalan, Alamat Lengkap)" required>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Nama Kota</label>
                            <select name="city" id="city" class="form-control" required>
                                <option></option>
                                @foreach ($city as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control select2" id="city" name="city" required> --}}
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
<link rel="stylesheet" href="{{asset('vendor/select2//dist/css/select2.min.css')}}">
<script src="{{asset('vendor/select2//dist/js/select2.min.js')}}"></script>
<script> 
    $(document).ready(function(){
        $('#city').select2({
            placeholder: "Pilih kota (Ketik atau Scroll)",
        });
    })
</script>
@endsection