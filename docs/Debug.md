# trait Debug
namepsace: `basement`

实现调试相关的功能。一个调试实例可以设置一个标识（string），用于区分不同的调试场景，这个标识下的用户数据（array）只归属于它，并且用于存储用户数据的容器应该是全局性的，实例可以随时切换标识获得标识下的数据，且允许对数据细粒度控制，可以根据其key来读写。静态方法用于快速访问，只提供变量打印，系统信息（即非用户设置的数据）收集功能。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'Debug' => 'your_debug_class',
]);

//获得实例
$Debug = Linker::Debug(true);

//设置当前调试名
$Debug->setName('debug_name'); //返回bool

//获得当前调试名
$Debug->getName('debug_name'); //返回string

//设置key-value型调试信息
$Debug->set('key', $info); //返回bool

//获得key的调试信息
$Debug->get('key'); //返回mixed或null

//往key的尾部追加调试信息
$Debug->append('key', $info); //返回bool

//一次性设置所有调试信息
$Debug->setAll(['info']); //返回bool

//一次性获取所有调试信息
$Debug->getAll(['info']); //返回mixed或null

//静态方法
//打印变量
Linker::Debug()::dump($var_1, ... , $var_n);

//开始一个flag，用于收集该flag后的系统运行信息
Linker::Debug()::beginFlag('flag'); //返回bool

//结束一个flag，收集flag开始到结束之间的系统运行信息
Linker::Debug()::endFlag('flag'); //返回bool

//获得目标flag里的系统运行信息
Linker::Debug()::getFlag('flag'); //返回mixed或null
~~~

---



## API

#### 列表
~~~php
protected $__name = 'default';
public function setName(string $name): bool
{
    $this->__name = $name;
    return true;
}
public function getName(): string
{
    return $this->__name;
}
public function get(string $key)
public function set(string $key, $info): bool
public function append(string $key, $info): bool
public function setAll(array $data): bool
public function getAll():  ? array
public static function dump($arg, ...$moreArgs) : bool
public static function beginFlag(string $flag = 'default'): bool
public static function endFlag(string $flag = 'default'): bool
public static function getFlag(string $flag = 'default')
~~~

#### 详细说明
**属性**:
```
protected $__name = 'default'; 当前调试的标识名称，用于区分不同的调试场景
```

**setName()**: 设置当前调试名
```php
params:
    string $name 调试名
return:
    bool 是否设置成功
```

**getName()**: 获得当前调试名
```php
params:
    void
return:
    string 调试名
```

**get()**: 获得某个key下的调试信息
```php
params:
    string $key 目标键名
return:
    mixed|null 失败或不存在则返回null
```

**set()**: 设置某个key下的调试信息
```php
params:
    string $key  目标键名
    mixed  $info 调试信息
return:
    bool 是否设置成功
```

**append()**: 往某个key的尾部追加调试信息，若key不为数组，则需自动处理成数组后加入
```php
params:
    string $key  目标键名
    mixed  $info 调试信息
return:
    bool 是否设置成功
```

**setAll()**: 一次性设置所有的调试信息，若此前已存在信息，则会覆盖此前的信息
```php
params:
    array $data 所有调试信息
return:
    bool 是否设置成功
```

**getAll()**: 一次性获得所有的调试信息
```php
params:
    void
return:
    array|null 失败或不存在则返回null
```

**::dump()**: 打印变量，可使用不定参同时打印多个变量
```php
params:
    mixed $var         首个要打印的变量
    array $moreArgs=[] 同时打印的多个变量，为php不定参的传入数组
return:
    bool 是否打印成功
```

**::beginFlag()**: 设立一个flag，用于收集位于beginFlag和endFlag方法之间的系统运行信息
```php
params:
    string $flag='default' 自定义的flag名
return:
    bool 是否设立成功
```

**::endFlag()**: 结束一个flag，并收集位于beginFlag和endFlag方法之间的系统运行信息
```php
params:
    string $flag='default' 自定义的flag名
return:
    bool 是否结束成功
```

**::getFlag()**: 获得一个flag里存储的系统运行信息
```php
params:
    string $flag='default' 自定义的flag名
return:
    mixed|null 失败或不存在则返回null
```