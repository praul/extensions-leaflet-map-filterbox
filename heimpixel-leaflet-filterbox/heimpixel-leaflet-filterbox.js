jQuery(document).ready(function(){
    var leafletext_state = leafletext2_filterbox_data;
    var leafletext_inside = leafletext2_filterbox_inside;

    //Move Filterbox
    if (leafletext_inside > 0) {
      leafletext_filterbox_wait('.leaflet-top.leaflet-right').then((el) => {
        jQuery("#leafletext-filterbox").appendTo('.leaflet-top.leaflet-right');
      });
    }

    //Listener
    jQuery('.leaflet-filterbox-filter').each(function(){
      jQuery(this).on('change', function(){
        leafletext_filterbox_switch(this)
      })
    })

    function leafletext_filterbox_switch(el) {
      var id = jQuery(el).data('leaflet-filterid')
      console.log(id);
      if( jQuery(el).is(":checked")) {
        leafletext_state[id].val = 1;
      } else {
        leafletext_state[id].val = 0;
      }
      leafletext_filterbox_showhide();
    }

    function leafletext_filterbox_showhide() {
      jQuery('.leaflet-marker-pane > img, .leaflet-marker-pane > div').each(function(){jQuery(this).hide();});
      
      leafletext_state.forEach((item) => {
        if (item.val === 1) {jQuery('.' + item.class).parent().show();}
      });
    }
    
    //Helper Function to fire when Element Loaded
    function leafletext_filterbox_wait(selector) {
      return new Promise(resolve => {
          if (document.querySelector(selector)) {
              return resolve(document.querySelector(selector));
          }
  
          const observer = new MutationObserver(mutations => {
              if (document.querySelector(selector)) {
                  resolve(document.querySelector(selector));
                  observer.disconnect();
              }
          });
  
          observer.observe(document.body, {
              childList: true,
              subtree: true
          });
      });
  }



});
