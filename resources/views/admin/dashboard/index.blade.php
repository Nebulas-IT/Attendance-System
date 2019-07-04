@extends('admin.layouts.app')

@section('title','Dashboard')


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush


@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span area-hidden="true">&times;</span>
                </button>
                <h2>Alert Heading</h2>
                <p>
                    This is a alert <a href="#" class="alert-link">Click</a>
                </p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Please confirm!</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This is the modal body, do you like it?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Show Modal</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 justify-content-center offset-4">
            <form action="#">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control is-invalid" name="username" id="username">
                    <div class="invalid-feedback">Invalid Username</div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control is-valid" name="email" id="email">
                    <small class="valid-feedback">Email is Correct</small>
                </div>
                <div class="form-group">
                    <label for="access">Birthday</label>
                    <input type="text" class="form-control" name="birthday" autocomplete="off" id="birthday">
                </div>
                <div class="form-group">
                    <label for="access">Access</label>
                    <select name="access" id="access" class="form-control">
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="accept-terms" class="form-check-input">
                    <label for="accept-terms" class="form-check-label">Accept Terms &amp; Conditions</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="span5 col-md-5" id="sandbox-container">
            <div class="input-group date">
                <input type="text" class="form-control" autocomplete="off">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sandbox-container .input-group.date').datepicker({});
            $('#birthday').datepicker({
                format: "dd-mm-yyyy",
                orientation: "bottom auto",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
        });
    </script>
@endpush