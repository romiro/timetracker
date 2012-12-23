<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/23/12
 * Time: 11:52 AM
 * To change this template use File | Settings | File Templates.
 */
class AttaskComponent extends Component
{
    public $components = array('Session');
    /**
     * @var string
     */
    public $attaskHost = '';

    /**
     * @var Controller
     */
    public $Controller;

    private $_config = array();

    /**
     * @var Config
     */
    private $Config;

    public function initialize(Controller $controller)
    {
        parent::initialize($controller);
        $this->Controller = $controller;
    }

    public function login()
    {
        if (!$this->Session->check('attask.logged_in')) {
            App::uses('HttpSocket', 'Network/Http');
            $http = new HttpSocket();
            $attaskDomain = Configure::read('attask.domain');
            $attaskUser = Configure::read('attask.username');
            $attaskPassword = Configure::read('attask.password');
            $response = $http->get("https://$attaskDomain/attask/api/login", array('username'=>$attaskUser, 'password'=>$attaskPassword));

            $data = json_decode($response->body, true);
            if (isset($data['data'])) {
                $this->Session->write(array(
                    'attask.logged_in' => true,
                    'attask.sessionID' => $data['data']['sessionID'],
                    'attask.userID' => $data['data']['userID']
                ));
            }
            else {
                $this->Controller->setError('Unable to authenticate with Attask. Check your settings in app/Config/attask_config.php');
            }
        }
    }
}
