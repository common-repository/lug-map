<ul id="lm_widget_markers">
<?php
    foreach($markers as $item) {
?>
        <li class="lm_widget_marker">
                <a href="#" rel="<?=$item->point?>"><?=$item->name?></a>
        </li>
<?php } ?>
</ul>
