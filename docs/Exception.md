# trait Exception
namepsace: `basement`

对异常类的兼容性扩展，增加异常类型和异常次要信息，用于简化多个异常场景需要使用不同的异常类来标识的传统模式，以及改善异常信息中带有变量情况对多语言不友好的情况。实现的宿主类还需继承\Exception类。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'Exception' => 'your_exception_class',
]);

//基本抛出方式
Linker::Exception()::throw('message');

//扩展的抛出方式，后两个参数为异常类型和异常次级信息
Linker::Exception()::throw('message', $code, 'exception type', 'secondary message');

//传统抛出方式+异常类型+次级信息
$Exception = Linker::Exception();
$Exception = new $Exception('message', $code, 'exception type', 'secondary message');

//获得异常类型
$Exception->getType();

//获得次级信息
$Exception->getSecondMessage();
~~~

---



## API

#### 列表
~~~php
protected $__type = '';
protected $__secondMessage = '';
public function __construct(string $message, int $code = 1, string $type = '', string $secondMessage = '')
{
    $this->__type          = $type;
    $this->__secondMessage = $secondMessage;
    parent::__construct($message, $code);
}
public function getType(): string
{
    return $this->__type;
}
public function getSecondMessage(): string
{
    return $this->__secondMessage;
}
public static function throw(string $message, int $code = 1, string $type = '', string $secondMessage = '') {
    throw new static($message, $code, $type, $secondMessage);
}
~~~

#### 详细说明
**属性**:
```
protected $__type = ''; 当前异常类型，默认为空，兼容原生模式
protected $__secondMessage = ''; 当前异常次级信息，默认为空，兼容原生模式
```

**__construct()**: 异常构造函数
```php
params:
    string $message          异常信息
    int    $code=1,          异常代码
    string $type=''          异常类型
    string $secondMessage='' 异常次级信息
```

**getType()**: 获得异常类型
```php
params:
    void
return:
    string 异常类型
```

**getSecondMessage()**: 获得异常次级信息
```php
params:
    void
return:
    string 异常次级信息
```

**::throw()**: 用静态方法抛出自身，前两个参数兼容原生模式
```php
params:
    string $message          异常信息
    int    $code=1,          异常代码
    string $type=''          异常类型
    string $secondMessage='' 异常次级信息
```