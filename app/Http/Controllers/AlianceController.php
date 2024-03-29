<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Aliance;
use App\Pic;
use App\AlliencePic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AlianceController extends Controller
{
    public function alianceData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'allience_name',
            2 => 'option',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = Aliance::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {
            $institutes = Aliance::offset($start)->limit($limit)->get();
        } else {
            // \DB::enableQueryLog();
            $search = $request->input('search.value');
            $institutes = Aliance::where('allience_name','LIKE',"%{$search}%")->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Aliance::where('allience_name','LIKE',"%{$search}%")->count();
        }
        // return dd(\DB::getQueryLog());
        // return dd($totalFiltered);
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/alience/detail/'.$item->id).'">Detail</a> 
            <a class="btn btn-warning" href="'.URL::to('dashboard/alience/update/'.$item->id).'">Update</a>';
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

    public function alianceUpdate(Request $request,$id)
    {
        $data['alience'] = Aliance::findOrFail($id);
        $data['previous'] = url()->previous();
        return view('dashboard.aliance.edit',$data);
    }
    public function aliancePicUpdate(Request $request,$id)
    {
        $data['pic'] = AlliencePic::findOrFail($id);
        $data['previous'] = url()->previous();
        return view('dashboard.aliance.edit_pic',$data);
    }

    public function aliancenDoUpdate (Request $request,$id)
    {
        $rules = [
            'allience_name' => 'required|min:4',
        ];
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return Redirect::to(url()->previous())->withErrors($valid);
        }else{
            $data = [
                'allience_name' => $request->allience_name,
            ];
            Aliance::where('id',$id)->update($data);
            return Redirect::to('dashboard/alience');
        }
    }

    public function aliancenPicDoUpdate(Request $request,$id)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|min:11',
        ];
        $valid = Validator::make($request->all(), $rules);
        if ($valid->fails()) {
            return Redirect::to(url()->previous())->withErrors($valid);
        }else{
            $id_allience= AlliencePic::where('id',$id)->firstOrFail()->id_allience;
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
            ];
            AlliencePic::where('id',$id)->update($data);
            return Redirect::to($request->redirect_url);
        }
    }

    public function picDetail(Request $request, $id)
    {
        $data['alience'] = Aliance::findOrFail($id);
        $data['persons'] = AlliencePic::where('id_allience','=',$id)->get();
        return view('dashboard.aliance.detail', $data);
    }

    public function picAllience(Request $request, $id)
    {
        $data['person'] = AlliencePic::where('id','=',$id)->firstOrFail();
        $data['alience'] = $data['person']->allience;
        $data['previous'] = url()->previous();
        return view('dashboard.pic.detail', $data);
    }

    public function picView(Request $request)
    {
        return view('dashboard.pic.index');
    }

    public function picData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'phone',
            3 => 'option',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = Pic::count();
        $totalFiltered = $totalData;
        if (empty($request->input('search.value'))) {     
            $institutes = Pic::offset($start)->limit($limit)->get();
        } else {
            $search = $request->input('search.value');
            $institutes = Pic::where('name','LIKE',"%{$search}%")->orWhere('phone','LIKE',"%{$search}%")->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Pic::where('name','LIKE',"%{$search}%")->orWhere('phone','LIKE',"%{$search}%")->count();
        }
        $data = array();

        $data = $institutes->map(function ($item, $key) use ($start) {
            $item->no = $start + $key + 1;
            $item->afiliasi = $item->allience->count();
            $item->option = '<a class="btn btn-primary" href="'.URL::to('dashboard/pic/detail/'.$item->id).'">Detail</a> 
            <a class="btn btn-warning" href="'.URL::to('dashboard/alience/pic/update/'.$item->id).'">Update</a>';
            // $item->cityName = ($item->city != NULL) ? $item->city->name : '-';
            // $item->branch_astra = ($item->branch_astra != FALSE) ? '<p class="text text-danger">YA</p>' : '<p class="text text-black">TIDAK</p>';
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
}
