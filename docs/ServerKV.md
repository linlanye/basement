# trait ServerKV
namepsace: `basement`

实现对Key-Value型服务器的常见操作。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerKV' => 'your_kv_class',
]);

//获得实例
$Server = Linker::ServerKV(true);

//设置键值
$Server->set('key', $value); //返回bool

//获得键值
$Server->get('key'); //返回mixed或null

//删除键值
$Server->delete('key'); //返回bool

//键值是否存在
$Server->exists('key'); //返回bool

//清空所有键值
$Server->flush(); //返回bool
~~~

---



## API

#### 列表
~~~php
public function get(string $key)
public function set(string $key, $value, int $life = 0): bool
public function delete(string $key): bool
public function exists(string $key): bool
public function flush(): bool
~~~

#### 详细说明
**get()**: 获得目标键值
```php
params:
    string $key 键名
return:
    mixed|null 键值，失败或错误返回null
```

**set()**: 设置目标键值
```php
params:
    string $key    键名
    mixed  $value  键值
    int    $life=0 键值有效期，默认0为不限制
return:
    bool 是否成功
```

**delete()**: 删除目标键值
```php
params:
    string $key 键名
return:
    bool 是否成功
```

**exists()**: 目标键值是否存在
```php
params:
    string $key 键名
return:
    bool 是否存在
```

**flush()**: 清空所有键值
```php
params:
    void
return:
    bool 是否成功
```