
<h2><?php echo $today?></h2>

<?php foreach($entries as $entry):?>
<div class="twelve columns">
    <div class="row entry-row">
        <div class="columns start-time">
            <input type="text" placeholder="0:00" value="<?php echo $entry['Entry']['start_time_hours']?>" />
        </div>
        <div class="columns mdash">&mdash;</div>
        <div class="columns end-time">
            <input type="text" placeholder="0:00" value="<?php echo $entry['Entry']['end_time_hours']?>" />
        </div>
        <div class="columns decimal-time">0.00</div>
        <input type="hidden" name="decimal-time" value="0.00" />
        <div class="columns attask row collapse">
            <div class="two mobile-one columns">
                <span class="prefix">#</span>
            </div>
            <div class="ten mobile-three columns">
                <input type="text" value="GO" />
            </div>
        </div>
        <input type="hidden" name="attask" value="" />
        <div class="columns comment">
            <textarea placeholder="Comment"><?php echo $entry['Entry']['comment']?></textarea>
        </div>
    </div>
</div>
<?php endforeach?>

<div style="clear:both"></div>
<?php pr($entries)?>