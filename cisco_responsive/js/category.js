jQuery(document).ready(function($){
	$("#tsm-tab-wrap").tabs({

    // loading spinner
    beforeLoad: function(event, ui) {
    // If we already loaded content, return because it's cached
          if ( ui.tab.data( "loaded" ) ) {
              event.preventDefault();
              return;
          }
          // Set data loaded to true so we know it's cached
          ui.jqXHR.done(function() {
              ui.tab.data( "loaded", true );
          });
          // Add loading notification ( Uses Font Awesome )
      ui.panel.html('<div class="tsm-loading"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
      // Display a message if any errors occur
      ui.jqXHR.fail(function() {
          ui.panel.html("An error occured while loading these posts");
      });
    }

    });
});
