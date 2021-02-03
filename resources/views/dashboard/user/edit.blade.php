@extends('dashboard.index')

@section('body')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update data User</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update User</h6>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('dashboard/users/update/'.$user->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row align-items-center">
                            <div class="col-sm-6">
                              <label class="sr-only" for="inlineFormInput">Nama Lengkap</label>
                              <input type="text" class="form-control mb-2" id="name" name="name" value="{{$user->name}}" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-sm-6">
                              <label class="sr-only" for="inlineFormInputGroup">Email</label>
                              <div class="input-group mb-2">
                                <input type="text" class="form-control" id="email" name="email" value="{{explode('@',$user->email)[0]}}" required>
                                <div class="input-group-prepend">
                                  <div class="input-group-text">@ai.astra.co.id</div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputFile">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <small id="passwordSmall" class="form-text text-muted">Minimum 8 Karakter. Terdiri dari Huruf Kapital, Angka, dan Special Karakter.</small>
                            <input type="checkbox" onclick="passwordToggle()">Show Password
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
        $('.btn-primary').prop('disabled',true);
        // let pattern = /"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var pattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        $('#password').on('keyup',function(){
            console.log(pattern.test($(this).val()));
            console.log('Text : ',$(this).val());
            if(pattern.test($(this).val())){
                $('.btn-primary').prop('disabled',false);
            }else{
                $('.btn-primary').prop('disabled',true);
            }
        });
    })
    
    function passwordToggle() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
</script>
@endsection