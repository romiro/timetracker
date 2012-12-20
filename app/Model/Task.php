<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/20/12
 * Time: 9:14 AM
 *
 */
class Task extends AppModel
{
    public $hasMany = array('Entry');
}
