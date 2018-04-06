## Hacken API

@author XZFFF

注：前缀为 http://localhost/hacken/hacken/public/index.php/index/



#### 注册

> POST login/register

| 参数     | 参数类型 | 备注      |
| -------- | -------- | --------- |
| username |          |           |
| password |          |           |
| realname |          |           |
| gender   | int      | 0-女 1-男 |

```json
{
    "errcode": "0",
    "errmsg": "Success",
    "data": 1
}
```





#### 登录

> POST login/islogin

| 参数     | 参数类型 | 备注 |
| -------- | -------- | ---- |
| username |          |      |
| password |          |      |

```json
{
    "errcode": "0",
    "errmsg": "Success",
    "data": {
        "id": 1,
        "realname": "谢泽丰",
        "gender": 1,
        "status": 0,
        "createtime": "2018-04-06 21:15:23"
    }
}
```



















































