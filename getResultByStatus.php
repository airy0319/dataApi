<?php
/**
 * 根据报告id再次获取报告
 */
require_once('ProfileService.php');
require_once('LoginService.php');
require_once('ReportService.php');
require_once('Config.php');

//实例化登陆对象
$loginService = new LoginService();

//preLogin登陆检查
if (!$loginService->PreLogin()) {
    echo "preLogin Fail";
    exit();
}


//doLogin
$ret = $loginService->DoLogin();
if ($ret) {
    $ucid = $ret['ucid'];
    $st = $ret['st'];
} else {
    echo "doLogin Fail";
    exit();
}

var_dump($ucid);
var_dump($st);

$report = new ReportService();

//这里填写你的报告id, 可以再次调用getStatus方法, 得到所需要的报告下载链接
//如果状态为2, 那么表示没有数据
$result_id = "";
$parameter = array('result_id' => $result_id);

$ret = $report->getstatus($ucid, $st, json_encode($parameter));

$retHead = $ret['retHead'];
$retBody = $ret['retBody'];

if (!$retHead || !$retBody) {
    echo "getStatus error";
    exit();
}

$retHeadArray = json_decode($retHead, TRUE);
$retBodyArray = json_decode($retBody, TRUE);

$statusInfo = json_decode($retBodyArray['responseData'], TRUE);

if (isset($statusInfo['result']['status'])) {
    $resultStatus = $statusInfo['result']['status'];
} else {
    echo "statusResult error";
    exit();
}


/* 
*   if resultStatus === 2, you can call getstatus again after sleeping for
*    a while, that will not be implemented in this Demo.
*/
if ($resultStatus === 3 && isset($statusInfo['result']['result_url'])) {
    print("[notice] result_url: " . $statusInfo['result']['result_url'] . "\r\n");
} else if ($resultStatus === 1) {
    print("[notice] Result is generating. Please retry later.\r\n");
} else if ($resultStatus === 2) {
    print("[notice] No data generated. Please check your Query_Parament in Config.php.\r\n");
} else {
    echo "status==2 error";
    exit();
}

//doLogout, please doLogout after call DataApi services

if (isset($ret['ucid']) && isset($ret['st'])) {
    $loginService->DoLogout($ucid, $st);
}