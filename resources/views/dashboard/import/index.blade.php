@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Form</h1>
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
            @if (Session::has('success'))
            <div class="col-lg-12 sm-p-t-15">
                <div class="alert alert-danger" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    <strong>{!! Session::get('success') !!}</strong>
                </div>
            </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Import</h6>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('dashboard/import')}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputFile">Pilih File</label>
                            <input type="file" class="form-control" id="inputFile" name="inputFile" required>
                            <small id="inputFile" class="form-text text-muted">Format File XLSX.</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Unggah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection