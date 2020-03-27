### 权限中心SDK

#### Usage
```php
composer require overlu/permission-sdk
```

##### 验证权限

1. 先在.env文件配置PERMISSION_HUB以及APP_CODE参数（后续根据配置中心，自动添加更新）
```dotenv
APP_CODE=etc
PERMISSION_SERVER=http://permission.test
```

2. 使用
```php
\Overlu\Referee\Role::referee('user_id','rule','app_code');

// demo
\Overlu\Referee\Role::referee('5e2272eb1d568f409d58ddee','config.rules.add','etc');

\Overlu\Referee\Role::referee('5e2272eb1d568f409d58ddee','config/add','etc');

// return
true or false
```
> ps：
> ___user_id___: 用户id
> ___rule___: 权限规则：module.controller.action，也可以为路由正则
> ___app_code___: 当前应用在配置中心的编码，不传则默认使用`APP_CODE`参数
