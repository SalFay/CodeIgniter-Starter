var app;
jQuery(function ($) {
    app = {

        /**
         * jQuery Body Object
         */
        $body: $('body'),

        /**
         * jQuery Window Object
         */
        $window: $(window),

        /**
         *  jQuery Document Object
         */
        $document: $(document),

        /**
         *
         */
        deleteAction: function () {
            this.$body.on('click', '[data-action="delete"]', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                alertify.confirm('Delete', 'Do you really want to delete this?', function () {
                    window.location.href = href;
                },function(){});

            });
        },


        init: function () {
            $(document).ready(function(){
                app.deleteAction();
            });
        }
    };
    app.init();
});
