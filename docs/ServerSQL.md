# trait ServerSQL
namepsace: `basement`

实现对关系型数据库的常见操作。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerSQL' => 'your_sql_class',
]);

//获得实例
$Server= Linker::ServerSQL(true);

//执行一条绑定变量的sql
$Server->execute('sql', ['bind_params_1, ..., bind_params_n']); //返回bool

//获得一个记录，以关联数组形式返回
$Server->fetchAssoc(); //返回关联数组或null

//获得所有记录，以关联数组形式返回
$Server->fetchAllAssoc(); //返回索引数组或null

//获得一个记录，以对象形式返回
$Server->fetchObject(); //返回对象或null

//获得所有记录，以对象形式返回
$Server->fetchAllObject(); //返回索引数组或null

//获得最后插入行的id
$Server->lastID(); //返回string或null

//获得操作影响的记录数
$Server->rowCount(); //返回int

//开始事务
$Server->beginTransaction(); //返回bool

//回滚事务
$Server->rollBack(); //返回bool

//提交事务
$Server->commit(); //返回bool

//是否处于事务中
$Server->inTransaction(); //返回bool
~~~

---



## API

#### 列表
~~~php
public function fetchAssoc():  ? array
public function fetchObject(string $className = 'stdClass', array $constructorArgs = []) :  ? object
public function fetchAllAssoc() :  ? array
public function fetchAllObject(string $className = 'stdClass', array $constructorArgs = []) :  ? array
public function lastID(string $name = '') :  ? string
public function rowCount(): int
public function execute(string $sql, array $params = []): bool
public function beginTransaction(): bool
public function rollBack(): bool
public function commit(): bool
public function inTransaction(): bool
~~~

#### 详细说明
**fetchAssoc()**: 取出一条查询记录，并以关联数据形式返回，键名为字段名，键值为字段值，形如['字段1' => '字段1值']
```php
params:
    void
return:
    array|null 失败、错误或无的情况返回null
```

**fetchObject()**: 取出一条查询记录，并以对象形式返回，对象属性为字段名，属性值为字段值，形如$Obj->'字段1'='字段1值'
```php
params:
    string $className='stdClass' 取出记录后用于实例化的类名，默认为stdClass
    array  $constructorArgs=[]   实例化对象时传入的构造参数
return:
    object|null 失败、错误或无的情况返回null
```

**fetchAllAssoc()**: 取出所有查询记录，并以数组形式返回。返回的数组是一个索引数组，每一个元素为`fetchAssoc()`的一个返回
```php
params:
    void
return:
    array|null 失败、错误或无的情况返回null
```

**fetchAllObject()**: 取出所有查询记录，并以数组形式返回。返回的数组是一个索引数组，每一个元素为`fetchObject()`的一个返回
```php
params:
    string $className='stdClass' 取出记录后用于实例化的类名，默认为stdClass
    array  $constructorArgs=[]   实例化对象时传入的构造参数
return:
    array|null 失败、错误或无的情况返回null
```

**lastID()**: 返回最后插入行的ID或序列值
```php
params:
    string $name='' 序列对象名称，取决于底层的驱动。比如PDO_PGSQL()要求为name参数指定序列对象的名称。
return:
    string|null 失败、错误或无的情况返回null
```

**rowCount()**: 返回操作影响的记录数
```php
params:
    void
return:
    int 影响的记录数，对于查询操作应尽可能兼容（非必须）
```

**execute()**: 执行sql语句
```php
params:
    string $sql       有效的sql语句
    array  $params=[] 对sql语句所绑定的那些变量
return:
    bool 是否成功
```

**beginTransaction()**: 打开事务
```php
params:
    void
return:
    bool 是否成功
```

**rollBack()**: 回滚事务
```php
params:
    void
return:
    bool 是否成功
```

**commit()**: 提交事务
```php
params:
    void
return:
    bool 是否成功
```

**inTransaction()**: 当前是否处于事务状态中
```php
params:
    void
return:
    bool 是否处于事务
```