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
    private $domain = '';

    private $username = '';

    private $password = '';

    private $apiUrl = '';

    /**
     * @var Controller
     */
    public $Controller;


    public function initialize(Controller $controller)
    {
        parent::initialize($controller);
        $this->Controller = $controller;

        App::uses('HttpSocket', 'Network/Http');

        $this->domain = Configure::read('attask.domain');
        $this->username = Configure::read('attask.username');
        $this->password = Configure::read('attask.password');
        $this->apiUrl = "https://$this->domain/attask/api";
    }

    public function login()
    {
        if (!$this->Session->check('attask.logged_in')) {
            //TODO: refactor into callApi
            $http = new HttpSocket();
            $response = $http->get("$this->apiUrl/login", array(
                'username'=>$this->username,
                'password'=>$this->password));

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

    public function findTaskByRef($ref)
    {
        if (!$this->Session->check('attask.logged_in')) return false;
        $http = new HttpSocket();
        $result = $this->callApi('task/search', array('referenceNumber'=>$ref));
        return $result;
    }

    private function callApi($action, $params)
    {
        $http = new HttpSocket();
        $headers = array('SessionID'=>$this->Session->read('attask.sessionID'));
        $response = $http->get(sprintf("%s/%s", $this->apiUrl, $action), $params, array('header'=>$headers));
        if ($response->code != '200') {
            $this->Controller->setError(sprintf('Error from Attask API method with ACTION: %s and PARAMS: %s', $action, http_build_query($params)));
            return false;
        }
        return json_decode($response->body, true);
    }
}
