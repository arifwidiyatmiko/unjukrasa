<?php

namespace App\Http\Controllers;

use App\Imports\DemoImport;
use App\User;
use App\Demonstration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.dashboard.index');
    }
    public function importView(Request $request)
    {
        return view('dashboard.import.index');
    }

    public function import(Request $request)
    {
        $rules = [
            'inputFile' => 'required|mimes:xlsx',
        ];
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return Redirect::to(url()->previous())->withErrors($valid);
        } else {
            Excel::import(new DemoImport, request()->file('inputFile'));
            return Redirect::to('dashboard/location');
        }
    }

    public function locationView(Request $request)
    {
        return view('dashboard.location.index');
    }

    public function areaView(Request $request)
    {
        return view('dashboard.area.index');
    }

    public function alianceView(Request $request)
    {
        return view('dashboard.aliance.index');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            // return dd($valid);
            return Redirect::to('login')->withErrors($valid);
        } else {
            $where = [
                'email'             => $request->email,
                'password'           => $request->password,
            ];
            // return dd(Auth::attempt($where));
            if (Auth::attempt($where)) {
                $id     = Auth::user()->only('id');
                $user   = User::find($id);
                foreach ($user as $user) {
                    return Redirect::to('dashboard');
                }
            } else {
                return Redirect::to('login')->withErrors(['message' => 'Akun Tidak ditemukan atau Tidak Aktif']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
