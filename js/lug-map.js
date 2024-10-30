// Load Map
jQuery('#map').jmap('init',{
    'mapType':G_HYBRID_MAP,
    'language': lm_language,
    'mapZoom': 7,
    'mapShowjMapsIcon': false,
    'mapCenter': lm_mapCenter}
    );
// Load GeoRSS
jQuery('#map').jmap('AddFeed', {
    'feedUrl': lm_feedUrl
});
// Enable Reverse Geocoding
jQuery('#srch').click(function(){
    jQuery('#map').jmap('SearchAddress', {
        'query': jQuery('#adr').val(),
        'returnType': 'getLocations'
    }, function(result, options) {
        var valid = Mapifies.SearchCode(result.Status.code);
        if (valid.success) {
        jQuery.each(result.Placemark, function(i, point){
            jQuery('#map').jmap('AddMarker',{
                    'pointLatLng':[point.Point.coordinates[1], point.Point.coordinates[0]],
                    'pointHTML':point.address
                });
            jQuery('#point').val(point.Point.coordinates[1]+','+point.Point.coordinates[0]);
            jQuery('#map').jmap('MoveTo',{
                    'mapCenter':[point.Point.coordinates[1], point.Point.coordinates[0]],
                    'mapZoom': 15
                });
            });
        } else {
            jQuery('#address').val(valid.message);
        }
    });
    return false;
});
// Some simple validation
jQuery("#lug-map-form").submit(function(event) {
    var err = [];
    jQuery('#lug-map-form .required').css('color','inherit');
    jQuery("label.required").each(function() {
            if(jQuery('input[name='+this.htmlFor+']').val() == '')
                err[err.length] = this.htmlFor;
        });
    if(jQuery('#point.required').val() == '')
        err[err.length] = this.name;
    if (err.length > 0) {
        alert(lm_jsError);
        jQuery('#lug-map-form .required').css('color','#cc0000');
    }
    return (err.length <= 0);
});
// Some widget logic, go to clicked marker
jQuery('#lm_widget_markers li a').click(function(){
    var point = jQuery(this).attr('rel').split(',');
    jQuery('#map').jmap('MoveTo',{
        'mapCenter':[point[0],point[1]],
        'mapZoom': 15
    });
});