@push('head')

@endpush

@push('footer')
    <script type="text/javascript" src="{{site_url('resources/assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '.editor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help'
            ],
            toolbar: 'insert | undo redo |  styleselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i']
        });
    </script>
@endpush
