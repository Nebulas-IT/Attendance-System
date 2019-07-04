@extends('admin.layouts.app')

@section('title','Create')


@push('css')

@endpush


@section('content')
    @php
        // dd($data);
    @endphp
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Checked</th>
            <th scope="col">Type</th>
            <th scope="col">Unknown</th>
            <th scope="col">Unknown</th>
            <th scope="col">Unknown</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row[0] }}</td>
                <td>{{ $row[1] }}</td>
                <td>{{ $row[2] }}</td>
                <td>{{ $row[3] }}</td>
                <td>{{ $row[4] }}</td>
                <td>{{ $row[5] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')

@endpush
