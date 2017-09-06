@push('head')

@endpush

@push('footer')
    <script type="text/javascript" src="{{site_url('resources/assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '.editor',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'template paste textcolor colorpicker textpattern imagetools codesample toc help emoticons hr'
            ],
            toolbar1: 'newdocument | print preview searchreplace | spellchecker | undo redo | insert | bullist numlist outdent indent |   visualblocks fullscreen help',
            toolbar2: 'styleselect | fontselect | fontsizeselect | bold italic underline  | alignleft aligncenter alignright alignjustify | forecolor backcolor | removeformat',
            image_advtab: true,
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            ]
        });

    </script>
@endpush
