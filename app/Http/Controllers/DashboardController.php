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
use Illuminate\Support\Facades\URL;

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
                $data['ago'] = \Carbon\Carbon::now()->subWeek();
                $data['currentChoice'] = '1 Minggu';
                break;
            case 'month':
                $data['agoDate'] = \Carbon\Carbon::now()->subMonth();
                $data['ago'] = \Carbon\Carbon::now()->subMonth();
                $data['currentChoice'] = '1 Bulan';
                break;
            case '3month':
                $data['agoDate'] = \Carbon\Carbon::now()->subMonth(3);
                $data['ago'] = \Carbon\Carbon::now()->subMonth(3);
                $data['currentChoice'] = '3 Bulan';
                break;
            case 'custom':
                $tanggal = $string = str_replace(' ', '', $request->tanggal);
                $tanggal = explode("-",$tanggal);
                $data['currentDate'] = \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal[1]);
                $data['agoDate'] = \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal[0]);
                $data['ago'] = \Carbon\Carbon::createFromFormat('d/m/Y', $tanggal[0]);
                $data['currentChoice'] = 'Kostum Tanggal';
                break;
            default:
                $data['agoDate'] = \Carbon\Carbon::now()->subWeek();
                $data['ago'] = \Carbon\Carbon::now()->subWeek();
                $data['currentChoice'] = '1 Minggu';
                break;
        }
        $diffDays = $data['currentDate']->diffInDays($data['agoDate']);
        $data['demonstration'] = Demonstration::where('date','<=',$data['currentDate']->format('Y-m-d'))->where('date','>=',$data['agoDate']->format('Y-m-d'))->get();
        $data['max_massa'] = ( $data['demonstration']->max('mass_amount') == null) ? 0:  $data['demonstration']->max('mass_amount');
        $data['demo_astra'] = $data['demonstration']->filter(function($value,$key){
            if ($value->location->branch_astra == 1) {
                return $value;
            }
        });
        $data['astra_top_alience'] = $data['demo_astra']->map(function($item,$key){ return $item->alliencePic->allience; })->countBy('allience_name')->toArray();
        arsort($data['astra_top_alience']);
        $data['demo_astra_grouped'] = $data['demo_astra']->groupBy('status');
        // return dd($data);
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
            return Redirect::to('dashboard/import')->with(['message','Berkas berhasil disimpan']);
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

    public function demoView(Request $request)
    {
        return view('dashboard.demonstration.index');
    }
    
    public function demoData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'date',
            2 => 'location',
            3 => 'participant',
            4 => 'mass_amount',
            5 => 'option',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = Demonstration::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $institutes = Demonstration::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $institutes = Demonstration::whereHas('location', function ($query) use ($search) {
                return $query->where( 'building_name', 'LIKE',  "%{$search}%");
            })->orWhereHas('alliencePic', function ($query) use ($search) {
                return $query->whereHas('allience', function ($q) use ($search) {
                    return $q->where( 'allience_name', 'LIKE',  "%{$search}%");
                });
            })->orWhere('mass_amount','LIKE',"%{$search}%")->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Demonstration::whereHas('location', function ($query) use ($search) {
                return $query->where( 'building_name', 'LIKE',  "%{$search}%");
            })->orWhereHas('alliencePic', function ($query) use ($search) {
                return $query->whereHas('allience', function ($q) use ($search) {
                    return $q->where( 'allience_name', 'LIKE',  "%{$search}%");
                });
            })->orWhere('mass_amount','LIKE',"%{$search}%")->count();
        }
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            // $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/location/update/'.$item->id).'">Update</a>';
            $item->date_parsed = \Carbon\Carbon::createFromFormat('Y-m-d',$item->date)->format('d M Y');
            $item->building_name = $item->location->building_name;
            $item->allience_name = $item->alliencePic->allience->allience_name;
            return $item;
        });
        // return dd($data);
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        return response()->json($json_data);
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
                return Redirect::to('login')->with(['message' => 'Akun Tidak ditemukan atau Tidak Aktif']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
