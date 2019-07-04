@extends('admin.layouts.app')

@section('title','Report')


@push('css')

@endpush


@section('content')
    @php
        if (!isset($inputs)){
            $inputs["start_date"] = null;
            $inputs["end_date"] = null;
            $inputs["employee_id"] = null;
        }
    @endphp
    <form action="{{ route('admin.report.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3" id="sandbox-container">
                <label for="access">Start Date</label>
                <div class="form-group date">
                    <input type="text" class="form-control" autocomplete="off" name="start_date" value="{{ $inputs["start_date"] }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3" id="sandbox-container">
                <label for="access">End Date</label>
                <div class="form-group date">
                    <input type="text" class="form-control" autocomplete="off" name="end_date" value="{{ $inputs["end_date"] }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="form-group">
                    <label for="access">Employee ID</label>
                    <select name="employee_id" id="access" class="form-control">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->employee_id }}" {{ ($employee->employee_id==$inputs["employee_id"])? "selected":"" }}>{{ $employee->employee_id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="form-group content-bottom">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Checked Time</th>
            <th scope="col">Type</th>
            <th scope="col">On Duty</th>
        </tr>
        </thead>
        <tbody>
        @php
            $check_array = array();
        @endphp
        @foreach ($attendances as $key => $attendance)
            @php
                $on_duty = 0;
                if($attendance->type == 0){
                    $check_array["$attendance->employee_id"][0] = $attendance->check_time;
                    $dteStart = new DateTime($check_array["$attendance->employee_id"][0]);
                }else {
                    $check_array["$attendance->employee_id"][1] = $attendance->check_time;
                }

                if (isset($check_array["$attendance->employee_id"][1]) && isset($check_array["$attendance->employee_id"][0])){
                    if ($check_array["$attendance->employee_id"][1]>$check_array["$attendance->employee_id"][0]){
                        $dteStart = new DateTime($check_array["$attendance->employee_id"][0]);
                        $dteEnd   = new DateTime($check_array["$attendance->employee_id"][1]);
                        $on_duty = $dteStart->diff($dteEnd)->format("%h Hours %i Minutes %s Seconds");
                    }
                }else {
                    $on_duty = 0;
                }

                $check_in = "<span style='color:green'>Check In</span>";
                $check_out = "<span style='color:red'>Check Out</span>";
                ($attendance->type == 0) ? $check = $check_in : $check = $check_out;
            @endphp
            <tr>
                <td>{{ $attendance->employee_id }}</td>
                <td>
                    <?php
                        if($attendance->type == 0){
                            echo $dteStart->format('Y-m-d H:i:s');
                        }else {
                            echo $attendance->check_time;
                        }
                    ?>
                    - {{ $attendance->check_time }}</td>
                <td>{!! $check !!}</td>
                <td>{{ $on_duty }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#sandbox-container .form-group').datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: true,
            });
            // $('#datetimepicker8').datepicker({
            //     format: "dd-mm-yyyy",
            //     orientation: "bottom auto",
            //     calendarWeeks: true,
            //     autoclose: true,
            //     todayHighlight: true,
            //     toggleActive: true
            // });
        });
    </script>
@endpush