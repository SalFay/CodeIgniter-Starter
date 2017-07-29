@extends('master')
@section('title',$user->first_name.' '.$user->last_name."'s Profile")
@section('heading',$user->first_name.' '.$user->last_name."'s Profile")

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">All Users</h3>
            <div class="btn-group btn-group-xs pull-right">
                <a href="{{site_url('users')}}" class="btn btn-primary btn-xs">
                    <i class="fa fa-list" aria-hidden="true"></i> All Users
                </a>
                <a href="{{site_url('users/add')}}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus" aria-hidden="true"></i> New User
                </a>
                <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body ajax-box">
            <table class="table table-hover table-striped">
                <tbody>
                <tr>
                    <td><strong>First Name:</strong></td>
                    <td>{{$user->first_name}}</td>
                </tr>
                <tr>
                    <td><strong>Last Name:</strong></td>
                    <td>{{$user->last_name}}</td>
                </tr>
                <tr>
                    <td><strong>Login Name:</strong></td>
                    <td>{{$user->login_name}}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><strong>Role:</strong></td>
                    <td>{{$user->role}}</td>
                </tr>
                <tr>
                    <td><strong>Business Name:</strong></td>
                    <td>{{$user->business}}</td>
                </tr>
                <tr>
                    <td><strong>Business Address:</strong></td>
                    <td>{{$user->address}}</td>
                </tr>
                <tr>
                    <td><strong>API Key:</strong></td>
                    <td>{{$user->api_key}}</td>
                </tr>
                <tr>
                    <td><strong>Registered On:</strong></td>
                    <td>{{date('F j, Y, g:i a',strtotime($user->created_at))}}</td>
                </tr>
                <tr>
                    <td><strong>Last Updated at:</strong></td>
                    <td>{{date('F j, Y, g:i a',strtotime($user->updated_at))}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@include('partials.light-box')

@push('head')

@endpush

@push('footer')

@endpush
