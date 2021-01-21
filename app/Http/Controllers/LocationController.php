<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class LocationController extends Controller
{
    public function areaData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'provinceName',
            2 => 'cityName',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = City::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $institutes = City::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $institutes = City::whereHas('province', function ($query) use ($search) {
                return $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                )->orWhere('name', 'LIKE', "%{$search}%");
            })->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = City::whereHas('province', function ($query) use ($search) {
                return $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                )->orWhere('name', 'LIKE', "%{$search}%");
            })->offset($start)->limit($limit)->orderBy($order, $dir)->count();
        }
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            $item->cityName = $item->name;
            $item->provinceName = $item->province->name;
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

    public function locationData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'building_name',
            2 => 'address',
            3 => 'cityName',
            4 => 'branch_astra',
            6 => 'option',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = Location::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $institutes = Location::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $institutes = City::whereHas('province', function ($query) use ($search) {
                return $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                )->orWhere('name', 'LIKE', "%{$search}%");
            })->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = City::whereHas('province', function ($query) use ($search) {
                return $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                )->orWhere('name', 'LIKE', "%{$search}%");
            })->offset($start)->limit($limit)->orderBy($order, $dir)->count();
        }
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/location/update/'.$item->id).'">Update</a>';
            $item->cityName = ($item->city != NULL) ? $item->city->name : '-';
            $item->branch_astra = ($item->branch_astra != FALSE) ? '<p class="text text-danger">YA</p>' : '<p class="text text-black">TIDAK</p>';
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

    public function locationUpdate(Request $request,$id)
    {
        $data['location'] = Location::findOrFail($id);
        $data['city'] = City::all();
        $data['previous'] = url()->previous();
        return view('dashboard.location.edit',$data);
    }
    public function localtionDoUpdate(Request $request,$id)
    {
        $rules = [
            'building_name' => 'required|min:4',
            'address' => 'required|min:4',
            'city' => 'required',
        ];
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return Redirect::to(url()->previous())
            ->withErrors($valid);
        }else{
            $data = [
                'building_name' => $request->building_name,
                'address' => $request->address,
                'id_city' => $request->city,
            ];
            Location::where('id',$id)->update($data);
            return Redirect::to('dashboard/location');
        }
    }
}
