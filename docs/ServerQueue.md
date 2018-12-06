# trait ServerQueue
namepsace: `basement`

实现对队列服务器的常见操作。一个实例只能操作一个队列，若需操作不同队列需要使用`setName()`方法手动切换。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerQueue' => 'your_queue_class',
]);

//获得实例
$Server = Linker::ServerQueue(true);

//设置当前队列名
$Server->setName('queue_name'); //返回bool

//压入数据
$Server->push($data); //返回bool

//批量压入数据
$Server->multiPush(['data_1', ... ,'data_n']); //返回bool

//弹出一个数据
$Server->pop(); //返回array或null，若要弹出多个，则调用pop(n)

//队列是否为空
$Server->isEmpty(); //返回bool

//获得队列大小
$Server->getSize(); //返回int
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
public function push($data): bool
public function multiPush(array $data): bool
public function pop(int $amount = 1):  ? array
public function isEmpty() : bool
public function getSize(): int
~~~

#### 详细说明
**属性**:
```php
protected $__name = 'default'; 当前日志名
```

**setName()**: 设置当前队列名
```php
params:
    string $name 队列名
return:
    bool 是否成功
```

**getName()**: 获得当前队列名
```php
params:
    void
return:
    bool 是否成功
```
**push()**: 将数据压入队列
```php
params:
    mixed $data 数据
return:
    bool 是否成功
```

**multiPush()**: 批量压入数据
```php
params:
    array $data 批量数据，将数组的每一个元素压入队列
return:
    bool 是否成功
```

**pop()**: 弹出元素
```php
params:
    int $amount=1 一次性弹出的元素数量，默认为1
return:
    array|null 弹出的元素以一个索引数组作为包裹，形如[元素1，...，元素n]，错误或失败或无数据则返回null
```

**isEmpty()**: 当前队列是否为空
```php
params:
    void
return:
    bool 是否为空
```

**getSize()**: 获得当前队列元素个数
```php
params:
    void
return:
    int 队列元素个数
```