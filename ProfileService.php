<?php
/**
 *   class ProfileService, provide getsites method of profile service
 * @author Baidu Holmes
 */
require_once('DataApiConnection.class.php');

class ProfileService {
    public function getsites($ucid, $st) {
        print("----------------------getsites----------------------\r\n");
        $apiConnection = new DataApiConnection();
        $apiConnection->init(API_URL, $ucid);

        $apiConnectionData = array(
            'header' => array(
                'username' => USERNAME,
                'password' => $st,
                'token' => TOKEN,
                'account_type' => ACCOUNT_TYPE,
            ),
            'body' => array(
                'serviceName' => 'profile',
                'methodName' => 'getsites',
            ),
        );
        $apiConnection->POST($apiConnectionData);
        return array('retHead' => $apiConnection->retHead, 'retBody' => $apiConnection->retBody);
    }

    public function get_trans_info($ucid, $st, $parameterJSON) {
        print("----------------------get_trans_info----------------------\r\n");
        $apiConnection = new DataApiConnection();
        $apiConnection->init(API_URL, $ucid);

        $apiConnectionData = array(
            'header' => array(
                'username' => USERNAME,
                'password' => $st,
                'token' => TOKEN,
                'account_type' => ACCOUNT_TYPE,
            ),
            'body' => array(
                'serviceName' => 'profile',
                'methodName' => 'get_trans_info',
                'parameterJSON' => $parameterJSON,
            ),
        );
        $apiConnection->POST($apiConnectionData);
        return array('retHead' => $apiConnection->retHead, 'retBody' => $apiConnection->retBody);
    }
}


