@extends('master')
@section('title','Add New User')
@section('heading','New user')
@section('sub-heading','Fill the information below for User.')

@section('content')
    {!! validation_errors() !!}
    {!! form_open('',['class'=>'form-horizontal']) !!}
    <!-- Login Information -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Login Information</h3>

            <div class="btn-group btn-group-xs pull-right">
                <a href="{{site_url('users')}}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus" aria-hidden="true"></i> All Users
                </a>
                <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Login Name:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="username"
                           value="{{old('username')}}"
                           id="username"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirm" class="col-sm-2 control-label">Confirm Password:</label>
                <div class="col-sm-10">
                    <input type="password"
                           name="password_confirm"
                           id="password_confirm"
                           class="form-control"
                           required
                    >
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Personal Information</h3>

            <div class="btn-group btn-group-xs pull-right">
                <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="first_name" class="col-sm-2 control-label">First Name:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="first_name"
                           value="{{old('first_name')}}"
                           id="first_name"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-sm-2 control-label">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="last_name"
                           value="{{old('last_name')}}"
                           id="last_name"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email"
                           name="email"
                           value="{{old('email')}}"
                           id="email"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Role:</label>
                <div class="col-sm-10">
                    {!! form_dropdown('role',user_roles(),old('role'),['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Business Details -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Business Information</h3>

            <div class="btn-group btn-group-xs pull-right">
                <button type="button" class="btn btn-default" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="business" class="col-sm-2 control-label">Business Name:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="business"
                           value="{{old('business')}}"
                           id="business"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Business Address:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="address"
                           value="{{old('address')}}"
                           id="address"
                           class="form-control"
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="api_key" class="col-sm-2 control-label">API Key:</label>
                <div class="col-sm-10">
                    <input type="text"
                           name="api_key"
                           value="{{old('api_key')}}"
                           id="api_key"
                           class="form-control"
                           required
                    >
                </div>
            </div>
        </div>
    </div>
    <!-- Form Submit -->
    <div class="box box-default">
        <div class="box-body text-center">
            <input type="submit" value="Add User" class="btn btn-primary btn-flat"/>
        </div>
    </div>

    {!! form_close() !!}
@endsection
@include('partials.form-validator')

@push('head')

@endpush

@push('footer')

@endpush
