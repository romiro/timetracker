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
    }

    public function ajaxUpdateAll()
    {
        $this->layout = 'ajax';
        $data = $this->request->data;
        $entry = array('Entry'=>array());
        if (!empty($data['id'])) {
            $entry['Entry']['id'] = $data['id'];
        }

        $today = $data['today_date'];

        $startTime = strtotime($data['start_time']);
        $endTime = strtotime($data['end_time']);
        if ($startTime > $endTime) {
            $startTime = $startTime + (12 * 60 * 60);
        }

        $entry['Entry']['start_date'] = date(MYSQL_DATE_FORMAT, strtotime($today . " " . $data['start_time']));
        $entry['Entry']['end_date'] = date(MYSQL_DATE_FORMAT, strtotime($today . " " . $data['end_time']));

    }

    public function ajaxUpdateField()
    {
        $this->layout = 'ajax';
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

        $entries = $this->Entry->find('all', array(
            'conditions' => array(
//                'start_time > ?' => $todayAtMidnight
            ),
            'order' => 'Task.id asc'));

        $this->set('entries', $entries);
        $this->set('today', date('l, F jS, Y'));
    }
}
