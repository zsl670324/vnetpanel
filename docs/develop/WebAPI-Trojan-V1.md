## V2Ray后端程序通信API

#### 代码位置
`app/Http/Controllers/Api/Trojan`

#### 目录结构说明


#### 公共头部
- 节点API安全验证由 `app/Http/Middleware/Webapi.php` 中间件处理
- 校验规则：节点机在所有请求的`头部`传入`key`、`timestamp`
- `key`：string 由管理后台创建应用取得
- `timestamp`：int(10) 每次请求的10位时间戳

## 注意
- 节点服务器和面板所在服务器时间误差不应该超过5分钟，否则API授权验证失败
- 节点上的用户认证应该统一取节点设置的信息，而不应该取用户个人的配置信息，用户的个人配置信息仅用于适配DB版本

#### 获取节点信息
- 注意：启动和重载时
- 请求地址：`/api/trojan/v1/node/{节点ID}`
- 请求方式：`GET`
- 传入参数：无
- 返回结果：
```
失败：
{
    "status": "fail",
    "code": 404,
    "data": "",
    "message": "授权与节点不匹配"
}

{
    "status": "fail",
    "code": 404,
    "data": "",
    "message": "节点不存在"
}

成功：
{
    "status": "success",
    "code": 200,
    "data": {
        "id": 2,
        "is_udp": true,
        "speed_limit": 6555555,
        "client_limit": 1,
        "push_port": 8081,
        "trojan_port": 443,
        "secret": "tdcpxpip",
        "license": "234234"
    },
    "message": "获取节点信息成功"
}
```


----

#### 上报节点心跳信息
- 注意：每分钟
- 请求地址：`/api/trojan/v1/nodeStatus/{节点ID}`
- 请求方式：`POST`
- 传入参数：JSON数据

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| cpu负载 | cpu | string |
| 内存负载 | mem | string |
| 网络负载 | net | string |
| 磁盘情况 | disk | string |
| 后端存活时长（单位：秒） | uptime | int |

示例：
```
{"cpu":"2%","mem":"36%","net":"1.5 GB\u2191-38 GB\u2193","disk":"4%","uptime":89582}
 
```

- 返回结果：
```
失败：
{
    "status": "fail",
    "code": 400,
    "data": "",
    "message": "上报节点心跳信息失败，请检查字段"
}

成功：
{
    "status": "success",
    "code": 200,
    "data": "",
    "message": "上报节点心跳信息成功"
}
```

----

#### 上报节点在线情况
- 注意：每分钟
- 请求地址：`/api/trojan/v1/nodeOnline/{节点ID}`
- 请求方式：`POST`
- 传入参数：JSON数据

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 用户ID | uid | int |
| 在线ip | ip | string |

示例：
```
[{"uid":14,"ip":"111.203.198.58,223.104.3.237,223.104.3.245"},{"uid":1,"ip":"117.30.139.216"}]
```

- 返回结果：
```
失败：
{
    "status": "fail",
    "code": 400,
    "data": "",
    "message": "上报节点在线情况失败，请检查字段"
}

成功：
{
    "status": "success",
    "code": 200,
    "data": "",
    "message": "上报节点在线情况成功"
}
```

----

#### 获取用户列表
- 注意：启动和重载时
- 请求地址：`/api/trojan/v1/userList/{节点ID}`
- 请求方式：`GET`
- 传入参数：

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 请求时间戳 | updateTime | unix time, 10位 |

- 返回结果：
```
{
    "status": "success",
    "code": 200,
    "data": [
        {
            "uid": 1,
            "password": "1727ed1f78d0675a5cc8a9a002fdf1a4",
            "speed_limit": 134217728
        },
        {
            "uid": 2,
            "password": "d86a54d100a33677f35691df194adf35",
            "speed_limit": 131072
        },
        {
            "uid": 3,
            "password": "022280d6ccfd8695ee2d3227c4cbd409",
            "speed_limit": 262144
        },
        {
            "uid": 7,
            "password": "56e5c9eee725ff605a2eff519e4adef9",
            "speed_limit": 2621440
        }
    ],
    "message": "获取用户列表成功",
    "updateTime": 1565172630
}
```

----

#### 上报用户流量日志
- 注意：每分钟
- 请求地址：`/api/trojan/v1/userTraffic/{节点ID}`
- 请求方式：`POST`
- 传入参数：JSON数据

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 用户ID | uid | int |
| 上传 | upload | int |
| 下载 | download | int |

