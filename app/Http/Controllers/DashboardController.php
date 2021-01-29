<?php

namespace App\Http\Controllers;

use App\Imports\DemoImport;
use App\User;
use App\Demonstration;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{

    public function __construct()
    {
        // session(['key' => 'value']);
    }

    public function index(Request $request)
    {   
        $data['currentDate'] = \Carbon\Carbon::now();
        switch ($request->t) {
            case 'week':
                $data['agoDate'] = \Carbon\Carbon::now()->subWeek();
                break;
            case 'month':
                $data['agoDate'] = \Carbon\Carbon::now()->subMonth();
                break;
            case '3month':
                $data['agoDate'] = \Carbon\Carbon::now()->subMonth(3);
                break;
            case 'custom':
                $tanggal = $string = str_replace(' ', '', $request->tanggal);
                $tanggal = explode("-",$tanggal);
                $data['currentDate'] = \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal[1]);
                $data['agoDate'] = \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal[0]);
                break;
            default:
                $data['agoDate'] = \Carbon\Carbon::now()->subWeek();
                break;
        }
        $diffDays = $data['currentDate']->diffInDays($data['agoDate']);
        $data['demonstration'] = Demonstration::where('date','<=',$data['currentDate']->format('Y-m-d'))->where('date','>=',$data['agoDate']->format('Y-m-d'))->get();
        $data['max_massa'] = ( $data['demonstration']->max('mass_amount') == null) ? 0:  $data['demonstration']->max('mass_amount');
        $data['alience'] = $data['demonstration']->map(function($item,$key){ return $item->alliencePic->allience; })->unique();
        $data['location'] = $data['demonstration']->map(function($item,$key){ return $item->location; })->unique();
        $data['top_alience'] = $data['demonstration']->map(function($item,$key){ return $item->alliencePic->allience; })->countBy('allience_name')->toArray();
        arsort($data['top_alience']);
        $data['top_location'] = $data['demonstration']->map(function($item,$key){ return $item->location; })->countBy('building_name')->toArray();
        arsort($data['top_location']);
        $data['demonstration'] = $data['demonstration']->unique();
        $data['daily_demo'] = [];
        $data['days'] = [];
        for ($i = 0; $i <= $diffDays; $i++) {
            if ($i == 0) {
                $temp = $data['agoDate']->toDateString();
            }else{
                $temp = $data['agoDate']->addDays()->toDateString();
            }
            $data['days'][] = $temp;
            $data['daily_demo'][] = Demonstration::where('date','=',$temp)->count();
        }
        return view('dashboard.dashboard.index',$data);
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
            Excel::import(new DemoImport, request()->file('inputFile'),'UTF-8');
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
