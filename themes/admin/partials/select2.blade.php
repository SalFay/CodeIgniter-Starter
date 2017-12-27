@push('head')
    <link rel="stylesheet" href="{{site_url('resources/assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('footer')
    <script src="{{site_url('resources/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
