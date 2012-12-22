<section class="main current" id="Config">
    <form method="POST" action="/config/save">
        <?php foreach($config as $setting):?>
        <div class="config-row">
            <dl>
                <dt class="name"><?php echo $setting['Config']['name']?></dt>
                <dd class="value">
                    <input type="text" name="data[<?php echo $setting['Config']['id']?>]" value="<?php echo $setting['Config']['value']?>" />
                </dd>

            </dl>
        </div>
        <?php endforeach?>

        <div class="button-bar config-buttons">
            <button class="button">Save All Settings</button>
        </div>
    </form>
</section>
