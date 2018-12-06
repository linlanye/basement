# trait Lang
namepsace: `basement`

实现多语言映射功能

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'Lang' => 'your_lang_class',
]);

//设置全局目标语言，如英文
Linker::Lang()::i18n('en'); //返回bool

//注册全局任一字符集的映射规则，入参为字符集标识和全局目标语言名
Linker::Lang()::autoload(function($label, $i18n){
    //映射逻辑
    return $chars;
});


//解绑事件
Linker::Event()::off('event_name'); //返回bool

//事件是否绑定
Linker::Event()::exists('event_name'); //返回bool

//触发事件，并以$param_1……$param_n传入事件入参
Linker::Event()::trigger('event_name', $param_1, ... , $param_n); //绑定事件的返回值
~~~

---



## API

#### 列表
~~~php
public static function on(string $event, callable $Callback, int $times = 0): bool
public static function off(string $event): bool
public static function exists(string $event): bool
public static function trigger(string $event, ...$params)
~~~

#### 详细说明

**::on()**: 绑定事件
```php
params:
    string   $event    事件名
    callable $Callback 绑定事件的逻辑代码，用回调形式实现
    int      $times=0  事件可执行的次数
return:
    bool 是否成功
```

**::off()**: 解绑事件
```php
params:
    string $event 事件名
return:
    bool 是否成功
```

**::exists()**: 事件是否存在
```php
params:
    string $event 事件名
return:
    bool 是否存在
```

**::trigger()**: 触发事件，并可以使用不定参传入绑定事件的入参
```php
params:
    string $event  事件名
    array  $params 触发该事件时的入参，用php不定参形式传入
return:
    mixed|null 绑定事件的返回值，失败或不存在则返回null
```