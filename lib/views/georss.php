<?php
    /**
     * Generates an UUID
     */
    function uuid($prefix = ''){
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }
?>
<?='<?xml version="1.0" encoding="utf-8"?>'?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss">
    <title><?=$title?></title>
    <subtitle><?=$desc?></subtitle>
    <link href="<?=$url?>"/>
    <updated><?=gmdate("Y-m-d\TH:i:s\Z")?></updated>
    <id><?=uuid('urn:uuid:')?></id>
<?php
    foreach($markers as $marker) {
        if( count($marker['d']) == 1 ) {
            $m = $marker['d'][0];
?>
    <entry>
        <title><?=$m->name?></title>
        <id><?=uuid('urn:uuid:')?></id>
        <updated><?=gmdate("Y-m-d\TH:i:s\Z")?></updated>
        <content type="html">
            <?=$m->dsc?>
            <?=htmlentities('<small><a href="')."mailto:$m->email".htmlentities('">').$m->cord.htmlentities('</a></small>')?>
            <?=htmlentities('<small><a href="').$m->web.htmlentities('">').$m->web.htmlentities('</a></small>')?>

        </content>
        <author>
            <name><?=$m->cord?></name>
            <email><?=$m->email?></email>
        </author>
        <georss:point><?=$m->point?></georss:point>
    </entry>
<?php   } else {
?>
    <entry>
        <id><?=uuid('urn:uuid:')?></id>
        <updated><?=gmdate("Y-m-d\TH:i:s\Z")?></updated>
        <content type="html">
            <?php
            foreach($marker['d'] as $m) {
            ?>
            <?=htmlentities('<strong><a href="').$m->web.htmlentities('">').$m->name.htmlentities('</a></strong>')?>
            <?=$m->dsc?>
            <?=htmlentities('<small><a href="')."mailto:$m->email".htmlentities('">').$m->cord.htmlentities('</a></small>')?>
            <?=htmlentities('<small><a href="').$m->web.htmlentities('">').$m->web.htmlentities('</a></small>')?>
            <?php } ?>
        </content>
        <georss:point><?=$marker['d'][0]->point?></georss:point>
    </entry>
<?php
        }
    } ?>
</feed>