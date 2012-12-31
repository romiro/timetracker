<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/23/12
 * Time: 4:57 PM
 * To change this template use File | Settings | File Templates.
 */
class Attask
{
    private $domain = '';

    private $username = '';

    private $password = '';

    private $apiUrl = '';

    /**
     * @var string sessionID returned by Attask login
     */
    private $sessionID = '';

    /**
     * @var string userID returned by Attask login
     */
    private $userID = '';

    public function __construct($sessionID = null)
    {
        App::uses('HttpSocket', 'Network/Http');

        $this->domain = Configure::read('attask.domain');
        $this->username = Configure::read('attask.username');
        $this->password = Configure::read('attask.password');
        $this->apiUrl = "https://$this->domain/attask/api";

        if (!empty($sessionID)) {
            $this->sessionID = $sessionID;
        }
    }

    /**
     * @return array containing both sessionID and userID as keys
     * @throws Exception
     */
    public function login($username = null, $password = null)
    {
        if (empty($username)) {
            $username = $this->username;
        }
        if (empty($password)) {
            $password = $this->password;
        }
        //Must send API call outside of $this->callApi as there has been no SessionID set
        $http = new HttpSocket();
        $response = $http->get(sprintf("%s/%s", $this->apiUrl, 'login'), array('username'=>$username,'password'=>$password));

        if ($response->code != '200') {
            throw new Exception(sprintf('Error from Attask API method with ACTION: %s and PARAMS: %s', $action, http_build_query($params)));
        }
        $result = json_decode($response->body, true);
        if (isset($result['data'])) {
            $this->sessionID = $result['data']['sessionID'];
            $this->userID = $result['data']['userID'];
            return array(
                'sessionID' => $result['data']['sessionID'],
                'userID' => $result['data']['userID']
            );
        }
        else {
            throw new Exception('Unable to authenticate with Attask. Check your settings in app/Config/attask_config.php');
        }
    }

    public function findTaskByRef($ref)
    {
        $result = $this->callApi('task/search', array('referenceNumber'=>$ref));
        return $result;
    }

    private function callApi($action, $params, $sessionID = null)
    {
        if (empty($sessionID) && !empty($this->sessionID)) {
            $sessionID = $this->sessionID;
        }
        else {
            throw new Exception('Attempt to access Attask API with no sessionID set');
        }
        $http = new HttpSocket();
        $headers = array('SessionID'=>$sessionID);
        $response = $http->get(sprintf("%s/%s", $this->apiUrl, $action), $params, array('header'=>$headers));
        if ($response->code != '200') {
            throw new Exception(sprintf('Error from Attask API method with ACTION: %s and PARAMS: %s', $action, http_build_query($params)));
        }
        return json_decode($response->body, true);
    }
}
