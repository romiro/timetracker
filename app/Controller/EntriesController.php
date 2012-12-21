<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/20/12
 * Time: 9:21 AM
 *
 */
class EntriesController extends AppController
{
    public $uses = array('Task', 'Entry');

    public function index()
    {
        $todayAtMidnight = date(MYSQL_DATE_FORMAT, strtotime(date('Y-m-d')));

        $entries = $this->Entry->find('all', array(
            'conditions' => array(
                'start_time > ?' => $todayAtMidnight),
            'order' => 'start_time asc'));

        $this->set('entries', $entries);
    }

    public function ajaxUpdate()
    {
        $id = $this->request->data['id'];
        $field = $this->request->data['field'];
        $value = $this->request->data['value'];


        $this->Entry->save(array(
            'Entry' => array(
                'id' => $id,
                $field => $value
            )
        ));
        $this->render('ajax');
    }

    public function ajaxTodayEntries()
    {
        $this->layout = 'ajax';
        $todayAtMidnight = date(MYSQL_DATE_FORMAT, strtotime(date('Y-m-d')));

        $entries = $this->Entry->find('all', array(
            'conditions' => array(
//                'start_time > ?' => $todayAtMidnight
            ),
            'order' => 'start_time asc'));

        $this->set('entries', $entries);
        $this->set('today', date('l, F jS, Y'));
    }
}
