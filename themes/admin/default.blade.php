@extends('master')
@section('title','This is title')
@section('heading','This is heading')
@section('sub-heading','This is sub heading')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>

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
            Start creating your amazing application!
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
        <!-- /.box-footer-->
    </div>
@endsection

@push('head')

@endpush

@push('footer')

@endpush
