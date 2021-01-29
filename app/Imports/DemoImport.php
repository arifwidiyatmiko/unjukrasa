<?php

namespace App\Imports;


use App\Aliance;
use App\AlliencePic;
use App\Branch;
use App\Demonstration;
use App\Location;
use Carbon\Carbon;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DemoImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $alience = [];
        $aliencepic = [];
        $location = [];
        $branch = [];

        foreach ($collection as $row) {
            $branch[] = [
                'name' => strtoupper(trim($row[5])),
            ];
        }
        $branch = collect($branch)->unique();
        foreach ($branch as $key => $value) {
            if ($value['name'] != NULL) {
                Branch::create($value);
            }
        }
        foreach ($collection as $row) {
            $alience[] = [
                'allience_name' => strtoupper(trim($row[7])),
                // 'allience_name' => str_replace('-','',strtoupper(trim($row[7]))),
            ];
        }
        $alience = collect($alience)->unique();
        // return dd($alience);
        foreach ($alience as $key => $value) {
                if(Aliance::where('allience_name','=',$value)->count() == 0){
                    try {
                        Aliance::create($value);
                      } catch (\Illuminate\Database\QueryException $exception) {
                        return dd(['daskdo'=>$exception,'sds'=>$key]);
                      }
                }
                // else{
                //     return dd($value);
                // }
        }
        foreach ($collection as $row) {
            $aliencepic[] = [
                'name' => strtoupper(trim($row[12])),
                'phone' => ($row[13] == NULL) ? NULL: $row[13],
                'id_allience' => Aliance::where('allience_name','=',strtoupper(trim($row[7])))->firstOrFail()->id,
            ];
        }
        $aliencepic = collect($aliencepic)->unique();
        foreach ($aliencepic as $key => $value) {
            AlliencePic::create($value);
        }

        foreach ($collection as $row) {
            $location[] = [
                'building_name' => strtoupper(trim($row[4])),
                'id_city' => NULL,
                'address' => $row[6],
                'branch_astra' => $row[3],
                'id_branch' => ($row[5] != NULL) ? Branch::where('name','=', strtoupper(trim($row[5])))->firstOrFail()->id : NULL,
            ];
        }
        $location = collect($location)->unique();
        foreach ($location as $key => $value) {
            Location::create($value);
        }
        
        foreach ($collection as $row) {
            if (is_numeric($row[0])) {
                $date = trim($row[0]);
                $date = ($date - 25569) * 86400;
                $demonstration = [
                    'date' => Carbon::parse($date)->format('Y-m-d'),
                    'id_location' => Location::where('building_name', '=', strtoupper(trim($row[4])))->firstOrFail()->id,
                    'id_allience' => AlliencePic::where('name', '=', strtoupper(trim($row[12])))->firstOrFail()->id,
                    'status' => strtoupper($row[8]),
                    'issue' => strtoupper($row[9]),
                    'basis_universitas' => $row[11],
                    'rengiat' => $row[10],
                    'mass_amount' => ($row[14] == '' || $row[14] == NULL) ? 0 : $row[14],
                ];
            }
            // return dd($demonstration);

            Demonstration::create($demonstration);
        }

        
    }

    public function startRow(): int
    {
        return 2;
    }
}
