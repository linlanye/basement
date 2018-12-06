# trait Config
namepsace: `basement`

用全静态方法实现配置的读写功能。使用一个配置名（string）对应一个配置（array）。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
	'Config' => 'your_config_class',
]);

//设置
Linker::Config()::set('config_name', ['content']); //返回bool

//读取
Linker::Config()::get('config_name'); //返回数组

//是否存在
Linker::Config()::exists('config_name'); //返回bool

//替换配置
Linker::Config()::replace('config_name', ['content']); //返回bool

//递归替换配置
Linker::Config()::replace('config_name', ['content'], true); //返回bool
~~~

---



## API

#### 列表
~~~php
public static function get(string $name):  ? array
public static function set(string $name, array $content) : bool
public static function exists(string $name): bool
public static function replace(string $name, array $content, bool $isRecursive = false): bool
~~~

#### 详细说明
**::get()**: 获得配置
```php
params:
	string $name 配置名
return:
	array|null 失败或不存在则返回null
```

**::set()**: 设置配置
```php
params:
	string $name    配置名
	array  $content 配置内容
return:
	bool 是否设置成功
```

**::exists()**: 配置是否存在
```php
params:
	string $name 配置名
return:
	bool 是否存在
```

**::replace()**: 替换配置
```php
params:
	string $name              配置名
	array  $content           用于替换的新的配置内容
	bool   $isRecursive=false 是否递归替换，替换模式参考array_replace和array_replace_recursive函数
return:
	bool 是否替换成功
```