<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.user.index');
    }

    public function userData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'last_update',
            4 => 'option',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = User::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $institutes = User::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $institutes = User::where('name','LIKE',"%{$search}%")->orWhere('email','LIKE',"%{$search}%")->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = User::where('name','LIKE',"%{$search}%")->orWhere('email','LIKE',"%{$search}%")->count();
        }
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            $item->last_update = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->updated_at)->format('d M Y H:i');
            if (Auth::user()->id == $item->id) {
                $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/users/update/'.$item->id).'"><i class="fas fa-user-edit"></i></a> <a class="btn btn-danger disabled" href="'.URL::to('dashboard/users/delete/'.$item->id).'"><i class="fas fa-user-times"></i></a>';
            } else {
                $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/users/update/'.$item->id).'"><i class="fas fa-user-edit"></i></a> <a class="btn btn-danger" href="'.URL::to('dashboard/users/delete/'.$item->id).'"><i class="fas fa-user-times"></i></a>';
            }
            return $item;
        });
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return response()->json($json_data);
    }

    public function userUpdate(Request $request,$id)
    {
        $data['user'] = User::where('id','=',$id)->firstOrFail();
        $data['previous'] = url()->previous();
        return view('dashboard.user.edit',$data);
    }

    public function userDoUpdate(Request $request,$id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
        ];
        if ($request->password) {
            $rules['password'] = 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
        }
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return Redirect::to(url()->previous())->withErrors($valid);
        } else {
            $data = [
                'name'             => $request->name,
                'email'             => $request->email."@ai.astra.co.id",

            ];
            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }
            User::where('id','=',$id)->update($data);
            return Redirect::to('dashboard/users')->with('message','Data berhasil di simpan');
        }
    }

    public function create(Request $request)
    {
        $data['previous'] = url()->previous();
        return view('dashboard.user.tambah',$data);
    }
    public function insert(Request $request)
    {$rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
    ];
    $valid = Validator::make($request->all(), $rules);
    if ($valid->fails()) {
        return Redirect::to(url()->previous())->withErrors($valid);
    } else {
        $data = [
            'name'             => $request->name,
            'email'             => $request->email."@ai.astra.co.id",
            'status'        => TRUE,
            'password'          => bcrypt($request->password),
        ];
        User::create($data);
        return Redirect::to('dashboard/users')->with('message','Data berhasil di simpan');
    }
    }

    public function delete(Request $request,$id){
        User::where('id','=',$id)->delete();
        return Redirect::to('dashboard/users')->with('warning','Data berhasil di hapus');
    }
}
