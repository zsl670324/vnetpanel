<?php

return [
    // 用户、商品之类的等级映射表
    'level_map'        => [
        0 => '普通',
        1 => 'VIP1',
        2 => 'VIP2',
        3 => 'VIP3',
        4 => 'VIP4',
        5 => 'VIP5',
        6 => 'VIP6',
        7 => 'VIP7',
        8 => 'VIP8',
        9 => 'VIP9',
    ],

    // 管理员分销等级映射表
    'master_level_map' => [
        1 => '一级分销商',
        2 => '二级分销商',
        3 => '三级分销商',
    ],

    // 支付网关
    'payment_gateway'  => [
        'CreditPay' => '余额支付',
        'CodePay'   => '码支付',
        'EPay'      => '易支付',
        'F2FPay'    => '支付宝当面付',
        'MugglePay' => '麻瓜宝',
        'PayJs'     => 'PayJs',
        'ShengKai'  => '盛凯小微支付',
    ],

    // 支付方式
    'payment_method'   => [
        0  => '余额支付',
        1  => '支付宝',
        2  => '微信',
        3  => '财付通',
        4  => 'QQ钱包',
        5  => '京东支付',
        6  => '云闪付',
        7  => '翼支付',
        8  => 'PayPal',
        9  => 'ApplePay',
        10 => 'BTC',
        11 => 'ETH',
        12 => 'EOS',
        13 => 'LTC',
        14 => 'BCH',
    ],

    // 支付循环
    'payment_cycle'    => [
        'monthly'    => '月付',
        'quarterly'  => '季付',
        'semiannual' => '半年付',
        'annual'     => '年付',
        'biennial'   => '两年付',
        'triennial'  => '三年付',
    ],

    // 限速值，单位Byte
    'speed_limit'      => [
        '0'         => formatNetSpeed(0),
        '131072'    => formatNetSpeed(131072),
        '655360'    => formatNetSpeed(655360),
        '1310720'   => formatNetSpeed(1310720),
        '1966080'   => formatNetSpeed(1966080),
        '2621440'   => formatNetSpeed(2621440),
        '3932160'   => formatNetSpeed(3932160),
        '6553600'   => formatNetSpeed(6553600),
        '10485760'  => formatNetSpeed(10485760),
        '13107200'  => formatNetSpeed(13107200),
        '19660800'  => formatNetSpeed(19660800),
        '26214400'  => formatNetSpeed(26214400),
        '39321600'  => formatNetSpeed(39321600),
        '65536000'  => formatNetSpeed(65536000),
        '134217728' => formatNetSpeed(134217728),
    ]
];
