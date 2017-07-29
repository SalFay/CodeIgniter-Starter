@extends('master')
@section('title','All Users')
@section('heading','Manage Users')
@section('sub-heading','Add, Edit &amp; Delete Users')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">All Users</h3>
            <div class="btn-group btn-group-xs pull-right">
                <a href="{{site_url('users/add')}}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus" aria-hidden="true"></i> New User
                </a>
                <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped" id="table">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>Login Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered On</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>User Name</th>
                    <th>Login Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered On</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@include('partials.light-box')
@include('partials.data-tables')

@push('head')

@endpush

@push('footer')
<script>
    var table = $('#table').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{site_url('users/all_ajax')}}",
            "type": "POST"
        },
        columns: [
            {data: "$.username"},
            {data: "login_name"},
            {data: "email"},
            {data: "role"},
            {data: "created_at"},
            {data: "$.actions"},
        ],
    });
    $('#table').on( 'draw.dt', function () {
        $('[data-action="lightbox"]').featherlight();
    } );

</script>
@endpush
