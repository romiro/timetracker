<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/22/12
 * Time: 1:37 PM
 *
 * @property      Config $Config
 */
class ConfigController extends AppController
{
    public function index()
    {
        exit('Phasing this out most likely. Hit back butan!');
        $config = $this->Config->find('all');

        $this->set('config', $config);
    }

    public function save()
    {
        $data = array();
        foreach($this->request->data as $id=>$value) {
            $data[]['Config'] = array('id'=>$id, 'value'=>$value);
        }
        $this->Session->setFlash('Configuration saved!');
        $this->redirect('/config');
    }
}
