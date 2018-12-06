# Linker
namepsace: `\`

为全静态方法的类，注册在根命名空间使用，为组件访问提供统一调度。

---



## 使用方式

1.注册

~~~php
<?php
//注册程序运行期间可替换组件（一般组件）
Linker::register([
	'component_name_1' => 'class_or_instance_n',
	...                    //形如['组件名'=>'类名或实例']
	'component_name_n' => 'class_or_instance_n',
]);

//注册不可替换组件（核心组件）
Linker::register([...], true); //将第二个参数设为true
~~~


2.访问

~~~php
<?php
//所有动态访问的静态方法都为注册的组件名，若无注册则会抛出异常

//获得组件名
Linker::component_name();

//获得组件实例
Linker::component_name(true);
~~~

3.其他

~~~php
<?php
//组件是否存在
Linker::exists('component_name'); //返回bool

//获得已注册组件
Linker::getAll(); //返回array

//获取标准组件名称，即自带的trait
Linker::getBasements(); //返回array

//移除组件，核心组件则抛出异常
Linker::remove('component_name'); //返回bool

//强制移除组件，核心组件也可移除
Linker::forceRemove('component_name'); //返回bool
~~~

---



## API

#### 列表
~~~php
//访问标准组件的方法，方法名即为组件名，参数为是否返回实例
public static function Config(bool $forInstance = false)
public static function Debug(bool $forInstance = false)
public static function Event(bool $forInstance = false)
public static function Exception(bool $forInstance = false)
public static function Lang(bool $forInstance = false)
public static function Log(bool $forInstance = false)
public static function Request(bool $forInstance = false)
public static function ServerFile(bool $forInstance = false)
public static function ServerKV(bool $forInstance = false)
public static function ServerLocal(bool $forInstance = false)
public static function ServerQueue(bool $forInstance = false)
public static function ServerSQL(bool $forInstance = false)

//其他
public static function __callStatic(string $component_name, array $args)
public static function register(array $components, bool $isCore = false): bool
public static function exists(string $component): bool
public static function getAll(): array
public static function getBasements(): array
public static function remove(string $component): bool
public static function forceRemove(string $component): bool
~~~

#### 详细说明
**::__callStatic()**: 动态访问组件
```php
params:
	string $component_name 组件名
	array  $args           只含一个bool参数，为是否返回实例，是则返回该组件的实例，否则返回该组件类名
return:
	string|object 类名或实例
```

**::register()**: 注册组件
```php
params:
	array $components   注册的组件，形如['组件名' => '类名或实例']
	bool  $isCore=false 是否为核心组件，是则不可被替换
return:
	bool 是否注册成功
```

**::exists()**: 组件是否存在
```php
params:
	string $component_name 组件名
return:
	bool 组件是否已注册
```

**::getAll()**: 获得所有已注册组件
```php
params:
	void
return:
	array 所有已注册组件
```

**::getBasements()**: 获得标准组件名，即自带的所有trait名
```php
params:
	void
return:
	array 所有标准组件名
```

**::remove()**: 移除一般组件，若为核心组件则抛出异常
```php
params:
	string $component_name 组件名
return:
	bool 是否移除成功
```

**::forceRemove()**: 强行移除组件，包括核心组件
```php
params:
	string $component_name 组件名
return:
	bool 是否移除成功
```