@extends('admin.layouts.app')

@section('title','Msfsf')


@push('css')

@endpush


@section('content')
    <div class="card bg-light mt-3">
        <div class="card-header">
            Laravel 5.7 Import Export Excel to database Example - ItSolutionStuff.com
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('admin.dashboard.create') }}">Export User Data</a>
            </form>
        </div>
    </div>
@stop


@push('scripts')

@endpush
