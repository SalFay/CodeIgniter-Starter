var SalFay;
jQuery(function($) {
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
    initEvents: function() {
      this.$body.
          on('click', '[data-action="confirm"]', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            alertify.confirm('Delete', 'Do you really want to delete this?',
                function() {
                  window.location.href = href;
                }, function() {
                });
          }).
          on('click', '[data-show-listing]', function() {
            $('#edit-module').slideUp();
            $('#listing-module').slideDown();
          }).
          on('click', '[data-show-edit]', function() {
            $('#listing-module').slideUp();
            $('#edit-module').slideDown();
          });
    },

    /**
     * Show/Hide Divs
     * @param showDive
     * @param hideDiv
     */
    toggleDivs: function(showDive, hideDiv) {
      $(showDive).slideDown();
      $(hideDiv).slideUp();
    },

    init: function() {
      this.initEvents();
    },
  };
  SalFay.init();
});
