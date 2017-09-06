@push('footer')
    <script src="{{site_url('resources/assets/plugins/jquery.popupWindow.js')}}"></script>
    <script>
        $('body').on('click', '[data-action="file-manager"]', function () {
            var id = $(this).data('target');
            var url = '{{site_url('Elfinder_lib/manager')}}?id=' + id;
            $.popupWindow(url, {
                width: 800,
                center: 'screen'
            });
        });

        function processFile(file, target_el) {
            jQuery('#' + target_el).val(file.url);
        }
    </script>
@endpush
