
<h2><?php echo $day?></h2>
<input type="hidden" id="Day" name="data[day]" value="<?php echo $day?>" />

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
            <div class="ten mobile-three columns attask-id">
                <input type="text" name="data[attask_id]" value="<?php echo $entry['Task']['attask_id']?>" />
                <ul class="alt-tasks flyout">
                    <li class="general-overhead"><a href="#">General Overhead</a></li>
                    <li class="lunch"><a href="#">Lunch</a></li>
                    <li class="ooo"><a href="#">Out of Office</a></li>
                    <li class="vacation"><a href="#">Vacation</a></li>
                </ul>
            </div>
        </div>
        <div class="columns comment">
            <textarea placeholder="Comment" name="data[comment]"><?php echo $entry['Entry']['comment']?></textarea>
        </div>
    </div>
</div>
<?php endforeach?>

<div style="clear:both"></div>
<button type="button" id="TestButton">(Test) Aggregate list</button>
<script type="text/javascript">
    $('#TestButton').click(function(){
        $.ajax({
            url: '/entries/ajaxAggregateList',
            data: {},
            success: function(){

            }
        });
    });
</script>