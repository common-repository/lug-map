<?php if($flash) { ?><div id="message" class="updated fade"><p><strong><?=$flash?></strong></p></div><?php } ?>
<div id="icon-tools" class="icon32"><br /></div>
<div class="wrap">
    <h2><?=__('Lug Map Options','lug-map')?></h2>
    <div id="poststuff" class="metabox-holder">
        <div class="postbox">
            <h3 class="hndle" ><?=__('How to use it?','lug-map')?></h3>
            <div class="inside">
                <p><?=__('Insert inside the content of a page or a post the shortcode','lug-map')?>: <code>[LUGMAP]</code></p>
            </div>
        </div>
        <div class="postbox">
            <h3 class="hndle" ><?=__('Google Maps API Key','lug-map')?>, <?=__('Lug Map Start-Up Location','lug-map')?></h3>
            <div class="inside">
                <form action="" method="post" >
                    <p>
                        <small><?=sprintf(__('Can be obtained <a href="%1$s">here</a>','lug-map'), 'http://code.google.com/apis/maps/signup.html')?>.</small>
                    </p>
                    <p>
                        <input size="90" maxlength="90" style="font-family: 'Courier New',Courier,mono; font-size: 1.5em;" type="text" name="lugmap_api_key" value="<?=$lugmap_api_key?>" />
                    </p>
                    <p>
                        <small><?=sprintf(__('Please add the coordinates for the location wich should be loaded on showing up the map. You can use <a href="%1$s">this tool</a>','lug-map'),'http://itouchmap.com/latlong.html')?>.</small><br />
                    </p>
                    <p>
                        <input size="20" style="font-family: 'Courier New',Courier,mono; font-size: 1.5em;" type="text" name="lugmap_coord" value="<?=$lugmap_coord?>" />
                    </p>
                    <p>
                        <input type="submit" class="button" value="<?=__('Save Changes','lug-map')?>" />
                    </p>
                </form>
            </div>
        </div>
        <div class="postbox">
            <h3 class="hndle" ><?=__('Here you can delete entries','lug-map')?></h3>
            <div class="inside">
                <ol>
                    <?php
                        foreach($markers as $marker) {
                            printf(__('<li><a href="%1$s" title="Delete this marker" style="font-weight: bolder; font-size: 14px; text-decoration: none;" >&times;</a> | Geolocation: %2$s, Name: <strong>%3$s</strong>, URL: <a href="%4$s">%4$s</a>, Contact: <a href="mailto:%5$s">%6$s</a><br />%7$s</li>','lug-map'),
                                   "?page=lug-map&delete_lugmap_marker=$marker->id",
                                   "$marker->point",
                                   "$marker->name",
                                   "$marker->web",
                                   "$marker->email",
                                   "$marker->cord",
                                   "$marker->dsc");
                            echo "\n"; 
                        }
                    ?>
                </ol>
            </div>
        </div>
        <div class="postbox">
            <h3 class="hndle" ><?=__('Remove Lug Map Content','lug-map')?></h3>
            <div class="inside">
                <p><?=__('Warnning! This will drop lugmap table and recreate it, so the present markers will be removed totally','lug-map')?>.</p>
                <form method="post" action="">
                    <input type="hidden" name="lugmap_clean" value="true" />
                    <input type="submit" class="button" value="<?=__('Clean Database','lug-map')?>" />
                </form>
            </div>
        </div>
    </div>
</div>