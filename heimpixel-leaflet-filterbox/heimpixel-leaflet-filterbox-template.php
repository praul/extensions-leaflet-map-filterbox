<?php // $item['class', 'id', 'val', 'label'] ?>

<div id="leafletext-filterbox" class="leafletext-filterbox-outer <?= ($filter_inside === 1) ? 'leaflet-control-layers leaflet-control-layers-expanded leaflet-control' : 'leafletext-filterbox-outside' ?>">
    <div class="leafletext-filterbox-inner">
        <ul>
            <?php foreach ($filter_data as $item) { ?>
                <li>
                    <input type="checkbox" class="leaflet-filterbox-filter" id="leaflet_filter_<?= $item['class']?>" data-leaflet-filterclass="<?= $item['class'] ?>" data-leaflet-filterid="<?= $item['id'] ?>" checked>
                    <label for="leaflet_filter_<?= $item['class']?>"> <?= $item['label'] ?></label>
            <?php } ?>
        </ul>
    </div>
</div>