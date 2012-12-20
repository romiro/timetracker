<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/20/12
 * Time: 9:15 AM
 *
 */
class Entry extends AppModel
{
    public $belongsTo = array('Task');
}
