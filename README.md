# extensions-leaflet-map-filterbox
Wordpress Plugin, extends Leaflet Map with a filter box

# Filterbox for Leaflet Markers with iconClass. 

This is a hacky approach without any using of leaflets built-in functions. Markers will show/hide based on css class.

Works only with svg marker shortcode, because it needs "iconClass" for categorization
    ```[leaflet-marker svg background="#777" iconClass="dashicons dashicons-star-filled category_1" color="gold"]My Favorite Place in the World[/leaflet-marker]```

(notice the additonal category_1 in "iconClass", you can add as many categories as you like)

Shortcode for filterbox is same like in hupe13/extensions-leaflet-map-github, except you can also specify, if filterbox should be inside the map container (leaflet top right) or where the shortcode is placed
    ```[leaflet-filterbox values="category_1, category_2" groups="Wonderful Adventures, Boring Entertainment" inside="1"]```
