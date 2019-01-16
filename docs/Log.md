# trait Log
namepsace: `basement`

实现日志记录功能，一个实例拥有一个日志名，在该日志名下进行内容操作。兼容psr-3。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'Log' => 'your_log_class',
]);

//获得实例
$Log = Linker::Log(true);

//设置当前日志名
$Log->setName('log_name'); //返回bool

//获得当前日志名
$Log->getName(); //返回string

//psr-3方式
$Log->info('content'); //返回bool
...                    //8个日志等级，参见psr-3
$Log->alert('content');

//自定义日志类型
$Log->record('content', 'type'); //返回bool
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
public function record(string $content, string $type): bool
public function debug(string $content): bool
public function info(string $content): bool
public function notice(string $content): bool
public function warning(string $content): bool
public function error(string $content): bool
public function critical(string $content): bool
public function alert(string $content): bool
public function emergency(string $content): bool
~~~

#### 详细说明
**属性**:
```php
protected $__name = 'default'; 当前日志名
```


**setName()**: 设置当前日志名
```php
params:
    string $name 日志名
return:
    bool 是否成功
```

**getName()**: 获得当前日志名
```php
params:
    void
return:
    bool 是否成功
```

**record()**: 自定义日志类型并记录日志
```php
params:
    string $content 日志内容
    string $type    日志类型
return:
    bool 是否成功
```

**info()**: psr-3方式，其他7个方法一致
```php
params:
    string $content 日志内容
return:
    bool 是否成功
```
