<?php
/**
 *   Demo of DataApi
 *
 *       set your information such as USERNAME, PASSWORD ... before use
 *
 * @author Baidu Holmes
 */
require_once('ProfileService.php');
require_once('LoginService.php');
require_once('ReportService.php');

//preLogin,doLogin URL
//预登陆api接口(不需要改动)
define('LOGIN_URL', 'https://api.baidu.com/sem/common/HolmesLoginService');

//DataApi URL
//数据请求api接口地址(不需要改动)
define('API_URL', 'https://api.baidu.com/json/tongji/v1/ProductService/api');

//USERNAME
//百度统计用户名(自行填写)
define('USERNAME', 'xxxxxx');

//PASSWORD
//百度统计密码(自行填写)
define('PASSWORD', 'xxxxxx');

//TOKEN
//从http://dev2.baidu.com/登陆获取的权限代码, 用来做token(自行填写)
define('TOKEN', '222c2cef2222222b8b22222dc22c2eae');

//UUID, used to identify your device, for instance: MAC address
//网卡物理地址(自行填写)
define('UUID', 'F6-31-E6-73-70-CE');

//ACCOUNT_TYPE
//账户类型, 按需修改
define('ACCOUNT_TYPE', 1);

//以上配置好了之后, php DataApiDemo.php可以得到ucid和st这两个用户信息

//下面这个配置是query查询参数配置,配置正确可以得到报告汇总数据(不提供明细查询)
//Parameter for query API
//查询参数
$Query_Parameter = array(
    //reportid必填 取值范围：1  受访页面报告
    'reportid' => 1,
    //metrics必填,取值范围:pageviews:浏览量（PV）,visitors:访客数（UV）,ips:IP数,entrances:入口页次数,outwards:贡献下游流量,exits:退出页次数,stayTime:平均停留时长,exitRate:退出率
    'metrics' => array('pageviews', 'visitors', 'ips', 'entrances', 'stayTime', 'exitRate'),
    //选填，默认pageid,取值范围：,pageid
    'dimensions' => array('pageid'),
    //start_time必填,格式为YYYYmmddHHiiss，例如：20160415000000,不大于当前时间
    'start_time' => '20160415000000',
    //end_time必填,格式为YYYYmmddHHiiss，例如：20160516235959,不大于当前时间,不小于start_time,end_time与start_time间隔不超过一年
    'end_time' => '20160516235959',
    //filters选填,fromType:,1 直达,2 搜索引擎,3 外部链接,newVisitor:,1 新访客,2 老访客
    'filters' => array('fromType=2', 'newVisitor=2'),
    //start_index开始游标,必填，≥0
    'start_index' => 0,
    //max_results最大返回记录数,必填,取值范围[0, 10000]
    'max_results' => 1000,
    //sort选填,排序的指标必须在查询的指标中,排序方式可以是,asc 正序（默认值）,desc 逆序,排序指标可填多个（最多3个），优先级由高到低
    'sort' => array('pageviews desc'),
);
//Set siteid by yourself
//根据getsites方法返回账号下管理的站点、子目录信息里面的siteid(即你要查询哪个域名的id)
$Query_Parameter['siteid'] = '6666666';

//以下没有测试
//Parameter for query_trans API
//$Query_Trans_Parameter = array(
//    'metrics' => array('transformNum'),
//    'dimensions' => array('targetid'),
//    'start_time' => '20160515000000',
//    'end_time' => '20160516235959',
//    'filters' => array(),
//    'start_index' => 0,
//    'max_results' => 10,
//    'sort' => array('transformNum desc'),
//    );
////Set siteid by yourself
////$Query_Trans_Parameter['siteid']='******';
//
////TRANS_NAME
//define('TRANS_NAME', '******');
//
////TRANS_URL
//define('TRANS_URL', '******');
//
////QUERY_TRANS_TYPE, 'name' or 'url'
//define('QUERY_TRANS_TYPE', 'name');
