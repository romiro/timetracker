<li class="has-dropdown" id="DatePicker">
    <a href="#">Thu Dec 20 2012</a>
    <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">Item 2</a></h5></li>
        <li><label>Last 7 Days</label></li>
        <?php foreach($this->App->getLastDays() as $day):?>
            <li class="date"><a href="#"><?php echo $day ?></a></li>
        <?php endforeach?>
        <li class="divider"></li>
        <li><a href="#">See all →</a></li>
    </ul>
</li>