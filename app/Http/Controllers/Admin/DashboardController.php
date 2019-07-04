<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $att_data = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = public_path('uploads/att/OCN6060056051600206_attlog.txt');

//        return $file;
        $data = csvToArray($file, "\t");

//        dd($data);

        $check_array = array();
        foreach ($data as $key => $row){
            if ($key == 0) $prev = date("Y-m-d", strToTime($row[1]));
            $current = date("Y-m-d", strToTime($row[1]));
            if ($prev != $current) {
//                dd($check_array);
//                foreach ($check_array as $list){
//
//                }
                $prev = $current;
            }
            if (array_key_exists($row[0], $check_array)) {
                $check_array["$row[0]"] += 1;
            }else {
                $check_array["$row[0]"] = 0;
            }
            $data[$key][6] = $check_array["$row[0]"];
        }
//
//        dd($data);
        return view('admin.dashboard.check_data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file = public_path('uploads/att/OCN6060056051600206_attlog.txt');

//        return $file;
        $data = csvToArray($file, "\t");

//        dd($data);

        $check_array = array();
        foreach ($data as $key => $row){
            if (array_key_exists($row[0], $check_array)) {
                $check_array["$row[0]"] += 1;
            }else {
                $check_array["$row[0]"] = 0;
            }
            $data[$key][6] = $check_array["$row[0]"];
        }
        $this->att_data = $data;

        foreach ($this->att_data as $key => $row){
            $check = ($row[6]%2 == 0)? 0 : 1;
            $data = array(
                'employee_id' => $row[0],
                'check_time' => $row[1],
                'type' => $check,
            );
            Attendance::create($data);
        }
//        dd($data);
//        ($row[6]%2 == 0)? "Check In" : "Check Out";
        return redirect(route('admin.testdata'));
//        return view('admin.dashboard.create', compact('data'));
    }

    public function test(){
        $from = date('2019-04-01');
        $to = date('2019-04-30');
        $attendances = Attendance::whereBetween('check_time', [$from, $to])->get();
        return view('admin.dashboard.test', compact('attendances'));
    }

    public function testdata(){
        $from = date('2019-04-01');
        $to = date('2019-04-30');
        $attendances = Attendance::whereBetween('check_time', [$from, $to])->get();
        return view('admin.dashboard.test', compact('attendances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
