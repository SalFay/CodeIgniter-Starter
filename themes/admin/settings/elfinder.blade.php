@extends('master')
@section('title','File Manager')
@section('heading','File Manager')

@section('content')
    <div id="elfinder"></div>
@endsection

@push('head')
    <link rel="stylesheet" href='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css'>

@endpush

@push('footer')
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <script src='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.26/js/elfinder.min.js'></script>
    <script>
        $().ready(function () {
            var elf = $('#elfinder').elfinder({
                url: '{{$connector}}',  // connector URL (REQUIRED)
                getFileCallback: function (file) {
                    window.opener.processFile(file, '{{ci()->input->get('id')}}');
                    window.close();
                },
                resizable: false
            }).elfinder('instance');
        });
    </script>
@endpush

