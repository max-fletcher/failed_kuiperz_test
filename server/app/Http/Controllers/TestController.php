<?php

namespace App\Http\Controllers;

use App\Imports\TestImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TestController extends Controller
{
    public function index(){
        return response()->json([
            'status' => 'success',
            'data' => 'some data'
        ]);
    }

    public function generate_report(Request $request){

        // return response()->json([
        //     'status' => 'success',
        //     'fileName' => $request->file('excel')->getClientOriginalName()
        // ]);

        $import = new TestImport;
        Excel::import($import, 'icbs_primax_test.xlsx');

        $filtered_rows = $import->getRows();

        if(isset($request->employee_id)){
            $filtered_rows = $filtered_rows->where('id', $request->employee_id);
        }

        foreach($filtered_rows as $key => $row){
            if(isset($request->fit_hh) && isset($request->fit_mm)){
                $row_fit_hh = explode(':', $row['first_in_time'])[0];
                $row_fit_mm = explode(':', $row['first_in_time'])[1];
            }

            if(isset($request->lot_hh) && isset($request->lot_mm)){
                $row_lot_hh = explode(':', $row['last_out_time'])[0];
                $row_lot_mm = explode(':', $row['last_out_time'])[1];
            }

            // dd($row_fit_hh > $request->fit_hh, $row_fit_hh, $request->fit_hh);

            if((isset($request->fit_hh) && isset($request->fit_mm))){
                if($row_fit_hh > $request->fit_hh || ($row_fit_hh == $request->fit_hh && $row_fit_mm > $request->fit_mm)){
                    $filtered_rows[$key]['bg_color'] = 'red';
                }
            }

            if((isset($request->lot_hh) && isset($request->lot_mm))){
                if($row_lot_hh < $request->lot_hh || ($row_lot_hh == $request->lot_hh && $row_lot_mm < $request->lot_mm)){
                    $filtered_rows[$key]['bg_color'] = 'yellow';
                }
            }
        }

        // dd($import->getRows());

        // return response()->json([
        //     'status'        => 'success',
        //     'data'          => $filtered_rows,
        //     // 'employee_id'   => $request->employee_id
        //     // 'request'    => $request->all()
        // ]);

        return response()->json(
            $filtered_rows,
        );
    }

    public function download_pdf(Request $request){

        $import = new TestImport;
        Excel::import($import, 'icbs_primax_test.xlsx');

        $filtered_rows = $import->getRows();

        if(isset($request->employee_id)){
            $filtered_rows = $filtered_rows->where('id', $request->employee_id);
        }

        foreach($filtered_rows as $key => $row){
            if(isset($request->fit_hh) && isset($request->fit_mm)){
                $row_fit_hh = explode(':', $row['first_in_time'])[0];
                $row_fit_mm = explode(':', $row['first_in_time'])[1];
            }

            if(isset($request->lot_hh) && isset($request->lot_mm)){
                $row_lot_hh = explode(':', $row['last_out_time'])[0];
                $row_lot_mm = explode(':', $row['last_out_time'])[1];
            }

            if((isset($request->fit_hh) && isset($request->fit_mm))){
                if($row_fit_hh > $request->fit_hh || ($row_fit_hh == $request->fit_hh && $row_fit_mm > $request->fit_mm)){
                    $filtered_rows[$key]['bg_color'] = 'red';
                }
            }

            if((isset($request->lot_hh) && isset($request->lot_mm))){
                if($row_lot_hh < $request->lot_hh || ($row_lot_hh == $request->lot_hh && $row_lot_mm < $request->lot_mm)){
                    $filtered_rows[$key]['bg_color'] = 'yellow';
                }
            }
        }

        // convert to array for adding table headers
        $filtered_rows = $filtered_rows->toArray();

        array_unshift($filtered_rows, [
            'month'         => 'month',
            'date'          => 'date',
            'day'           => 'day',
            'id'            => 'id',
            'employee_name' => 'employee_name',
            'department'    => 'department',
            'first_in_time' => 'first_in_time',
            'last_out_time' => 'last_out_time',
            'hours_of_work' => 'hours_of_work',
        ]);

        $path = public_path() . '/pdf/' . 'icbs_primax_test' . '.pdf';

        $data = [
            'filtered_rows' => $filtered_rows,
        ];

        $pdf = Pdf::loadView('dom_pdf.testpdf', $data);
        $pdf->save($path);

        return response()->download($path);
    }
}
