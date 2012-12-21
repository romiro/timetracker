
<h2><?php echo $today?></h2>

<?php foreach($entries as $entry):?>
<div class="twelve columns">
    <div class="row entry-row">
        <input type="hidden" name="data[id]" value="<?php echo $entry['Entry']['id']?>" />
        <div class="columns start-time">
            <input type="text" name="data[start_time]" placeholder="0:00" value="<?php echo $entry['Entry']['start_time_hours']?>" />
        </div>
        <div class="columns mdash">&mdash;</div>
        <div class="columns end-time">
            <input type="text" name="data[end_time]" placeholder="0:00" value="<?php echo $entry['Entry']['end_time_hours']?>" />
        </div>
        <div class="columns decimal-time">0.08</div>
        <div class="columns attask row collapse">
            <div class="two mobile-one columns">
                <span class="prefix">#</span>
            </div>
            <div class="ten mobile-three columns">
                <input type="text" value="<?php echo $entry['Task']['hour_type']?>" />
            </div>
        </div>
        <div class="columns comment">
            <textarea placeholder="Comment"><?php echo $entry['Entry']['comment']?></textarea>
        </div>
    </div>
</div>
<?php endforeach?>

<div style="clear:both"></div>
<?php pr($entries)?>