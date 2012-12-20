<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/20/12
 * Time: 4:44 PM
 * To change this template use File | Settings | File Templates.
 */
class TasksController extends AppController
{
    public $uses = array('Task', 'Entry');

}
