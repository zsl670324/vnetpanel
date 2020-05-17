## VNET开放接口
- 作者：[徐常曦](https://t.me/xuchangxi)
- 简介：基于Go语言开发的支持Shadowsocks、ShadowsocksR特性的一个代理程序

支持ShadowsocksR协议：
- origin
- auth_aes128_md5
- auth_aes128_sha1
- auth_chain_a


支持ShadowsocksR混淆：
- plain
- http_simple
- tls1.2_ticket_auth


支持的加密方式：
- bf-cfb
- chacha20
- chacha20-ietf
- aes-128-cfb
- aes-192-cfb
- aes-256-cfb
- aes-128-ctr
- aes-192-ctr
- aes-256-ctr
- cast5-cfb
- des-cfb
- rc4-md5
- salsa20

支持的加密方式：
- bf-cfb
- chacha20
- chacha20-ietf
- aes-128-cfb
- aes-192-cfb
- aes-256-cfb
- aes-128-ctr
- aes-192-ctr
- aes-256-ctr
- cast5-cfb
- des-cfb
- rc4-md5
- salsa20
- aes-128-gcm
- aes-192-gcm
- aes-256-gcm
- chacha20-ietf-poly1305


## 启动程序

1.手动启动：`./vnet --api_host https://vnetpanel.com --key key --node_id 1`

2.通过加载配置文件启动：`./vnet --config /temp/vnet/config.json`

`config.json`配置示例：
```
{
    "api_host": "https://vnetpanel.com",
    "key": "key",
    "node_id": 1
}
```

## 注意
- 协议：用来做身份校验，多端口时不推荐使用任何协议，即仅用原协议：origin。
- 混淆：对数据包进行伪装。

## 后端行为
- 每60秒自动上报所有代理端口的连接IP信息
- 每60秒上报一次心跳信息

## 开放接口
- 请求格式：http://节点IP:端口/{API}

#### 添加用户
- 请求地址：`/api/user/add`
- 请求方式：`POST`
- 传入参数：JSON数据
``` JSON数据示例
{
    "uid": 571,
    "port": 5539,
    "passwd": "NCg2eh",
    "speed_limit": 10737418240
}
```

#### 删除用户
- 请求地址：`/api/user/del/{uid}`
- 请求方式：`POST`
- 传入参数：

| 字段 | 释义 | 参考值 | 
| :---: | :---: | :---: |
| uid | 用户ID | 321 |

#### 修改用户信息
- 请求地址：`/api/user/edit`
- 请求方式：`POST`
- 传入参数：JSON数据
``` JSON数据示例
{
    "uid": 571,
    "port": 5539,
    "passwd": "NCg2eh",
    "speed_limit": 10737418240
}
```


#### 获取用户列表
- 请求地址：`/api/user/list`
- 请求方式：`GET`
- 传入参数：

| 字段 | 释义 | 参考值 | 
| :---: | :---: | :---: |
| uid | 用户ID | 321 |
| port | 端口 | 10000 |


#### 批量增加用户
- 请求地址：`/api/v2/user/add/list`
- 请求方式：POST
- 传入参数：JSON数据
```
[
    {
        "uid": 571,
        "port": 5539,
        "passwd": "NCg2eh",
        "speed_limit": 10737418240
    },
    {
        "uid": 578,
        "port": 5589,
        "passwd": "NCop2eh",
        "speed_limit": 10737418240
    }
]
```

#### 批量删除用户
- 请求地址：`/api/v2/user/del/list`
- 请求方式：POST
- 传入参数：JSON数据
```
[4,5,6]
```

