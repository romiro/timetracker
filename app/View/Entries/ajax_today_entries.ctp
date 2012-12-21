
<h2><?php echo $today?></h2>
<input type="hidden" id="TodayDate" name="data[today_date]" value="<?php echo $today?>" />

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
        <div class="columns decimal-time">0.00</div>
        <input type="hidden" name="decimal_time" value="0.00" />
        <div class="columns attask row collapse">
            <div class="two mobile-one columns">
                <span class="prefix">#</span>
            </div>
            <div class="ten mobile-three columns">
                <input type="text" name="data[attask_id]" value="<?php echo $entry['Task']['attask_id']?>" />
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
<button type="button" id="TestButton">(Test) Entry Update Ajax</button>

<script type="text/javascript">

    $('#TestButton').click(function(){
        var $first = $('.entry-row').eq(4);
        var data = $first.find('input').serializeArray();
        data.push($('#TodayDate').serializeArray()[0]);
        $.ajax({
            type: 'post',
            url: '/entries/ajaxUpdateAll',
            data: data
        });
    });
</script>
<?php pr($entries)?>