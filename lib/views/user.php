<div id="lug-map">
<form action="" id="lug-map-form" method="post">
<div id="map"></div>
    <p>
        <label for="lm_name" class="required"><?=__("LUG Name","lug-map")?> *:</label>
            <input class="inpt" type="text" name="lm_name" />
        <label for="lm_org" class="required"><?=__("LUG Contact person","lug-map")?> *:</label>
            <input class="inpt" type="text" name="lm_org" />
        <label><?=__("LUG Description","lug-map")?>:</label>
            <textarea name="lm_dsc" class="inpt" tabindex="4"></textarea>
        <label for="lm_email" class="required"><?=__("LUG E-mail","lug-map")?> *:</label>
            <input class="inpt" type="text" name="lm_email" />
        <label for="lm_web"><?=__("LUG Web Page","lug-map")?>:</label>
            <input class="inpt" type="text" name="lm_web" value="http://" />
        <label for="lm_adr" class="lb_adr required" ><?=__("Geographical Position","lug-map")?> *:</label>
            <input id="adr" type="text" name="lm_adr" value="<?=__("Town, County, Country","lug-map")?>" />
            <a href="#" id="srch" ><?=__("Search","lug-map")?></a>
    </p>
    <small><?=__("Required fields are marked with <em>*</em>.","lug-map")?></small>
    <input type="hidden" id="point" name="lm_point" class="required" />
    <input type="submit" id="sbmt" value="<?=__("Add It","lug-map")?>" />
    </form>
</div>