示例：
```
[{"uid":14,"upload":52197,"download":3381985},{"uid":15,"upload":52166,"download":3389995}]
```

- 返回结果：
```
失败：
{
    "status": "fail",
    "code": 400,
    "data": "",
    "message": "上报用户流量日志失败，请检查字段"
}

成功：
{
    "status": "success",
    "code": 200,
    "data": "",
    "message": "上报用户流量日志成功"
}
```

----

#### 获取节点的审计规则
- 注意：启动和重载时
- 请求地址：`/api/trojan/v1/nodeRule/{节点ID}`
- 请求方式：`GET`
- 传入参数：无
- 返回结果：
```
第一种：mode为all时，表示节点未设置任何审计规则，全部放行
{
    "status": "success",
    "code": 200,
    "data": {
        "mode": "all",
        "rules": []
    },
    "message": "获取节点审计规则成功"
}

第二种：mode为reject时，表示节点设置了阻断规则，凡是匹配到阻断规则的请求都要拦截
{
    "status": "success",
    "code": 200,
    "data": {
        "mode": "reject",
        "rules": [
            {
                "id": 2, // 审计规则ID，用户触发审计规则时需要上报该ID
                "type": "reg", // 审计规则类型：reg-正则表达式、domain-域名、ip-IP、protocol-应用层协议（HTTP协议、FTP协议、TELNET协议、SFTP协议、BitTorrent协议、POP3协议、IMAP协议、SMTP协议、PPTP协议、L2TP协议）
                "pattern": "(Subject|HELO|SMTP)" // 审计规则的值
            },
            {
                "id": 3,
                "type": "reg",
                "pattern": "BitTorrent protocol"
            },
            {
                "id": 4,
                "type": "reg",
                "pattern": "(api|ps|sv|offnavi|newvector|ulog\\.imap|newloc)(\\.map|)\\.(baidu|n\\.shifen)\\.com"
            },
            {
                "id": 5,
                "type": "reg",
                "pattern": "(.*\\.||)(dafahao|minghui|dongtaiwang|epochtimes|ntdtv|falundafa|wujieliulan|zhengjian)\\.(org|com|net)"
            },
            {
                "id": 7,
                "type": "reg",
                "pattern": "(^.*\\@)(guerrillamail|guerrillamailblock|sharklasers|grr|pokemail|spam4|bccto|chacuo|027168)\\.(info|biz|com|de|net|org|me|la)"
            }
        ]
    },
    "message": "获取节点审计规则成功"
}

第三种：mode为allow时，表示节点设置了仅放行的白名单，凡是非白名单内的全部拦截，仅放行匹配了白名单规则的
{
    "status": "success",
    "code": 200,
    "data": {
        "mode": "allow",
        "rules": [
            {
                "id": 3,
                "type": "reg",
                "pattern": "BitTorrent protocol"
            },
            {
                "id": 6,
                "type": "reg",
                "pattern": "(torrent|\\.torrent|peer_id=|info_hash|get_peers|find_node|BitTorrent|announce_peer|announce\\.php\\?passkey=)"
            },
            {
                "id": 9,
                "type": "domain",
                "pattern": "pornhub.com"
            },
            {
                "id": 10,
                "type": "ip",
                "pattern": "192.168.2.2"
            },
            {
                "id": 12,
                "type": "reg",
                "pattern": "234"
            }
        ]
    },
    "message": "获取节点审计规则成功"
}
```

----

#### 上报用户触发的审计规则记录
- 注意：用户触发则实时上报，后端需要过滤用户在5或者10分钟内的重复访问（例：10分钟内反复出发仅上报一次）
- 请求地址：`/api/trojan/v1/trigger/{节点ID}`
- 请求方式：`POST`
- 传入参数：JSON数据

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 用户ID | uid | int |
| 规则ID | rule_id | int |
| 触发原因 | reason | string |

```
{"uid":12,"rule_id":2,"reason":"https:\/\/sex.com\/images\/xx.png"}
```

- 返回结果：
```
失败：
{
    "status": "fail",
    "code": 400,
    "data": "",
    "message": "上报用户触发审计规则记录失败"
}

成功：
{
    "status": "success",
    "code": 200,
    "data": "",
    "message": "上报用户触发审计规则记录成功"
}
```
