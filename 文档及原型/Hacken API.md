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



#### 修改用户个人信息

> POST user/edituserinfo

| 参数   | 参数类型 | 备注     |
| ------ | -------- | -------- |
| role   |          |          |
| tel    |          |          |
| qq     |          |          |
| wechat |          |          |
| skill1 |          |          |
| skill2 |          |          |
| skill3 |          |          |
| skill4 |          |          |
| skill5 |          |          |
| skill6 |          |          |
| resume |          | 个人简介 |

```json
{
    "errcode": "0",
    "errmsg": "Success",
    "data": 1
}
```











#### 获取用户个人信息

> GET user/getuserinfo

```json
{
    "errcode": "0",
    "errmsg": "Success",
    "data": {
        "id": 1,
        "username": "xzfff",
        "password": "202cb962ac59075b964b07152d234b70",
        "realname": "谢泽丰",
        "gender": 1,
        "role": "",
        "tel": null,
        "qq": null,
        "wechat": null,
        "status": 0,
        "skill1": null,
        "skill2": null,
        "skill3": null,
        "skill4": null,
        "skill5": null,
        "skill6": null,
        "resume": "",
        "createtime": "2018-04-06 21:15:23",
        "idea": {
            "id": 1,
            "uid": 1,
            "title": "Hacken",
            "summary": "一款帮助Hackathon参赛选手优质化快速化组队的Web产品",
            "need": "前端*1 熟悉前端开发",
            "user1": 1,
            "user2": null,
            "user3": null,
            "user4": null,
            "user5": null,
            "user6": null,
            "status": 0,
            "createtime": "2018-04-06 22:42:49"
        }
    }
}
```











#### 创建新idea

> POST idea/createidea

| 参数    | 参数类型 | 备注       |
| ------- | -------- | ---------- |
| title   |          | idea标题   |
| summary |          | 项目简介   |
| need    |          | 需要的人员 |

```json
{
    "errcode": "0",
    "errmsg": "Success",
    "data": 1
}
```















































