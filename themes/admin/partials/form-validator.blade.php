@push('head')

@endpush

@push('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $.validate({
        lang: 'en',
        modules : 'html5'
    });
</script>
@endpush
