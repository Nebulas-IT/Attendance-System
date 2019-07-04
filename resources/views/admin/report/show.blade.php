@extends('admin.layouts.app')

@section('title','Show Report')


@push('css')

@endpush


@section('content')
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

            @endphp
            <tr>
                <td>{{ $attendance->employee_id }}</td>
                <td>{{ $attendance->check_time }}</td>
                <td>{{ $attendance->type }}</td>
                <td>{{ $on_duty }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')

@endpush