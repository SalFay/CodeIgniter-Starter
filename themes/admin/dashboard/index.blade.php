@extends('master')
@section('title','Dashboard')
@section('heading','Dashboard')
@section('sub-heading','Latest Activities and Summary')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard title</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <a href="#" data-action="delete">ddd</a>
            <textarea name="" id="" cols="30" rows="10" class="editor"></textarea>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div>
        <!-- /.box-footer-->
    </div>
@endsection
@include('partials.editor-mini')
@push('head')

@endpush

@push('footer')

@endpush
