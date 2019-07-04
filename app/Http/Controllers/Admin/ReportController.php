<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = date('2019-04-01');
        $to = date('2019-04-30');
        $attendances = Attendance::whereBetween('check_time', [$from, $to])->get();
        $employees = Attendance::groupBy('employee_id')->get();
        return view('admin.report.index', compact('attendances', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $from = date( 'Y-m-d', strtotime( $request->start_date ) );
        $to = date( 'Y-m-d', strtotime( $request->end_date ) );
        $attendances = Attendance::whereBetween('check_time', [$from, $to])
            ->where('employee_id', '=', "$request->employee_id")
            ->get();
        $check_array = array();
        foreach ($attendances as $key => $row){
            if (array_key_exists($row->employee_id, $check_array)) {
                $check_array["$row->employee_id"] += 1;
            }else {
                $check_array["$row->employee_id"] = 0;
            }
            $attendances[$key]->on_duty = $check_array["$row->employee_id"];
        }
        $employees = Attendance::groupBy('employee_id')->get();
        return view('admin.report.index', compact('attendances', 'employees', 'inputs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::enableQueryLog();
        $from = date('2019-04-01');
        $to = date('2019-04-30');
        $attendances = Attendance::whereBetween('check_time', [$from, $to])
            ->where('employee_id', '=', $id)
            ->orderBy('check_time', 'ASC')
            ->get();

        $check_array = array();
        foreach ($attendances as $key => $row){
            if (array_key_exists($row->employee_id, $check_array)) {
                $check_array["$row->employee_id"] += 1;
            }else {
                $check_array["$row->employee_id"] = 0;
            }
            $attendances[$key]->on_duty = $check_array["$row->employee_id"];
        }
//        dd(DB::getQueryLog());
        return view('admin.report.show', compact('attendances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
