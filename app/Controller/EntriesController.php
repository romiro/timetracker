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

    /**
     * Action to update all fields for a single time entry
     */
    public function ajaxUpdateAll()
    {
        $this->layout = 'ajax';
        $data = $this->request->data;
        $entry = array('Entry'=>array());
        //If an id is passed, Entry already exists, otherwise will create a new record
        if (!empty($data['id'])) {
            $entry['Entry']['id'] = $data['id'];
        }

        $entry['Entry']['comment'] = $data['comment'];
        $entry['Entry']['start_time'] = $data['start_time'];
        $entry['Entry']['end_time'] = $data['end_time'];
        $entry['Entry']['day'] = date('Y-m-d', strtotime($data['day']));

        $this->Entry->save($entry);
    }

    /**
     * Update single field of an entry via Ajax
     * (possibly will not be used)
     */
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
        $this->set('day', date('l, F jS, Y'));
    }
}
