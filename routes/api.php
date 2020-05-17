<?php

// VNet后端WEBAPI V1版
Route::group(['namespace' => 'Api\VNet', 'middleware' => ['webapi'], 'prefix' => 'web/v1'], function () {
    Route::get('node/{id}', 'V1Controller@getNodeInfo'); // 获取节点信息
    Route::post('nodeStatus/{id}', 'V1Controller@setNodeStatus'); // 上报节点心跳信息
    Route::post('nodeOnline/{id}', 'V1Controller@setNodeOnline'); // 上报节点在线人数
    Route::get('userList/{id}', 'V1Controller@getUserList'); // 获取节点可用的用户列表
    Route::post('userTraffic/{id}', 'V1Controller@setUserTraffic'); // 上报用户流量日志
    Route::get('nodeRule/{id}', 'V1Controller@getNodeRule'); // 获取节点的审计规则
    Route::post('trigger/{id}', 'V1Controller@addRuleLog'); // 上报用户触发的审计规则记录
});

// VNet后端WEBAPI V2版
Route::group(['namespace' => 'Api\VNet', 'middleware' => ['webapi'], 'prefix' => 'vnet/v2'], function () {
    Route::get('node/{id}', 'V1Controller@getNodeInfo'); // 获取节点信息
    Route::post('nodeStatus/{id}', 'V1Controller@setNodeStatus'); // 上报节点心跳信息
    Route::post('nodeOnline/{id}', 'V1Controller@setNodeOnline'); // 上报节点在线人数
    Route::get('userList/{id}', 'V1Controller@getUserList'); // 获取节点可用的用户列表
    Route::post('userTraffic/{id}', 'V1Controller@setUserTraffic'); // 上报用户流量日志
    Route::get('nodeRule/{id}', 'V1Controller@getNodeRule'); // 获取节点的审计规则
    Route::post('trigger/{id}', 'V1Controller@addRuleLog'); // 上报用户触发的审计规则记录
});

// V2Ray后端WEBAPI V1版
Route::group(['namespace' => 'Api\V2Ray', 'middleware' => ['webapi'], 'prefix' => 'v2ray/v1'], function () {
    Route::get('node/{id}', 'V1Controller@getNodeInfo'); // 获取节点信息
    Route::post('nodeStatus/{id}', 'V1Controller@setNodeStatus'); // 上报节点心跳信息
    Route::post('nodeOnline/{id}', 'V1Controller@setNodeOnline'); // 上报节点在线人数
    Route::get('userList/{id}', 'V1Controller@getUserList'); // 获取节点可用的用户列表
    Route::post('userTraffic/{id}', 'V1Controller@setUserTraffic'); // 上报用户流量日志
    Route::get('nodeRule/{id}', 'V1Controller@getNodeRule'); // 获取节点的审计规则
    Route::post('trigger/{id}', 'V1Controller@addRuleLog'); // 上报用户触发的审计规则记录
    Route::post('certificate/{id}', 'V1Controller@addCertificate'); // 上报节点伪装域名证书信息
});

// Trojan后端WEBAPI V1版
Route::group(['namespace' => 'Api\Trojan', 'middleware' => ['webapi'], 'prefix' => 'trojan/v1'], function () {
    Route::get('node/{id}', 'V1Controller@getNodeInfo'); // 获取节点信息
    Route::post('nodeStatus/{id}', 'V1Controller@setNodeStatus'); // 上报节点心跳信息
    Route::post('nodeOnline/{id}', 'V1Controller@setNodeOnline'); // 上报节点在线人数
    Route::get('userList/{id}', 'V1Controller@getUserList'); // 获取节点可用的用户列表
    Route::post('userTraffic/{id}', 'V1Controller@setUserTraffic'); // 上报用户流量日志
    Route::get('nodeRule/{id}', 'V1Controller@getNodeRule'); // 获取节点的审计规则
    Route::post('trigger/{id}', 'V1Controller@addRuleLog'); // 上报用户触发的审计规则记录
});


// 客户端API
Route::group(['namespace' => 'Api\Client', 'prefix' => 'client/v1'], function () {
    Route::get('login', 'V1Controller@login');
    Route::get('logout', 'V1Controller@logout');
    Route::get('refresh', 'V1Controller@refresh');
    Route::get('me', 'V1Controller@me');
    Route::get('register', 'V1Controller@register');
    Route::post('resetPassword', 'V1Controller@resetPassword');
});
