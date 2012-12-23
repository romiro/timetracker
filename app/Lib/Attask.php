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
    private static $domain = '';

    private static $username = '';

    private static $password = '';

    private static $apiUrl = '';

    public function __construct()
    {
        App::uses('HttpSocket', 'Network/Http');

        self::$domain = Configure::read('attask.domain');
        self::$username = Configure::read('attask.username');
        self::$password = Configure::read('attask.password');
        self::$apiUrl = "https://$this->domain/attask/api";
    }

    /**
     * @return array containing both sessionID and userID as keys
     * @throws Exception
     */
    public function login()
    {
        $result = $this->callApi('login', array('username'=>self::$username,'password'=>self::$password));

        if (isset($result['data'])) {
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

    private function callApi($action, $params)
    {
        $http = new HttpSocket();
        $headers = array('SessionID'=>$this->Session->read('attask.sessionID'));
        $response = $http->get(sprintf("%s/%s", $this->apiUrl, $action), $params, array('header'=>$headers));
        if ($response->code != '200') {
            throw new Exception(sprintf('Error from Attask API method with ACTION: %s and PARAMS: %s', $action, http_build_query($params)));
        }
        return json_decode($response->body, true);
    }
}
