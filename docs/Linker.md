#Linker
namepsace: `\`

为全静态方法的类，注册在根命名空间使用，为组件访问提供统一调度。

---



##使用方式

1.注册

~~~php
<?php
//注册程序运行期间可替换组件（一般组件）
Linker::register([
	'component_name_1' => 'class_or_instance_n',
	... //形如['组件名'=>'类名或实例']
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



##API

####方法列表
~~~php
<?php
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
public static function register(array $array, bool $isCore = false)
public static function exists(string $component)
public static function getAll()
public static function getBasements()
public static function remove(string $component)
public static function forceRemove(string $component)
~~~

####详细说明

**__callStatic()**: 用于动态访问组件
```php
param1 string $component_name 组件名
param2 array  $args 		  只含一个bool参数，为是否返回实例，是则返回该组件的实例，否则返回该组件类名

return string|object          类名或实例

示例： Linker::component_name()获得类名。Linker::component_name(true)获得实例
```




