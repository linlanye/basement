# trait ServerFile
namepsace: `basement`

实现对远程文件服务器的常见读写访问。需要设置目录路径后，对该目录里的文件进行读写，如此可省去文件名的路径前缀。

注意：除文件读写外，对于目录情况也应能兼容处理。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerFile' => 'your_file_class',
]);

//获得实例
$Server = Linker::ServerFile(true);

//设置当前文件读写路径
$Server->setPath('path'); //返回bool

//获得当前文件读写路径
$Server->getPath(); //返回string

//获得文件最后修改时间
$Server->getMTime('file'); //返回int或null

//获得文件最后访问时间
$Server->getATime('file'); //返回int或null

//获得文件创建时间
$Server->getCTime('file'); //返回int或null

//获得文件大小
$Server->getSize('file'); //返回int或null

//文件是否存在
$Server->exists('file'); //返回bool

//删除文件
$Server->remove('file'); //返回bool

//以某种模式写文件
$Server->write('file', 'content', $mode); //返回bool

//以某种模式读文件
$Server->read('file', $mode); //返回string或null

//上传本地文件到服务器
$Server->upload('local_file', 'server_file'); //返回bool

//下载服务器文件到本地
$Server->download('server_file', 'local_file'); //返回bool
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
public function upload(string $localFile, string $serverFile) : bool
public function download(string $serverFile, string $localFile): bool
~~~

#### 详细说明
**属性**:
```php
protected $__path = '/'; 当前文件夹路径
```

**setPath()**: 设置当前目录路径
```php
params:
    string $path 路径
return:
    bool 是否成功
```

**getPath()**: 获得当前目录路径
```php
params:
    void
return:
    string 目录路径
```

**getMTime()**: 获得文件最后修改时间。getATime()、getCTime()一致，分别为获得最后访问和创建时间
```php
params:
    string $fileName 文件名，对目录也可以处理
return:
    int|null 时间戳，失败或错误返回null
```

**getSize()**: 获得文件大小
```php
params:
    string $fileName 文件名，对目录也可以处理
return:
    int|null 文件大小，以字节计算，失败或错误返回null
```

**exists()**: 文件是否存在
```php
params:
    string $fileName 文件名，对目录也可以处理
return:
    bool 是否存在
```

**remove()**: 删除文件
```php
params:
    string $fileName 文件名，对目录也可以处理，建议非空目录不予删除
return:
    bool 是否成功
```

**write()**: 写文件
```php
params:
    string $fileName 文件名
    string $content  写内容
    string $mode='a' 写模式，默认以'a'模式写
return:
    bool 是否成功
```

**read()**: 读文件
```php
params:
    string $fileName 文件名
    string $mode='a' 读模式，默认以'r'模式读
return:
    string|null 文件内容，失败或错误返回null
```

**upload()**: 上传本地文件到服务器
```php
params:
    string $localFile  欲上传的本地文件，对目录也可以处理
    string $serverFile 上传到服务器上的目标文件名，对目录也可以处理
return:
    bool 是否成功
```

**download()**: 下载服务器文件到本地
```php
params:
    string $serverFile 欲从服务器上下载的文件，对目录也可以处理
    string $localFile  存储到本地的目标文件名，对目录也可以处理
return:
    bool 是否成功
```