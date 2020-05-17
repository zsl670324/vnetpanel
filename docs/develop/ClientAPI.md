## 通用客户端API

### 代码位置
- `app/Http/Controllers/Api/Client`


### 目录结构说明
- `app/Http/Controllers/Api/Client` 目录下按版本号进行划分，初版为v1

```
设计理由：方便接口定制或者版本化更新。

举例说明1：张三定制某客户端，其客户端有三个里程碑版本，可以按如下定义接口，以保证在发新版时不影响未更新版本的用户的正常使用。
第一版：app/Http/Controllers/Api/Zhangsan/v1
第二版：app/Http/Controllers/Api/Zhangsan/v2
第三版：app/Http/Controllers/Api/Zhangsan/v3


举例说明2：客户端程序加入新特性，可以按如下接口定义，同时上线运营。
第三版：app/Http/Controllers/Api/Client/v2
第三版：app/Http/Controllers/Api/Client/v3
```


### 公共头部
- 使用 `Laravel-JWT` 组件进行安全验证
- 登陆验证通过后取得系统下发的 `令牌`，所有登陆后的操作每次请求都需要在头部传入该 `令牌`，用于身份校验


-------------------


#### 登陆
- 请求地址：`/api/client/v1/login`
- 请求方式：`POST`
- 传入参数：

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 用户名 | username | string |
| 密码 | password | string |
| 验证码 | captcha | string |

----

#### 退出
- 请求地址：`/api/client/v1/logout`
- 请求方式：`POST`
- 传入参数：无


----

#### 刷新令牌
- 请求地址：`/api/client/v1/refresh`
- 请求方式：`POST`
- 传入参数：无

----

#### 获取已登陆当前用户信息
- 请求地址：`/api/client/v1/me`
- 请求方式：`POST`
- 传入参数：无

----

#### 注册
- 请求地址：`/api/client/v1/register`
- 请求方式：`POST`
- 传入参数：

| 名称 | 字段 | 类型 |
| :---: | :---: | :---: |
| 用户名 | username | string |
| 密码 | password | string |
| 验证码 | captcha | string |

#### 获取验证码
- 请求地址：`/api/client/v1/captcha`
- 请求方式：`POST`
- 传入参数：无
