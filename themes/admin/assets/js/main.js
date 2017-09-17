var SalFay;
jQuery(function ($) {
    SalFay = {

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
        confirmAction: function () {
            this.$body.on('click', '[data-action="confirm"]', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                alertify.confirm('Delete', 'Do you really want to delete this?', function () {
                    window.location.href = href;
                }, function () {
                });

            });
        },

        /**
         * Show/Hide Divs
         * @param showDive
         * @param hideDiv
         */
        toggleDivs: function (showDive, hideDiv) {
            $(showDive).slideDown();
            $(hideDiv).slideUp();
        },


        init: function () {
            $(document).ready(function () {
                SalFay.confirmAction();
            });
        }
    };
    SalFay.init();
});
