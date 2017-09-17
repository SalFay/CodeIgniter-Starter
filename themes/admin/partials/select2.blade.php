@push('head')
    <link rel="stylesheet" href="{{site_url('resources/asstes/plugins/select2/css/select2.min.css')}}">
@endpush

@push('footer')
    <script src="{{site_url('resources/asstes/plugins/select2/js/select2.full.min.css')}}"></script>
    <script>
        $(document).ready(function() {
            $('[data-select2]').select2();
        });
    </script>
@endpush
