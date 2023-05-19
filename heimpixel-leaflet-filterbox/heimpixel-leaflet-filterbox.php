<?php
/*
Plugin Name: Leaflet Filterbox
Plugin URI: https://heimpixel.de
Description: See sourcecode. Use shortcode like this: [leaflet-filterbox values="category_1, category_2" groups="Wonderful Adventures, Boring Entertainment" inside="1"] for leaflet-markers (svg) with iconClass, like this: [leaflet-marker svg background="#777" iconClass="dashicons dashicons-star-filled category_1" color="gold"]My Favorite Place in the World[/leaflet-marker]
Version: 0.01
License: CC0
Author: Paul Dettmering
Author URI: https://heimpixel.de
*/

/*
Filterbox for Leaflet Markers with iconClass. 

This is a hacky approach without any using of leaflets built-in functions. Markers will show/hide based on css class.

Works only with svg marker shortcode, because it needs "iconClass" for categorization
    [leaflet-marker svg background="#777" iconClass="dashicons dashicons-star-filled category_1" color="gold"]My Favorite Place in the World[/leaflet-marker]

(notice the additonal category_1 in "iconClass", you can add as many categories as you like)

Shortcode for filterbox is same like in Leafletext, except you can also specify, if filterbox should be inside map (leaflet top right) or where the shortcode is place
    [leaflet-filterbox values="category_1, category_2" groups="Wonderful Adventures, Boring Entertainment" inside="1"]

*/

function leafletext2_filterbox_shortcode($atts) {
    //Check Required
    $required = array ('values', 'groups');
    foreach ($required as $req) { if (empty($atts[$req])){return 'leaflet-filterbox-error: you must specify "'.$req.'" in shortcode atts';}}

    //Populate Data
    $filter_classes = explode(', ', $atts['values']);
    $filter_labels = explode(', ', $atts['groups']);
    $filter_inside = (!empty($atts['inside'])) ? intval($atts['inside']) : 0;

    $j = count($filter_classes); $k = count($filter_labels); 
    if ($j != $k) return 'leaflet-filterbox-error: values and groups count do not match in shortcode';
    $filter_data = array();
    
    for ($i = 0; $i < $j ; $i++) {
       $filter_data[$i] = array (
        'id' => $i,
        'class' => $filter_classes[$i],
        'label' => $filter_labels[$i],
        'val' => 1,
       );
    }

    //Enqueue Scripts and provide js array
    wp_register_script('leafletext2_filterbox-js',  plugin_dir_url( __FILE__ ) . 'heimpixel-leaflet-filterbox.js', array('jquery'),filemtime(plugin_dir_url( __FILE__ ) . 'heimpixel-leaflet-filterbox.css'), true);
    wp_localize_script( 'leafletext2_filterbox-js', 'leafletext2_filterbox_data', $filter_data);
    wp_localize_script( 'leafletext2_filterbox-js', 'leafletext2_filterbox_inside',  $filter_inside);
    wp_enqueue_script('leafletext2_filterbox-js');
    wp_enqueue_style('leafletext2_filterbox-css', plugin_dir_url( __FILE__ ) . 'heimpixel-leaflet-filterbox.css', array(), filemtime(plugin_dir_url( __FILE__ ) . 'heimpixel-leaflet-filterbox.css'), false);


    //Include Filterbox Template
    ob_start();
    include 'heimpixel-leaflet-filterbox-template.php';
    return ob_get_clean();
    

}

add_shortcode ('leaflet-filterbox', 'leafletext2_filterbox_shortcode');



