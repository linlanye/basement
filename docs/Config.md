# trait Config
namepsace: `basement`

实现配置的读写功能

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
	'Config' => 'your_config_class',
]);

//设置
Linker::set('config_name', ['content']); //返回bool

//读取
Linker::get('config_name'); //返回数组

//是否存在
Linker::exists('config_name'); //返回bool

//整体替换配置
Linker::replace('config_name', ['content']); //返回bool

//递归替换配置
Linker::replace('config_name', ['content'], true); //返回bool
~~~

---



## API

#### 方法列表
~~~php
public static function get(string $name)
public static function set(string $name, array $content)
public static function exists(string $name)
public static function replace(string $name, array $content, bool $isRecursive = false)
~~~

#### 详细说明

**__callStatic()**: 动态访问组件
```php
params:
	string $component_name 组件名
	array  $args           只含一个bool参数，为是否返回实例，是则返回该组件的实例，否则返回该组件类名
return:
	string|object 类名或实例
```

**register()**: 注册组件
```php
params:
	array $components   注册的组件，形如['组件名' => '类名或实例']
	bool  $isCore=false 是否为核心组件，是则不可被替换
return:
	bool 是否注册成功
```

**exists()**: 组件是否存在
```php
params:
	string $component_name 组件名
return:
	bool 组件是否已注册
```

**getAll()**: 获得所有已注册组件
```php
params:
	void
return:
	array 所有已注册组件
```

**getBasements()**: 获得标准组件名，即自带的所有trait名
```php
params:
	void
return:
	array 所有标准组件名
```

**remove()**: 移除一般组件，若为核心组件则抛出异常
```php
params:
	string $component_name 组件名
return:
	bool 是否移除成功
```

**forceRemove()**: 强行移除组件，包括核心组件
```php
params:
	string $component_name 组件名
return:
	bool 是否移除成功
```