/*!
 * StrapPress Extras
 */
// Placeholder
jQuery(function(){
     jQuery("a[rel=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      });

      jQuery("a[rel=tooltip]").tooltip();

});
