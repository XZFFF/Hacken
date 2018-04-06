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



#### 获取用户个人信息（若用户点击“我的消息”则同步修改申请人的未读消息状态）

> GET user/getuserinfo

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": {
        "id": 1,
        "username": "xzfff",
        "password": "202cb962ac59075b964b07152d234b70",
        "realname": "谢泽丰",
        "gender": 1,
        "role": "后端开发",
        "tel": "123456",
        "qq": "567890",
        "wechat": null,
        "status": 1,
        "skill1": "PHP",
        "skill2": "MATLAB",
        "skill3": null,
        "skill4": null,
        "skill5": null,
        "skill6": null,
        "resume": null,
        "createtime": "2018-04-06 21:15:23",
        "idea": {
            "id": 2,
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
            "createtime": "2018-04-07 02:03:15"
        },
        "news": [
            {
                "id": 1,
                "uid": 2,
                "iid": 2,
                "iuid": 1,
                "status": 0,
                "createtime": "2018-04-07 02:08:10"
            }
        ]
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



#### 修改idea信息

> POST idea/editidea

| 参数    | 参数类型 | 备注      |
| ------- | -------- | --------- |
| iid     |          | 这里是iid |
| title   |          |           |
| summary |          | 个人简历  |
| need    |          | idea需求  |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": 1
}
```



#### 删除idea

> POST idea/delidea

| 参数 | 参数类型 | 备注 |
| ---- | -------- | ---- |
| iid  |          | iid  |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": 1
}
```



#### 获取所有idea

> POST idea/getallidea

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": [
        {
            "id": 2,
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
            "createtime": "2018-04-07 02:03:15"
        }
    ]
}
```



#### 申请加入一个idea组

> POST idea/applyidea

| 参数 | 参数类型 | 备注 |
| ---- | -------- | ---- |
| iid  |          |      |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": 1
}
```



#### 搜索idea组

> POST idea/selectidea

| 参数    | 参数类型 | 备注 |
| ------- | -------- | ---- |
| keyword |          |      |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": [
        {
            "id": 2,
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
            "createtime": "2018-04-07 02:03:15"
        }
    ]
}
```





#### 获取所有收到的news

> GET news/getnews

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": [
        {
            "id": 2,
            "uid": 2,
            "iid": 2,
            "iuid": 1,
            "status": 0,
            "createtime": "2018-04-07 04:03:49",
            "ideatitle": "Hacken",
            "userrealname": "小官"
        }
    ]
}
```





#### 确认news状态（同步修改申请人的未读消息状态）

> POST news/confirmnews

| 参数   | 参数类型 | 备注            |
| ------ | -------- | --------------- |
| nid    |          | 消息id          |
| uid    |          | 申请人id        |
| iid    |          | 申请的idea的id  |
| status |          | 0-未 1-Yes 2-No |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": 1
}
```



#### 用户未读消息状态

> POST news/changenews

| 参数 | 参数类型 | 备注                  |
| ---- | -------- | --------------------- |
| read |          | 0-无新信息 1-有新信息 |

```json
{
    "errcode": "0",
    "errmsg": "操作成功",
    "data": 1
}
```



























































































