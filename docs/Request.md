# trait Request
namepsace: `basement`

用全静态方法实现HTTP请求（接受非发送）功能。全局只有唯一一次请求，应使用全局容器存储参数数据。一个请求可携带多个不同方法类型以及其对应的参数，但“当前请求方法”唯一，可以读写任何方法携带的任何参数。

注意：请求方法和协议名称应全为大写，请求的主域名应全为小写，并需兼容CLI下的调用。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
	'Request' => 'your_request_class',
]);

//设置某个方法的所有参数
Linker::Request()::set('method', ['params']); //返回bool

//设置当前方法的所有参数
Linker::Request()::setCurrent(['params']); //返回bool

//获得某个方法的所有参数
Linker::Request()::get('method'); //返回数组或null

//获得当前方法的所有参数
Linker::Request()::getCurrent(); //返回数组或null

//获得当前请求方法
Linker::Request()::getMethod(); //返回string或null

//获得当前某个请求头
Linker::Request()::getHeader('header'); //返回string或null

//获得当前请求的域名
Linker::Request()::getHost(); //返回string或null

//获得当前请求的端口
Linker::Request()::getPort(); //返回int或null

//获得当前请求的相对url（不含query string）
Linker::Request()::getURL(); //返回string或null

//获得当前请求协议
Linker::Request()::getProtocol(); //返回string或null

//获得请求者的ip
Linker::Request()::getIP(); //返回string或null

~~~

---



## API

#### 列表
~~~php
public static function set(string $method, array $parameters): bool
public static function setCurrent(array $parameters): bool
public static function get(string $method):  ? array
public static function getCurrent() :  ? array
public static function getHeader(string $header) :  ? string
public static function getMethod() :  ? string
public static function getHost() :  ? string
public static function getPort() :  ? int
public static function getURL() :  ? string
public static function getProtocol() :  ? string
public static function getIP() :  ? string
~~~

#### 详细说明
**::set()**: 设置某个请求方法的所有参数
```php
params:
	string $method     请求方法名
	array  $parameters 请求参数
return:
	bool 是否设置成功
```

**::setCurrent()**: 设置当前请求方法的所有参数
```php
params:
	array $parameters 请求参数
return:
	bool 是否设置成功
```

**::get()**: 获得某个请求方法的所有参数
```php
params:
	string $method 请求方法名
return:
	array|null 失败或不存在则返回null
```

**::getCurrent()**: 获得当前请求方法的所有参数
```php
params:
	void
return:
	array|null 失败或不存在则返回null
```

**::getHeader()**: 获得当前某个请求头
```php
params:
	string $header header名
return:
	string|null 失败或不存在则返回null
```

**::getMethod()**: 获得当前请求方法名
```php
params:
	void
return:
	string|null 请求方法名应为大写，如POST、GET等。无则返回null，如CLI模式下
```

**::getHost()**: 获得当前请求的主域名，应是完整的域名
```php
params:
	void
return:
	string|null 域名应为小写，无则返回null，如CLI模式下
```

**::getPort()**: 获得当前请求的端口
```php
params:
	void
return:
	int|null 端口号，无则返回null，如CLI模式下
```

**::getURL()**: 获得当前请求的相对url，该url不应包含`getHost()`中返回的部分，也即不含域名部分
```php
params:
	void
return:
	string|null 相对url，无则返回null，如CLI模式下
```

**::getProtocol()**: 获得当前请求的协议
```php
params:
	void
return:
	string|null 协议应为大写，如HTTP/1.1，HTTPS等。无则返回null，如CLI模式下
```

**::getIP()**: 获得当前客户端IP
```php
params:
	void
return:
	string|null ip地址，无则返回null，如CLI模式下
```