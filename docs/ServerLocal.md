# trait ServerLocal
namepsace: `basement`

实现对本地文件的常见操作功能，使用方法参考[ServerFile](ServerFile.md)。与访问远程文件服务器的ServerFile相比：

* 少了`upload()`和`download()`方法.
* 多了`isWritebale(), isReadable(), getContents()`三个方法。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerLocal' => 'your_local_class',
]);

//获得实例
$Server = Linker::ServerLocal(true);

//文件是否可写
$Server->isWritebale('file'); //返回bool

//文件是否可读
$Server->isReadable('file'); //返回bool

//读取php脚本返回的内容
$Server->getContents('php_file'); //返回php脚本返回的内容或null
~~~

---



## API

#### 列表
~~~php
protected $__path = '/';
public function setPath(string $path): bool
{
    $this->__path = $path;
    return true;
}
public function getPath(): string
{
    return $this->__path;
}
public function getMTime(string $fileName):  ? int
public function getATime(string $fileName) :  ? int
public function getCTime(string $fileName) :  ? int
public function getSize(string $fileName) :  ? int
public function exists(string $fileName): bool
public function remove(string $fileName): bool
public function write(string $fileName, string $content, string $mode = 'a'): bool
public function read(string $fileName, string $mode = 'r'):  ? string
public function isWritable(string $fileName) : bool
public function isReadable(string $fileName): bool
public function getContents(string $fileName)
{
    $r = @include $this->__path . $fileName;
    return $r === false ? null : $r;
}
~~~

#### 详细说明
**属性**:
```php
protected $__path='/' 当前文件夹路径
```

**isWritable()**: 文件是否可写
```php
params:
    string $fileName 文件名，对目录也可以处理
return:
    bool 是否可写
```

**isReadable()**: 文件是否可读
```php
params:
    string $fileName 文件名，对目录也可以处理
return:
    bool 是否可读
```

**getContents()**: 获得php脚本文件返回的内容
```php
params:
    string $fileName php脚本文件名
return:
    mixed|null php脚本返回的内容，失败或错误返回null
```